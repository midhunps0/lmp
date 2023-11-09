<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Support\Str;
use App\Models\ProductCategory;
use App\Models\ProductTag;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->word();
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => $this->faker->paragraph(),
            'price' => random_int(1000, 15000),
            'code' => substr($name, 0, 3).rand(101,999),
            'product_category_id' => ProductCategory::all()->random()->id,
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Product $p) {
            $pts = ProductTag::all()->random(2);
            foreach ($pts as $pt) {
                $p->productTags()->save($pt);
            }
        });
    }
}
