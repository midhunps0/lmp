<?php

namespace Database\Seeders;

use App\Models\Followup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Lead;
use App\Models\Action;

class FollowupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $leads=Lead::all();
       
        foreach ($leads as $lead){
           Followup::create([
            'lead_id' =>  $lead->id,
            'carried_out_by' =>  $lead->user_id,
            'created_by' => $lead->user_id,
            'action_id' =>   Action::inRandomOrder()->first()->id,
            'scheduled_date' => now()->addDays(random_int(0, 5)),
            'actual_date' => now()->addDays(random_int(5, 15)),
            'next_followup_date'=> now()->addDays(random_int(16, 30)),
           ]);
        }
    }
}
