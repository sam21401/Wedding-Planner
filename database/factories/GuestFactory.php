<?php

namespace Database\Factories;

use App\Models\Guest;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class GuestFactory extends Factory
{
    protected $model = Guest::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => fake()->firstName(),
            'surname' => fake()->lastName(),
            'phone' => fake()->optional()->phoneNumber(),
            'email' => fake()->unique()->safeEmail(),
            'status' => fake()->randomElement(['Confirmed', 'Pending', 'Declined']),
            'token' => fake()->optional()->uuid(),
            'user_id' => User::factory(), 
        ];
    }
}
