<?php

namespace Database\Factories;


use App\Models\Guest;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Guest>
 */
class GuestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'posts_id' => Post::factory(), 
            'name' => fake()->name(), 
            'email' => fake()->safeEmail(), 
            'status' => fake()->randomElement(['waiting', 'confirmed', 'declined']), 
            'status_updated_at' => fake()->optional()->dateTime(),
        ];
    }
}
