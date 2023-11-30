<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Client;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags=config('default.defaultTags');
        $clients=Client::all();
        foreach($clients as $client){
            foreach($tags as $tag){
                Tag::create([
                     'tags'=>$tag,
                     'client_id'=>$client->id
                ]);
            }
        }
    }
}
