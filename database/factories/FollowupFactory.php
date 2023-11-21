<?php

namespace Database\Factories;

use App\Models\Lead;
use App\Models\User;
use App\Models\Action;
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
       
        $lead = Lead::inRandomOrder()->first();
        //$user = $lead::users()->inRandomOrder()->first();
    
        return [
            'lead_id' =>  $lead->id,
            'user_id' =>  $lead->user_id,
            'created_by' => $lead->user_id,
            'action_id' =>   Action::inRandomOrder()->first()->id,
            'scheduled_date' => now()->addDays(random_int(0, 5)),
            'actual_date' => now()->addDays(random_int(5, 15)),
            'next_followup_date'=> now()->addDays(random_int(16, 30)),
        ];
    }

}
