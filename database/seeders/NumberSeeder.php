<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Contact;
use App\Models\Number;

class NumberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $contacts=Contact::all();
        foreach($contacts as $contact){
            for($i=0;$i<2;$i++){
                Number::create([
                    'contact_id'=>$contact->id,
                    'phone'=>fake()->phoneNumber,
                    'watsup_enabled'=>fake()->randomElement([true, false]),
                ]);
            }
        }
    }
}
