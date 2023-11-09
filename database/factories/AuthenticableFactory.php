<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Authenticable>
 */
class AuthenticableFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user=User::inRandomOrder()->first();
        return [
            'authenticable_id'=>$user->id,
            'authenticable_type'=>User::class,
            'name'=>$user->name,
            'credentials'=>'Some credentials'
        ];
    }
}
