<?php

namespace Database\Seeders;

use App\Models\ProductProperty;
use App\Models\ProductPropertyValue;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $products = Product::factory(100)->create();
        $productProperties = ProductProperty::factory(10)->create();

        $propertyIds = $productProperties->pluck('id');
        foreach ($products as $product) {
            $randomPropertyIds = $propertyIds->random(random_int(1, 5));
            foreach ($randomPropertyIds as $propertyId) {
                ProductPropertyValue::factory()->create([
                    'product_id' => $product->id,
                    'property_id' => $propertyId,
                ]);
            }
        }
    }
}
