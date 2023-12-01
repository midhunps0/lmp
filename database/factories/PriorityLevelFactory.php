<?php

namespace Database\Factories;
use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PriorityLevel>
 */
class PriorityLevelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            
            'level'=>fake()->randomElements(["low","medium","heigh"]),
            'client_id'=>Client::inRandomOrder()->first()->id,

        ];
    }
}
