<?php

namespace Database\Seeders;

use App\Models\PriorityLevel;
use App\Models\Client;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PriorityLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clients=Client::all();
        $priorities = config('default.defaultPriorityLevel');
        foreach($clients as $client){
            foreach($priorities as $priority){
                PriorityLevel::create([
                    'level'=>$priority,
                    'client_id'=>$client->id,
                ]);
            }
        }
    }
}
