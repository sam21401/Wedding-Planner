<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Guest;
use App\Models\User;

class GuestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Retrieve existing users from the database
        $users = User::all();

        // Seed guests for each user
        foreach ($users as $user) {
            Guest::factory()->count(10)->create([
                'user_id' => $user->id, // Associate guests with a user
            ]);
        }
    }
}
