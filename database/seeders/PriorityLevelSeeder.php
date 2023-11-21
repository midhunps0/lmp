<?php

namespace Database\Seeders;

use App\Models\PriorityLevel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PriorityLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $priorities=["low","medium","high"];
        foreach($priorities as $priority){
            PriorityLevel::create([
                'level'=>$priority,
            ]);
        }
    }
}
