<?php

namespace Database\Seeders;

use App\Models\Authenticable;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call(StageSeeder::class);
        $this->call(SegmentSeeder::class);
        $this->call(SourceSeeder::class);
        $this->call(TagSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(SubscriptionModelSeeder::class);
        $this->call(SubscriptionSeeder::class);
        $this->call(ClientSeeder::class);
        Authenticable::factory()->count(100)->create();
        $this->call(RemarkSeeder::class);
        //$this->call(LeadSeeder::class);
        //$this->call(AppoimentSeeder::class);
        //$this->call(ContactSeeder::class);
    }
}
