<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Chat;
use App\Models\Lead;

class ChatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $leads=Lead::all();
       
        foreach ($leads as $lead){
           Chat::create([
            'lead_id'=>$lead->id,
            'message'=>'Hi,we have new products launched!!',
            'type'=>'text',
            'direction'=>fake()->randomElement(["Inbound","Outbound"]),
            'status'=>fake()->randomElement(["Sent","Read","Delivered"]),
            'warmid'=>fake()->randomElement(["Hot","Cold"]),
            'expiration_time'=>fake()->dateTimeBetween(now()->addDay(),now()->addDays(2))
           ]);
        }
    }
}
