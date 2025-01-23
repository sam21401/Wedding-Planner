<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Password;
use Tests\TestCase;

class PasswordResetTest extends TestCase
{
    use RefreshDatabase;

    // public function test_can_send_password_reset_link()
    // {
    //     $user = \App\Models\User::factory()->create();  // Użycie fabryki do stworzenia testowego użytkownika

    //     $response = $this->postJson(route('password.email'), [
    //         'email' => $user->email,
    //     ]);

    //     $response->assertStatus(200); // Oczekujemy statusu 200
    //     $response->assertJson([
    //         'status' => 'We have emailed your password reset link!',
    //     ]);
    // }

    // public function test_invalid_email_for_password_reset()
    // {
    //     $response = $this->postJson(route('password.email'), [
    //         'email' => 'invalid@example.com',
    //     ]);

    //     $response->assertStatus(400); // Błędny e-mail powinien zwrócić 400
    //     $response->assertJsonValidationErrors('email');
    // }
    // public function test_can_reset_password_with_valid_token()
    // {
    //     $user = \App\Models\User::factory()->create();

    //     // Tworzymy token resetowania
    //     $token = \Password::createToken($user);

    //     $response = $this->postJson(route('password.store'), [
    //         'email' => $user->email,
    //         'token' => $token,
    //         'password' => 'newpassword123',
    //         'password_confirmation' => 'newpassword123',
    //     ]);

    //     $response->assertStatus(200);
    //     $response->assertJson([
    //         'status' => 'Password has been reset successfully.',
    //     ]);
    // }

    /** @test */
    // public function test_reset_password_with_invalid_token()
    // {
    //     $user = \App\Models\User::factory()->create();

    //     $response = $this->postJson(route('password.store'), [
    //         'email' => $user->email,
    //         'token' => $token = 'invalid',
    //         'password' => 'newpassword123',
    //         'password_confirmation' => 'newpassword123',
    //     ]);

    //     $response->assertStatus(400); // Token jest niepoprawny
    //     $response->assertJsonValidationErrors('email');
    // }
    /** @test */
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

    // public function test_password_reset_fails_without_token(): void
    // {
    //     $user = User::factory()->create();

    //     $response = $this->post('/reset-password', [
    //         'email' => $user->email,
    //         'password' => 'password',
    //         'password_confirmation' => 'password',
    //     ]);

    //     $response->assertSessionHasErrors('token');
    // }
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
