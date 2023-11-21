<?php

namespace Database\Seeders;

use App\Models\Followup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Lead;

class FollowupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $leads=Lead::all();
       
        foreach ($leads as $lead){
            $lead->followups()->saveMany(
                Followup::factory(10)->create()->each(function ($followup) use ($lead) {
                        $followup->update(['lead_id' => $lead->id]);
                    })
                );
        }
    }
}
