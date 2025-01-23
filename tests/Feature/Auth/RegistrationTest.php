<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_register()
    {
        $response = $this->postJson('/api/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'user' => [
                         'id', 'name', 'email', 'created_at', 'updated_at'
                     ],
                     'token'
                 ]);
    }
    public function test_validates_registration_data()
    {
        $response = $this->postJson('/api/register', []);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name', 'email', 'password']);
    }
    public function test_does_not_allow_duplicate_email()
    {
        User::create([
            'name' => 'Existing User',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
        ]);

        $response = $this->postJson('/api/register', [
            'name' => 'New User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['email']);
    }
    public function test_requires_password_confirmation()
    {
        $response = $this->postJson('/api/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'different_password',
        ]);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['password']);
    }
    public function test_requires_name_to_be_string()
    {
        $response = $this->postJson('/api/register', [
            'name' => '',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
    public function test_registration_fails_with_invalid_email(): void
{
    $response = $this->postJson('/api/register', [
        'name' => 'Test User',
        'email' => 'invalid-email',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $response->assertStatus(422)
             ->assertJsonValidationErrors(['email']);
}
    public function test_registration_fails_without_password_confirmation(): void
{
    $response = $this->postJson('/api/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
    ]);

    $response->assertStatus(422)
             ->assertJsonValidationErrors(['password']);
}

}
