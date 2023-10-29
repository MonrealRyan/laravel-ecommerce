<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ViewCategoryProductTest extends FeatureBaseTestCase
{
    use RefreshDatabase;

    public function test_the_product_detail_route_to_return_a_successful_response(): void
    {
        $this->initCategory();
        $product = Product::factory(1)->couches()->create();

        $response = $this->get("/products/" . $product->first()->id);

        $response->assertStatus(200);
    }

    public function test_the_product_detail_using_product_name_instead_of_id_route_to_return_a_404_response(): void
    {
        $this->initCategory();
        $product = Product::factory(1)->couches()->create();

        $response = $this->get("/products/" . $product->first()->name);

        $response->assertStatus(404);
    }

    public function test_the_product_detail_route_with_zero_quantity_return_a_successful_response(): void
    {
        $this->initCategory();
        $product = Product::factory(rand(3, 12))->chairs()->create([
            'quantity' => 0
        ]);

        $response = $this->get("/products/" . $product->first()->id);

        $response->assertStatus(200);
    }
}
