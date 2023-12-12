<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Action;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class ActionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $actions=config('default.defaultActions');
        $clients=Client::all();
        foreach($clients as $client){
            foreach($actions as $action){
                Action::create([
                    'client_id'=>$client->id,
                    'name'=>$action,
                    'location'=>fake()->address
                ]);
            }
            
        }
    }
}
