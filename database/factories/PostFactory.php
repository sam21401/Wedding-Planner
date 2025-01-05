<?php

namespace Database\Factories;


use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'title' => fake()->sentence(),
            'description' => fake()->optional()->paragraph(),
            'wedding_date' => fake()->optional()->date(),
            'venue_name' => fake()->optional()->company(),
            'venue_address' => fake()->optional()->address(),
            'latitude' => fake()->optional()->latitude(),
            'longitude' => fake()->optional()->longitude(),
            'theme' => fake()->optional()->word(),
            'estimated_cost' => fake()->optional()->randomFloat(2, 1000, 100000),
            'dress_code' => fake()->optional()->word(),
            'food_options' => fake()->optional()->randomElement(['Vegetarian', 'Vegan', 'Non-Vegetarian']),
            'rsvp_deadline' => fake()->optional()->date(),
            'transportation_notes' => fake()->optional()->text(),
            'gifts' => fake()->optional()->text(),
            'music_type' => fake()->optional()->word(),
            'host' => fake()->optional()->name(),
            'with_children' => fake()->boolean(),
        ];
    }
}
