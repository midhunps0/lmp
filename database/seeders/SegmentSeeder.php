<?php

namespace Database\Seeders;

use App\Models\Segment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SegmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $segments = ["Hot","Warm","Cold"];
        
        foreach ($segments as $segment) {
            Segment::create([
                'segments' => $segment,
            ]);
        }
    }
}