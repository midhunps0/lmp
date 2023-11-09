<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Lead;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Remark>
 */
class RemarkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $remarkableTypes =fake()->randomElement( [Lead::class, Client::class]);
        return [
            'user_id'=>User::inRandomOrder()->first()->id,
            'remark'=>"potential customer",
            'remarkable_id'=>$remarkableTypes::inRandomOrder()->first()->id,
            'remarkable_type'=>$remarkableTypes,
        ];
    }
}
