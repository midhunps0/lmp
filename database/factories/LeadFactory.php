<?php

namespace Database\Factories;

use App\Models\Branch;
use App\Models\Client;
use App\Models\Segment;
use App\Models\Stage;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lead>
 */
class LeadFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $leadType = fake()->randomElement(['Individual', 'Business']);
        $name = ($leadType == "Individual") ? fake()->name : fake()->company;
        
        return [
            'client_id'=>Client::inRandomOrder()->first()->id,
            'branch_id'=>Branch::inRandomOrder()->first()->id,
            'stage_id'=>Stage::inRandomOrder()->first()->id,
            'segment_id'=>Segment::inRandomOrder()->first()->id,
            'user_id'=>User::inRandomOrder()->first()->id,
            'leadable_type'=>$leadType,
            'name'=> $name,
            'notes'=>"You're notes here.."
        ];
    }
}
