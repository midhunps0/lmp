<?php

namespace Database\Seeders;

use App\Models\Appoiment;
use App\Models\Chat;
use App\Models\Client;
use App\Models\Contact;
use App\Models\Email;
use App\Models\Followup;
use App\Models\Lead;
use App\Models\Number;
use App\Models\User;
use App\Models\Action;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       
      

        Client::factory()
        ->hasbranch(2)
        ->hastemplates()
        ->count(20)
        ->create()
        ->each(function ($client) {
            $client->action()->save( Action::factory()->create() );
            
            });
        
            // $firstUser = $client->users->first();

            // if($firstUser){

            //     $client->update(['managing_person_id' => $firstUser->id]);
            //     $firstUser->update(['designation'=> 'Admin']);
            //     $firstUser->assignRole('Client Admin');

            // }
            // $remainingUsers = $client->users()->where('id', '<>', $firstUser->id)->get();

            // $remainingUsers->each(function ($user) {
            //     $user->assignRole('Client Executive');
            // });

            

            
            
       
        } 

        
    }
