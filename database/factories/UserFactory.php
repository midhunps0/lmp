<?php

namespace Database\Factories;

use App\Models\Branch;
use App\Models\Client;
use App\Models\Designation;
use Hash;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /** 
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $client=Client::inRandomOrder()->first();
        return [
            'name' => fake()->name,
            'email' => fake()->email,
            'email_verified_at' => now(),
            'password' => Hash::make('abcd1234'),
            'remember_token' => Str::random(10),

            'client_id'=>$client->id,
            'branch_id'=> function (array $attributes) {
                $client = Client::find($attributes['client_id']);
                return $client->branch()->inRandomOrder()->first()->id;
            },
            'designation_id'=>Designation::inRandomOrder()->first()->id,
            'phone'=>fake()->phoneNumber,
            
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
