<?php

namespace Database\Factories;

use App\Models\Lead;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Appoiment>
 */
class AppoimentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $leads=Lead::inRandomOrder()->first();
        return [
            'lead_id'=>$leads->id,
            'attending_person_id'=>User::inRandomOrder()->first()->id??null,
            'appoinment_date'=>fake()->dateTimeBetween(now()->addDays(2),now()->addDays(10)),
            'conducted_date'=>fake()->dateTimeBetween(now()->addDays(2),now()->addDays(10))
        ];
    }
}
