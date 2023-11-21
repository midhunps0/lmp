<?php

namespace Database\Factories;
use App\Models\Client;
use App\Models\SubscriptionModel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ClientSubscription>
 */
class ClientSubscriptionFactory extends Factory
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
            'client_id'=> Client::inRandomOrder()->first()->id,
            'subscription_model_id'=>SubscriptionModel::inRandomOrder()->first()->id,
            
            
        ];
    }
}
