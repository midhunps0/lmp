<?php

namespace Database\Factories;

use App\Models\PriorityLevel;
use App\Models\Segment;
use App\Models\Stage;
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
        ];
    }
}
