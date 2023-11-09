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
        ->hasusers(10)
        ->hasstage()
        ->hassegments(3)
        ->hastemplates()
        ->hasnotifications()
        ->haspayments()
        ->count(20)
        ->create()
        ->each(function ($client) {
            $client->leads()->saveMany(Lead::factory(20)->create()->each(function ($lead) {
                
                $lead->followups()->saveMany(FollowUp::factory(10)->create());
                 
                $lead->appoiments()->saveMany(Appoiment::factory(5)->create());
                
                
                $lead->contacts()->saveMany(Contact::factory(2)->create()
                ->each(function ($contact){
                    $contact->numbers()->saveMany(Number::factory(2)->create());
                    $contact->emails()->saveMany(Email::factory(2)->create());
                }));

                $lead->chats()->saveMany(Chat::factory(2)->create());
                
            }
            
        ));
        });

        Client::factory()
        ->hasbranch(5)
        ->hasusers(20)
        ->hasstage()
        ->hassegments(4)
        ->hastemplates()
        ->hasnotifications()
        ->haspayments()
        ->count(15)
        ->create()
        ->each(function ($client) {
            $client->leads()->saveMany(Lead::factory(30)->create()->each(function ($lead) {
                
                $lead->followups()->saveMany(FollowUp::factory(20)->create());
                 
                $lead->appoiments()->saveMany(Appoiment::factory(15)->create());
                
                
                $lead->contacts()->saveMany(Contact::factory(5)->create()
                ->each(function ($contact){

                    $contact->numbers()->saveMany(Number::factory(2)->create());

                    $contact->emails()->saveMany(Email::factory(2)->create());
                }));

                $lead->chats()->saveMany(Chat::factory(3)->create());
             
            }));
        });

        Client::factory()
        ->hasbranch(3)
        ->hasusers(20)
        ->hasstage()
        ->hassegments(2)
        ->hastemplates()
        ->hasnotifications()
        ->haspayments()
        ->count(30)
        ->create()
        ->each(function ($client) {
            $client->leads()->saveMany(Lead::factory(25)->create()->each(function ($lead) {
                
                $lead->followups()->saveMany(FollowUp::factory(20)->create());

                
                $lead->appoiments()->saveMany(Appoiment::factory(3)->create());
                
                
                $lead->contacts()->saveMany(Contact::factory(5)->create()
                ->each(function ($contact){

                    $contact->numbers()->saveMany(Number::factory(2)->create());

                    $contact->emails()->saveMany(Email::factory(2)->create());
                }));

                $lead->chats()->saveMany(Chat::factory(4)->create());
               
            }));
        });

        Client::factory()
        ->hasusers(20)
        ->hasstage()
        ->hassegments(1)
        ->hastemplates()
        ->count(35)
        ->create()
        ->each(function ($client) {
            $client->leads()->saveMany(Lead::factory(25)->create()->each(function ($lead) {
                
                $lead->followups()->saveMany(FollowUp::factory(5)->create());
                 
                $lead->appoiments()->saveMany(Appoiment::factory(10)->create());
                
                
                $lead->contacts()->saveMany(Contact::factory(4)->create()
                ->each(function ($contact){

                    $contact->numbers()->saveMany(Number::factory(2)->create());

                    $contact->emails()->saveMany(Email::factory(2)->create());
                }));

                $lead->chats()->saveMany(Chat::factory(2)->create());
                
            }));
        });
        
    }
}
