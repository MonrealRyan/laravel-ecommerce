<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductCheckoutRequest;
use App\Models\Product;
use App\Services\PurchaseService;
use App\Services\StripeService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    // protected $stripeService;
    protected $purchaseService;

    // public function __construct(StripeService $stripeService, PurchaseService $purchaseService)
    public function __construct(PurchaseService $purchaseService)
    // public function __construct(StripeService $stripeService)
    {
        // $this->stripeService = $stripeService;
        $this->purchaseService = $purchaseService;
    }

    public function show(Product $product) : View
    {
        $category = $product->category;

        return view('product.show', compact('product', 'category'));
    }

    public function checkout(ProductCheckoutRequest $request, Product $product) : RedirectResponse
    {
        if ($product->isOutOfStock()) {
            return redirect()->route('category.product', ['product' => $product, 'status' => 'failed'])->with('error', 'Product is out of stock!');
        }

        try {
            $this->purchaseService->transactOrder($product, $request->except('_token'));

            return redirect()->route('home')->with('success', 'Product purchased successfully!');
        } catch (\Throwable $th) {
            return redirect()->route('category.product', ['product' => $product, 'status' => 'failed'])->with('error', $th->getMessage());
        }
    }

    // public function charge(Request $request)
    // {
    //     // Extract amount and card number from the request
    //     $amount = $request->input('amount');
    //     $stripeToken = $request->input('stripe_token');

    //     $success = $this->stripeService->chargeCustomer($amount, $stripeToken);

    //     if ($success) {
    //         return response()->json(['message' => 'Payment successful']);
    //     } else {
    //         return response()->json(['message' => 'Payment failed'], 500);
    //     }
    // }
}
