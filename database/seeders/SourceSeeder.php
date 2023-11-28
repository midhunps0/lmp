<?php

namespace Database\Seeders;

use App\Models\Source;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Client;
class SourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clients=Client::all();
        
        $sources=['Social Media','Direct Marketing',
        "Content Marketing","Customer Reviews/Testimonials",
        "Word of Mouth"];

        foreach ($clients as $client) {
            foreach($sources as $source){
                Source::create([
                    "sources"=>$source,
                    'client_id'=>$client->id,
                ]);
            }
        }
}
}