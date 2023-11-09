<?php

namespace Database\Factories;

use App\Models\Subscription;
use App\Models\SubscriptionModel;
use Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'=>fake()->company,
            'phone'=>fake()->phoneNumber,
            'address'=>fake()->address,
            'email'=>fake()->unique()->safeEmail,
            'password'=>Hash::make('password'),
            'subscription_model_id'=>SubscriptionModel::inRandomOrder()->first()->id,
            'subscription_id'=>Subscription::inRandomOrder()->first()->id,
        ];
    }
}
