<?php

namespace App\Services;

use App\Mail\EmailPurchasedOrderDetail;
use App\Models\Order;
use App\Models\Product;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class PurchaseService
{
    protected $stripe;

    public function __construct(StripeService $stripe)
    {
        $this->stripe = $stripe;
    }

    public function transactOrder(Product $product, array $data) : Order
    {
        try {
            $productPrice = $product->price;
            $charge = $this->stripe->createCustomerAndCharge(
                [
                    'name' => ucwords(strtolower($data['name'])),
                    'email' => $data['email'],
                    'description' => "House Decor Purchasing of Product #" .$product->id . " - " . $product->name,
                ],
                [
                    'amount' => (int) ($productPrice * 100),
                    'currency' => 'USD',
                    'source' => $data['stripe_token'],
                    'description' => "Payment House Decor Purchasing of Item #" .$product->id . " - " . $product->name,
                ]
            );

            Log::channel('purchased_order')->error("Process stripe info before proceeding to order record", [
                'Stripe Customer:' . $charge->customer,
                'Charge:' . $charge->id,
                'Price:' . $productPrice,
            ]);

            DB::beginTransaction();

            unset($data['stripe_token']);
            $quantity = 1;
            $product->decrement('quantity', $quantity);
            $order = $product->orders()->create(
                array_merge(
                    $data,
                    [
                        'quantity' => $quantity,
                        'price' => $productPrice,
                        'stripe_customer_id' => $charge->customer,
                        'stripe_charge_id' => $charge->id
                    ]
                )
            );

            $order->load('product');

            Log::channel('purchased_order')->error("Record order info after successful stripe transaction", $order->toArray());

            DB::commit();

            Mail::to($order->email)->send(new EmailPurchasedOrderDetail($order));

            return $order;
        } catch(\Stripe\Exception\CardException $e) {
            DB::rollBack();

            // Since it's a decline, \Stripe\Exception\CardException will be caught
            Log::channel('purchased_order')->error($e->getError()->message, [
                'Status is:' . $e->getHttpStatus(),
                'Type is:' . $e->getError()->type,
                'Code is:' . $e->getError()->code,
                'Param is:' . $e->getError()->param,
                'Message is:' . $e->getError()->message,
            ]);

            throw new Exception($e->getError()->message);
        } catch (\Throwable $th) {
            DB::rollBack();
            throw new Exception($th->getMessage());
        }
    }

}
