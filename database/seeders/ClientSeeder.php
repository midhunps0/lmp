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
        ->hasusers(5)
        ->hastemplates()
        ->hasnotifications()
        ->haspayments()
        ->count(20)
        ->create()
        ->each(function ($client) {
            $client->action()->save( Action::factory()->create() );
            // $client->branch->each(function ($branch) use ($client){
            //     $branchAdmin = $branch->users->first();
            //     $branchAdmin->assignRole('Branch Admin');
            //     $branch->users->each(function ($user) use ($branchAdmin) {
            //         if ($user->id !== $branchAdmin->id) {
            //             $user->assignRole('Executive');
            //         }
            //     });
            // });

            $client->users->each(function ($user) {
                $user->leads()->saveMany(
                    Lead::factory(5)->create()->each(function ($lead) use ($user) {
                        $lead->update(['client_id' => $user->client_id, 'branch_id' => $user->branch_id]);
                        
            
                        $lead->contacts()->saveMany(
                            Contact::factory(2)->create()->each(function ($contact) {
                                $contact->numbers()->saveMany(Number::factory(2)->create());
                                $contact->emails()->saveMany(Email::factory(2)->create());
                            })
                        );
            
                        $lead->chats()->saveMany(Chat::factory(2)->create());

                        
                    })
                );
            });
            
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
