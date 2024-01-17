<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Productvariant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductvariantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        $variants = config('productvariant.variants');

        foreach ($variants as $variant) {
            ProductVariant::create([
                'product_id' => Product::inRandomOrder()->first()->id, // Assuming you want to associate a random product
                'name' => $variant['name'],
                'slug' => $variant['slug'],
                'price' => $variant['price'],
                'quantity' => $variant['quantity'],
            ]);
        }
    }
}
