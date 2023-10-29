<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // provide a real data for the items
        $couches = [
            [
                'name' => 'Wood Sofa set-A',
                'short_description' => "brown sofa in a room during daytime",
                'long_description' => fake()->paragraph(),
                'price' => rand(100, 1000),
                'quantity' => rand(1, 10),
                'picture' => 'https://images.unsplash.com/photo-1505693070124-1cce01268b88?auto=format&fit=crop&q=60&w=1000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8Y291Y2hlc3xlbnwwfHwwfHx8MA%3D%3D',
                'category_id' => Category::COUCHES
            ],
            [
                'name' => 'Wood Sofa set-B',
                'short_description' => "black couch near black fireplace",
                'long_description' => fake()->paragraph(),
                'price' => rand(100, 1000),
                'quantity' => rand(1, 10),
                'picture' => 'https://images.unsplash.com/photo-1628745750131-e5cfc5e70ced?auto=format&fit=crop&q=80&w=3870&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                'category_id' => Category::COUCHES
            ],
            [
                'name' => 'Wood Sofa set-C',
                'short_description' => "Small couche for your living room",
                'long_description' => fake()->paragraph(),
                'price' => rand(100, 1000),
                'quantity' => rand(1, 10),
                'picture' => 'https://i.imgur.com/hnX99Cr.jpg',
                'category_id' => Category::COUCHES
            ],
            [
                'name' => 'Wood Sofa set-D',
                'short_description' => "Wood + fabric sofa set",
                'long_description' => fake()->paragraph(),
                'price' => rand(100, 1000),
                'quantity' => rand(1, 10),
                'picture' => 'https://images.unsplash.com/photo-1628744876497-eb30460be9f6?auto=format&fit=crop&q=80&w=3870&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                'category_id' => Category::COUCHES
            ],
            [
                'name' => 'Wood Sofa set-E',
                'short_description' => "All semi-white fabric sofa set",
                'long_description' => fake()->paragraph(),
                'price' => rand(100, 1000),
                'quantity' => rand(1, 10),
                'picture' => 'https://images.unsplash.com/photo-1613545325268-9265e1609167?auto=format&fit=crop&q=80&w=3870&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                'category_id' => Category::COUCHES
            ],
            [
                'name' => 'Wood Sofa set-F',
                'short_description' => "Brown fabric sofa set",
                'long_description' => fake()->paragraph(),
                'price' => rand(100, 1000),
                'quantity' => rand(1, 10),
                'picture' => 'https://i.imgur.com/SOMPPzU.jpg',
                'category_id' => Category::COUCHES
            ],
        ];

        $chairs = [
            [
                'name' => 'Chair set-A',
                'short_description' => "2 brown chairs  (wood + fabric)",
                'long_description' => fake()->paragraph(),
                'price' => rand(100, 1000),
                'quantity' => rand(1, 10),
                'picture' => 'https://i.imgur.com/2ldaKjy.jpg',
                'category_id' => Category::CHAIR
            ],
            [
                'name' => 'Chair set-B',
                'short_description' => "2 chairs (fabric) with 2 pillows included",
                'long_description' => fake()->paragraph(),
                'price' => rand(100, 1000),
                'quantity' => rand(1, 10),
                'picture' => 'https://i.imgur.com/lTgyE2X.jpg',
                'category_id' => Category::CHAIR
            ],
            [
                'name' => 'Chair set-C',
                'short_description' => "Office chairs set",
                'long_description' => fake()->paragraph(),
                'price' => rand(100, 1000),
                'quantity' => rand(1, 10),
                'picture' => 'https://i.imgur.com/NFcMfYE.jpg',
                'category_id' => Category::CHAIR
            ],
            [
                'name' => 'Chair set-D',
                'short_description' => "Custom made chairs set (wood + fabric) table not included",
                'long_description' => fake()->paragraph(),
                'price' => rand(100, 1000),
                'quantity' => rand(1, 10),
                'picture' => 'https://i.imgur.com/eu74Mje.jpg',
                'category_id' => Category::CHAIR
            ],
            [
                'name' => 'Chair set-E',
                'short_description' => "Minibar chairs set (wood)",
                'long_description' => fake()->paragraph(),
                'price' => rand(100, 1000),
                'quantity' => rand(1, 10),
                'picture' => 'https://i.imgur.com/L5iInTA.jpg',
                'category_id' => Category::CHAIR
            ],
            [
                'name' => 'Chair set-F',
                'short_description' => "Office chair set",
                'long_description' => fake()->paragraph(),
                'price' => rand(100, 1000),
                'quantity' => rand(1, 10),
                'picture' => 'https://i.imgur.com/64PRDTx.jpg',
                'category_id' => Category::CHAIR
            ],
        ];

        $dinnings = [
            [
                'name' => 'Dinning set-A',
                'short_description' => "all black wooden dinning set",
                'long_description' => fake()->paragraph(),
                'price' => rand(100, 1000),
                'quantity' => rand(1, 10),
                'picture' => 'https://i.imgur.com/hnQ492C.jpg',
                'category_id' => Category::DINNING
            ],
            [
                'name' => 'Dinning set-B',
                'short_description' => "Semi-elegant dinning set (wood + fabric)",
                'long_description' => fake()->paragraph(),
                'price' => rand(100, 1000),
                'quantity' => rand(1, 10),
                'picture' => 'https://i.imgur.com/10JlX4K.jpg',
                'category_id' => Category::DINNING
            ],
            [
                'name' => 'Dinning set-C',
                'short_description' => "Simple dinning set (wood + fabric + metal)",
                'long_description' => fake()->paragraph(),
                'price' => rand(100, 1000),
                'quantity' => rand(1, 10),
                'picture' => 'https://i.imgur.com/eu74Mje.jpg',
                'category_id' => Category::DINNING
            ],
            [
                'name' => 'Dinning set-D',
                'short_description' => "Wood dinning set (fabric with custom pixel design)",
                'long_description' => fake()->paragraph(),
                'price' => rand(100, 1000),
                'quantity' => rand(1, 10),
                'picture' => 'https://i.imgur.com/uh0knIW.jpg',
                'category_id' => Category::DINNING
            ],
            [
                'name' => 'Dinning set-E',
                'short_description' => "All Black dinning set (metal) table has glass on top",
                'long_description' => fake()->paragraph(),
                'price' => rand(100, 1000),
                'quantity' => rand(1, 10),
                'picture' => 'https://i.imgur.com/rdYgwhr.jpg',
                'category_id' => Category::DINNING
            ],
            [
                'name' => 'Dinning set-F',
                'short_description' => "Modernize dinning set",
                'long_description' => fake()->paragraph(),
                'price' => rand(100, 1000),
                'quantity' => rand(1, 10),
                'picture' => 'https://i.imgur.com/x6hhqGn.jpg',
                'category_id' => Category::DINNING
            ],
        ];

        $products = array_merge($couches, $chairs, $dinnings);

        foreach ($products as $key => $product) {
            Product::updateOrCreate(
                [
                    'id' => $key + 1 // for the id
                ],
                array_merge(
                    $product,
                    [
                        'guarantee' => rand(0, 24)
                    ]
                )
            );
        }
    }
}
