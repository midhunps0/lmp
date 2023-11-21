<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Client;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /**
         * @var User
         * 
         */
    
        $u = User::factory()->create(
            [
                'name' => 'System Admin',
                'email' => 'systemadmin@demo.com',
                'password' => Hash::make('abcd1234'),
                'phone'=>null,
                'client_id'=> null,
                'branch_id'=>null,
            ]
        );
        $u->assignRole('System Admin');
        $u = User::factory()->create(
            [
                'name' => 'Admin',
                'email' => 'admin@demo.com',
                'password' => Hash::make('abcd1234'),
                'phone'=>null,
                'client_id'=> null,
                'branch_id'=>null,
            ]
        );
        $u->assignRole('Admin');
        $clients=Client::all();
        foreach($clients as $client){
           $clientAdmin= User::create([
            'name' => 'client'.$client->id.'user',
            'email' => 'client'.$client->id.'user@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('abcd1234'),
            'remember_token' => Str::random(10),

            'client_id'=>$client->id,
            'branch_id'=> function (array $attributes) {
                $client = Client::find($attributes['client_id']);
                return $client->branch()->inRandomOrder()->first()->id;
            },
            'designation_id'=>Designation::inRandomOrder()->first()->id,
            'phone'=>fake()->phoneNumber,
           ]);
           $clientAdmin->assignRole('Client Admin');
        }
    }
}
