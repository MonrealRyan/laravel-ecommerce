<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\Product;
use App\Services\PurchaseService;
use App\Services\StripeService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Mockery;
use Stripe\ApiRequestor;

class CheckoutProductTest extends FeatureBaseTestCase
{
    use RefreshDatabase;

    public function test_the_product_checkout_route_to_required_name(): void
    {
        $this->initCategory();
        $product = Product::factory(1)->couches()->create();

        $response = $this->post("/products/" . $product->first()->id . "/checkout", [
            '_token' => csrf_token(),
        ]);

        $response->assertStatus(302);
        $response->assertRedirect("/products/" . $product->first()->id."?status=failed");

        $response->assertSessionHasErrors([
            'name' => 'The name field is required.',
        ]);
    }

    public function test_the_product_checkout_route_to_required_stripe_token(): void
    {
        $this->initCategory();
        $product = Product::factory(1)->couches()->create();

        $response = $this->post("/products/" . $product->first()->id . "/checkout", [
            '_token' => csrf_token(),
            'name' => fake()->name,
            'email' => fake()->email,
        ]);

        $response->assertStatus(302);
        $response->assertRedirect("/products/" . $product->first()->id."?status=failed");

        $response->assertSessionHasErrors([
            'stripe_token' => 'Payment Information is required.',
        ]);
    }

    public function test_the_product_checkout_route_to_required_a_valid_stripe_token(): void
    {
        $this->initCategory();
        $product = Product::factory(1)->couches()->create();

        $response = $this->post("/products/" . $product->first()->id . "/checkout", [
            '_token' => csrf_token(),
            'name' => fake()->name,
            'email' => fake()->email,
            'stripe_token' => 12313112312122,
        ]);

        $response->assertStatus(302);
        $response->assertRedirect("/products/" . $product->first()->id."?status=failed");

        $response->assertSessionHasErrors([
            'stripe_token' => 'Payment Information is not valid.',
        ]);
    }

    public function test_the_product_checkout_route_to_required_email(): void
    {
        $this->initCategory();
        $product = Product::factory(1)->couches()->create();

        $response = $this->post("/products/" . $product->first()->id . "/checkout", [
            '_token' => csrf_token(),
            'name' => fake()->name,
        ]);

        $response->assertStatus(302);
        $response->assertRedirect("/products/" . $product->first()->id."?status=failed");

        $response->assertSessionHasErrors([
            'email' => 'The email field is required.',
        ]);
    }

    public function test_the_product_checkout_route_to_required_a_valid_email(): void
    {
        $this->initCategory();
        $product = Product::factory(1)->couches()->create();

        $response = $this->post("/products/" . $product->first()->id . "/checkout", [
            '_token' => csrf_token(),
            'name' => fake()->name,
            'email' => fake()->name,
        ]);

        $response->assertStatus(302);
        $response->assertRedirect("/products/" . $product->first()->id."?status=failed");

        $response->assertSessionHasErrors([
            'email' => 'The email field must be a valid email address.',
        ]);
    }

    public function test_the_product_checkout_route_to_response_a_validation_response_for_out_of_stock(): void
    {
        $this->initCategory();
        $product = Product::factory(rand(3, 12))->chairs()->create([
            'quantity' => 0
        ]);

        $response = $this->post("/products/" . $product->first()->id."/checkout", [
            '_token' => csrf_token(),
            'name' => fake()->name,
            'email' => fake()->email,
            'stripe_token' => 'somerandomstring',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect("/products/" . $product->first()->id."?status=failed");

        $response->assertSessionHas('error', 'Product is out of stock!');
    }

    public function test_the_product_checkout_route_to_response_successful(): void
    {
        $this->initCategory();
        $product = Product::factory(1)->chairs()->create();

        $dataParams = [
            '_token' => csrf_token(),
            'name' => fake()->name,
            'email' => fake()->email,
            'stripe_token' => 'tok_'. Str::random(),
        ];

        $mock = Mockery::mock(PurchaseService::class);
        $this->app->instance(PurchaseService::class, $mock);
        $mock->shouldReceive('transactOrder')
                ->andReturn(new Order()); // Simulating a successful charge

        // Make a POST request to your controller's endpoint
        $response = $this->post("/products/" . $product->first()->id."/checkout", $dataParams);

        $response->assertStatus(302);
        $response->assertRedirect("/");
        $response->assertSessionHas('success', 'Product purchased successfully!');

        Mockery::close();
    }
}
