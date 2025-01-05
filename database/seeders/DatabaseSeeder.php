<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use function Laravel\Prompts\password;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $user = User::firstOrNew([
            'email' => "test@test.pl",
        
        ]);

        $user->password = Hash::make('test@test.pl');
        $user->remember_token = Str::random(10);
        $user->name = fake()->name();
        $user->email_verified_at = now(); 
        $user->save();


        $this->call([
            MenuSeeder::class,
            PostSeeder::class,
            CollaboratorSeeder::class,
            GuestSeeder::class,
            TaskSeeder::class,
            TaskNoteSeeder::class,
        ]);
    }
}
