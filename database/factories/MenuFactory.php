<?php

namespace Database\Factories;


use App\Models\Post;
use App\Models\Menu;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Menu>
 */
class MenuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'post_id' => Post::factory(), // Associate menu with a post
            'dish_name' => $this->faker->word(),
            'dish_type' => $this->faker->randomElement(['Starter', 'Main', 'Dessert']),
            'options' => $this->faker->optional()->randomElement(['Vegetarian', 'Vegan', 'Gluten-Free']),
        ];
    }
}
