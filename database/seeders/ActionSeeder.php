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
        $clients=Client::all();
        foreach($clients as $client){
            Action::create([
                'client_id'=>$client->id,
                'name'=>fake()->randomElement(["Followup started","Appoinments scheduled","lead created"]),
                'location'=>fake()->address
            ]);
        }
    }
}
