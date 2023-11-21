<?php

namespace Database\Seeders;
use App\Models\Client;
use App\Models\ClientSubscription;
use App\Models\SubscriptionModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientSubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clients=Client::all();
        $models=SubscriptionModel::inRandomOrder()->first();
        $startDate = now()->addMonth(); // Start from next month
        $endDate = now()->addMonths(4);
        foreach ($clients as $client){
            ClientSubscription::create([
                'client_id'=>$client->id,
                'subscription_model_id'=>$models->id,
                'valid_till'=>fake()->dateTimeBetween($startDate,$endDate),
            ]);
        }

    }
}
