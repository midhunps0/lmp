<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Subscription;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $subscription=Subscription::inRandomOrder()->first();
        return [
            'client_id'=>Client::inRandomOrder()->first()->id,
            'subscription_id'=>$subscription->id,
            'amount'=>$subscription->subscriptionModel->fee,
        ];
    }
}
