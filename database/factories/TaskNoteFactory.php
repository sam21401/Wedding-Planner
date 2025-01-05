<?php

namespace Database\Factories;


use App\Models\TaskNote;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TaskNote>
 */
class TaskNoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'task_id' => Task::factory(),
            'note' => fake()->word(50),
            'created_by' => User::factory(),
        ];
    }
}
