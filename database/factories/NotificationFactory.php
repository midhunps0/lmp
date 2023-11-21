<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Notification>
 */
class NotificationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $client = Client::inRandomOrder()->first();
        $user = $client->users()->inRandomOrder()->first();
        
        return [
            'client_id' => $client->id,
            'user_id' => $user->id,
            'message' => "You have 3 unread messages",
        ];
        
    }
}
