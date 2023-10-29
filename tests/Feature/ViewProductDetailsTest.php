<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ViewProductDetailsTest extends FeatureBaseTestCase

{
    use RefreshDatabase;

    public function test_the_default_route_to_return_a_successful_response(): void
    {
        $this->initCategory();
        Product::factory(rand(3, 12))->couches()->create();

        $response = $this->get("/");
        $response->assertStatus(200);
    }

    public function test_the_couches_route_to_return_a_successful_response(): void
    {
        $this->initCategory();
        Product::factory(rand(3, 12))->couches()->create();

        $response = $this->get("/couches");

        $response->assertStatus(200);
    }

    public function test_the_chair_route_to_return_a_successful_response(): void
    {
        $this->initCategory();
        Product::factory(rand(3, 12))->chairs()->create();

        $response = $this->get("/chairs");

        $response->assertStatus(200);
    }

    public function test_the_dinning_route_to_return_a_successful_response(): void
    {
        $this->initCategory();
        Product::factory(rand(3, 12))->dinnings()->create();

        $response = $this->get("/dinnings");

        $response->assertStatus(200);
    }
}
