<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Contact;
use App\Models\Email;

class EmailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $contacts=Contact::all();
        foreach($contacts as $contact){
            for($i=0;$i<2;$i++){
                Email::create([
                    'contact_id'=>$contact->id,
                    'email'=>fake()->unique()->safeEmail,
                ]);
            }
        }
    }
}
