<?php

namespace Database\Seeders;

use App\Models\Segment;
use App\Models\Client;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SegmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clients=Client::all();
        $segments = config('default.defaultSegments');
        foreach($clients as $client){
            foreach ($segments as $segment) {
                Segment::create([
                    'segments' => $segment,
                    'client_id'=>$client->id,
                ]);
            }
        }
        
    }
}
