<?php

namespace Database\Seeders;

use App\Models\Appoiment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AppoimentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Appoiment::factory()->count(50)->create();
    }
}
