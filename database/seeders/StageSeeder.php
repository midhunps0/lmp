<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Stage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clients=Client::all();
        $stages = config('default.defaultStages');
        foreach($clients as $client){
            foreach ($stages as $stage) {
                Stage::firstOrCreate([
                    'stages' => $stage,
                    'client_id'=>$client->id
                ]);
            }
        }
    }
}
