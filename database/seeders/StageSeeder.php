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
        
        $stages = ["Created","Enquiry", "lead", "folllowup", "cancelled", "approved"];
        
        foreach ($stages as $stage) {
            Stage::create([
                'stages' => $stage,
            ]);
        }
    }
}
