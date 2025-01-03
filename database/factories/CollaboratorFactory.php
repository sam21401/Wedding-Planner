<?php
namespace Database\Factories;

use App\Models\Collaborator;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Collaborator>
 */
class CollaboratorFactory extends Factory
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
        'user_id' => User::factory(), 
        'role' => fake()->randomElement(['organizer', 'assistant']),
        
        ];
    }
}