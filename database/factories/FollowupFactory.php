<?php

namespace Database\Factories;

use App\Models\Lead;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Followup>
 */
class FollowupFactory extends Factory
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
            'user_id'=>User::inRandomOrder()->first()->id,
            'scheduled_date'=>fake()->dateTimeBetween(now(), now()->addDays(5)),
            'actual_date'=>fake()->dateTimeBetween(now()->addDays(5), now()->addDays(15)),
        ];
    }
}
