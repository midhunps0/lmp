<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Template>
 */
class TemplateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $client=Client::inRandomOrder()->first();

        $type=fake()->randomElement( ['welcome email','followup email','proposal template','SMS template']);
        $body = '';
        
        switch ($type) {
            case 'welcome email':
                $body = "A warm welcome to {$client->name}. We are thrilled to have you on board. Here's some information about our services and a special offer for new clients.";
                break;
            case 'followup email':
                $body = "Hi {$client->name}, it's been a week since our last conversation. We hope you're doing well. We'd like to discuss how our solutions can benefit your business. Are you available for a call this week?";
                break;
            case 'proposal template':
                $body = "Dear {$client->name}, attached is a proposal outlining our IT services and pricing. We are confident that our solutions will meet your needs. Please review the proposal and let us know your thoughts.";
                break;
            case 'SMS template':
                $body = "Hi {$client->name}, don't forget our meeting tomorrow at 2 PM. We look forward to discussing your marketing strategy.";
                break;
            default:
                break;
        }
        return [
            'client_id'=>$client->id,
            'name'=>"Welcome".$client->name,
            'body'=>$body,
            'type'=>$type,
            'status'=>fake()->randomElement(['submitted','approved']),
        ];
    }
}

