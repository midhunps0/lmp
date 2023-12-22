<?php

namespace Database\Seeders;

use App\Models\Address;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users=User::all();
        foreach($users as $user){
           Address::create([
            'user_id'=>$user->id,
            'address_line1'=>fake()->address,
            'address_line2'=>fake()->address,
            'city'=>fake()->city,
            'state'=>fake()->country,
            'pincode'=>fake()->citySuffix,
            ]);
        }
    }
}
