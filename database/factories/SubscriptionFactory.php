<?php

namespace Database\Factories;

use App\Models\SubscriptionModel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subscription>
 */
class SubscriptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startDate = now()->addMonth(); // Start from next month
        $endDate = now()->addMonths(4);
        return [
            'subscription_model_id'=>SubscriptionModel::inRandomOrder()->first()->id,
            'valid_till'=>fake()->dateTimeBetween($startDate,$endDate),
        ];
    }
}
