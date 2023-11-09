<?php

namespace Database\Factories;

use App\Models\Lead;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Chat>
 */
class ChatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'lead_id'=>Lead::inRandomOrder()->first()->id,
            'message'=>'Hi,we have new products launched!!',
            'type'=>'text',
            'direction'=>fake()->randomElement(["Inbound","Outbound"]),
            'status'=>fake()->randomElement(["Sent","Read","Delivered"]),
            'warmid'=>fake()->randomElement(["Hot","Cold"]),
            'expiration_time'=>fake()->dateTimeBetween(now()->addDay(),now()->addDays(2))
        ];
    }
}
