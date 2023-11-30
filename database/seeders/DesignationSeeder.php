<?php

namespace Database\Seeders;

use App\Models\Designation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Client;

class DesignationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $designations=config('default.defaultDesignations');
        $clients=Client::all();
        foreach($clients as $client){
            foreach($designations as $designation){
                Designation::create([
                     'designation'=>$designation,
                     'client_id'=>$client->id
                ]);
            }
        }
    }
}
