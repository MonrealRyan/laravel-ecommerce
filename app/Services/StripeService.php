<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\DB;

class StripeService
{
    protected $stripe;

    public function __construct()
    {
        $this->stripe = new \Stripe\StripeClient(
            config('services.stripe.secret')
        );
    }

    public function createCustomer(array $customerData) : \Stripe\Customer
    {
        return $this->stripe->customers->create($customerData);
    }

    public function createCard(string $customerId, string $stripeToken) : \Stripe\Card
    {
        return $this->stripe->customers->createSource(
            $customerId,
            ['source' => $stripeToken]
        );
    }

    public function createCharge(array $chargeData) : \Stripe\Charge
    {
        return $this->stripe->charges->create($chargeData);
    }

    public function createCustomerAndCharge(array $customerData, array $chargeData) : \Stripe\Charge
    {
        try {
            DB::beginTransaction();

            $customer = $this->createCustomer($customerData);
            $card = $this->createCard($customer->id, $chargeData['source']);
            $chargeData['customer'] = $customer->id;
            $chargeData['source'] = $card->id;
            $charge = $this->createCharge($chargeData);

            DB::commit();

            return $charge;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw new Exception($th->getMessage());
        }
    }

    public function chargeCustomer($amount, $stripeToken)
    {
        // Stripe charge logic
         // Get necessary data from the request
         $amount = $amount * 100;
         $currency = 'usd'; // Replace with your preferred currency

         $charge = $this->stripe->charge->create([
             'amount' => $amount,
             'currency' => $currency,
             'source' => $stripeToken, // The card token or number
             'description' => 'Example charge description' // Replace with your description
             // Additional parameters can be added as needed
         ]);

        // Return success or failure response
        return $charge; // Simulating a successful charge
    }
}
