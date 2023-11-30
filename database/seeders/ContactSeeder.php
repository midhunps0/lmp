<?php

namespace Database\Seeders;

use App\Models\Contact;
use App\Models\Lead;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $leads=Lead::all();
        
        foreach($leads as $lead){

            for ($i = 0; $i < 2; $i++) {
                Contact::create([
                    'lead_id'=>$lead->id,
                    'name'=> $lead->name,
                ]);
            }
        }
        
    }
}
