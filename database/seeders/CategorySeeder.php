<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $catalogs = [
            [
                "id" => 1,
                "name" => "Couches",
                "slug" => "couches",
                "order" => 1,
                "is_default" => 1,
            ],
            [
                "id" => 2,
                "name" => "Chairs",
                "slug" => "chairs",
                "order" => 2,
                "is_default" => 0,
            ],
            [
                "id" => 3,
                "name" => "Dinnings",
                "slug" => "dinnings",
                "order" => 3,
                "is_default" => 0,
            ],
        ];

        foreach ($catalogs as $catalog) {
            Category::updateOrCreate(
                [
                    'id' => $catalog['id']
                ],
                $catalog
            );
        }
    }
}
