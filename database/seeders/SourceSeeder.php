<?php

namespace Database\Seeders;

use App\Models\Source;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sources=['Social Media','Direct Marketing',"Consulting","Ads"];
        foreach ($sources as $source) {
            Source::create([
                "sources"=>$source,
            ]);
    }
}
}