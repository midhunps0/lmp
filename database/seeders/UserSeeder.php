<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\User;
use App\Models\Client;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Designation;
use Illuminate\Support\Str;
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
            'branch_id'=>null,
            'designation_id'=>Designation::where('client_id',$client->id)->inRandomOrder()->first()->id,
            'phone'=>fake()->phoneNumber,
           ]);
           $clientAdmin->assignRole('Client Admin');

           $branches = $client->branch()->get();

           foreach($branches as $branch){
                $branchAdmin= User::create([
                    'name' => 'Branch manger '.$branch->id.' of client '.$client->id,
                    'email' => 'branch'.$branch->id.'ofclient'.$client->id.'user@gmail.com',
                    'email_verified_at' => now(),
                    'password' => Hash::make('abcd1234'),
                    'remember_token' => Str::random(10),
        
                    'client_id'=>$client->id,
                    'branch_id'=>$branch->id,
                    'designation_id'=>Designation::where('client_id',$client->id)->inRandomOrder()->first()->id,
                    'phone'=>fake()->phoneNumber,
                ]);
                $branchAdmin->assignRole('Branch Admin');

                for ($i = 0; $i < 10; $i++) {
                    
                    $executive = User::create([
                        'name' => fake()->name,
                        'email' => fake()->unique()->email,
                        'email_verified_at' => now(),
                        'password' => Hash::make('abcd1234'),
                        'remember_token' => Str::random(10),
                        'client_id' => $client->id,
                        'branch_id' => $branch->id,  // Adjust this if executives have a branch
                        'designation_id' => Designation::where('client_id', $client->id)->inRandomOrder()->first()->id,
                        'phone' => fake()->phoneNumber,
                    ]);
            
                    $executive->assignRole('Executive');
                }
                
            }

            
        }
    
    }
}
