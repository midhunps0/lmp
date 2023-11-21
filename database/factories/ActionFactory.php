<?php

namespace Database\Factories;
use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Action>
 */
class ActionFactory extends Factory
{
    /**
     * Define the model's default state.
     * 
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'client_id'=>Client::inRandomOrder()->first()->id,
            'name'=>fake()->randomElement(["Followup started","Appoinments scheduled","lead created"]),
            'location'=>fake()->address
        ];
    }
}
