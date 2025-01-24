<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Password;
use Tests\TestCase;

class PasswordResetTest extends TestCase
{
    use RefreshDatabase;

    public function test_reset_password_with_valid_data()
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => Hash::make('OldPassword123'),
        ]);

        $token = Password::createToken($user);

        $response = $this->postJson('/api/reset-password', [
            'email' => 'test@example.com',
            'token' => $token,
            'password' => 'NewPassword123!',
            'password_confirmation' => 'NewPassword123!',
        ]);

        $response->assertStatus(200);
        $response->assertJson(['status' => trans(Password::PASSWORD_RESET)]);

        $this->assertTrue(Hash::check('NewPassword123!', $user->refresh()->password));
    }

    public function test_reset_password_with_invalid_token()
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => Hash::make('OldPassword123'),
        ]);

        $response = $this->postJson('/api/reset-password', [
            'email' => 'test@example.com',
            'token' => 'invalid-token',
            'password' => 'NewPassword123!',
            'password_confirmation' => 'NewPassword123!',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['email']);
    }
    public function test_reset_password_with_invalid_email()
    {
        $response = $this->postJson('/api/reset-password', [
            'email' => 'invalid@example.com',
            'token' => Str::random(60),
            'password' => 'NewPassword123!',
            'password_confirmation' => 'NewPassword123!',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['email']);
    }

    public function test_reset_password_with_mismatched_passwords()
    {
        $user = User::factory()->create();

        $token = Password::createToken($user);

        $response = $this->postJson('/api/reset-password', [
            'email' => $user->email,
            'token' => $token,
            'password' => 'NewPassword123!',
            'password_confirmation' => 'DifferentPassword!',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['password']);
    }
    public function test_passwords_must_match_for_reset()
    {
        $user = \App\Models\User::factory()->create();
        $token = \Password::createToken($user);

        $response = $this->postJson(route('password.store'), [
            'email' => $user->email,
            'token' => $token,
            'password' => 'newpassword123',
            'password_confirmation' => 'differentpassword123',
        ]);

        $response->assertStatus(422); // Błąd walidacji
        $response->assertJsonValidationErrors('password');
    }

    public function test_reset_password_with_missing_fields()
    {
        $response = $this->postJson('/api/reset-password', []);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['email', 'token', 'password']);
    }
    // public function test_reset_password_request_fails_with_invalid_email(): void
    // {
    //     $response = $this->post('/forgot-password', ['email' => 'nonexistent@example.com']);

    //     $response->assertSessionHasErrors('email');
    // }

    // public function test_reset_password_request_fails_with_invalid_email_format(): void
    // {
    //     $response = $this->post('/forgot-password', ['email' => 'invalid-email']);

    //     $response->assertSessionHasErrors('email');
    // }
}
