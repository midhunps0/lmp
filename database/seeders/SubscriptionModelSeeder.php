<?php

namespace Database\Seeders;

use App\Models\SubscriptionModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubscriptionModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SubscriptionModel::factory()->count(3)->create();
    }
}
