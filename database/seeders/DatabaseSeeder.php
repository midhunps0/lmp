<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call(AdminSeeder::class);
        $this->call(SubscriptionModelSeeder::class);
        $this->call(SubscriptionSeeder::class);
        $this->call(ClientSeeder::class);
        $this->call(AuthenticableSeeder::class);
        $this->call(RemarkSeeder::class);
        //$this->call(LeadSeeder::class);
        //$this->call(AppoimentSeeder::class);
        //$this->call(ContactSeeder::class);
    }
}
