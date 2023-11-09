<?php

namespace Database\Factories;

use App\Models\SubscriptionModel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SubscriptionModel>
 */
class SubscriptionModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $model=fake()->unique()->randomElement(SubscriptionModel::$models);
        $fee = ($model === "Silver") ? 149 : (($model === "Gold") ? 499 : 899);

        return [
            'model'=>$model,
            'fee'=>$fee,
        ];
    }
}
