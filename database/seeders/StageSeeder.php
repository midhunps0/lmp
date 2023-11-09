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
        $client = Client::inRandomOrder()->first();
        $stages = ["Enquiry", "lead", "folllowup", "cancelled", "approved"];
        
        foreach ($stages as $stage) {
            Stage::create([
                'client_id' => $client->id,
                'stages' => $stage,
            ]);
        }
    }
}
