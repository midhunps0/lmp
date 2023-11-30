<?php

namespace Database\Seeders;

use App\Models\Lead;
use App\Models\Client;
use App\Models\User;
use App\Models\Segment;
use App\Models\Stage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LeadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   
        $users=User::whereNotNull('branch_id')->get();

        foreach($users as $user){
            
            $leadType = fake()->randomElement(['Individual', 'Business']);
            $name = ($leadType == "Individual") ? fake()->name : fake()->company;
            Lead::create([
            'client_id'=>$user->client_id,
            'branch_id'=>$user->branch_id,
            'stage_id'=>Stage::inRandomOrder()->first()->id,
            'segment_id'=>Segment::inRandomOrder()->first()->id,
            'user_id'=>$user->id,
            'leadable_type'=>$leadType,
            'name'=> $name,
            'notes'=>"You're notes here.."

            ]);
        }
        
    }
}
