<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Client;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Source>
 */
class SourceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        
        return [
            'sources'=>['Social Media','Direct Marketing',
            "Content Marketing","Customer Reviews/Testimonials",
            "Word of Mouth"],
            'client_id'=>Client::inRnadomOrder()->first()->id,
        ];
    }
}
