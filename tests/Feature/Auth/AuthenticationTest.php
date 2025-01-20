<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_users_can_authenticate_using_the_login_screen(): void
    {
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertNoContent();
    }

    public function test_users_can_not_authenticate_with_invalid_password(): void
    {
        $user = User::factory()->create();

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
    }
    public function test_users_can_not_authenticate_with_invalid_email(): void
    {
        $user = User::factory()->create();

        $this->post('/login', [
            'email' => 'wrong-email@example.com',
            'password' => 'password',
        ]);

        $this->assertGuest();
    }
    public function test_login_fails_with_non_existent_email(): void
    {
        $response = $this->post('/login', [
            'email' => 'nonexistent@example.com',
            'password' => 'password',
        ]);

        $response->assertSessionHasErrors('email');
    }
    public function test_users_can_logout(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/logout');

        $this->assertGuest();
        $response->assertNoContent();
    }
    public function test_user_can_login_with_remember_me(): void
    {
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
            'remember' => true,
        ]);

        $this->assertAuthenticated();
        $response->assertNoContent();
        $this->assertNotNull($response->headers->getCookies()[0]->getExpiresTime());
    }
    public function test_login_fails_with_missing_email(): void
    {
        $response = $this->post('/login', [
            'password' => 'password',
        ]);

        $response->assertSessionHasErrors('email');
    }

    public function test_login_fails_with_missing_password(): void
    {
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
        ]);

        $response->assertSessionHasErrors('password');
    }

    public function test_login_fails_with_missing_email_and_password(): void
    {
        $response = $this->post('/login', []);

        $response->assertSessionHasErrors(['email', 'password']);
    }
    public function test_login_fails_with_inactive_user(): void
    {
        $user = User::factory()->create(['active' => false]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertSessionHasErrors('email');
    }

    public function test_login_fails_with_unverified_email(): void
    {
        $user = User::factory()->create(['email_verified_at' => null]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertSessionHasErrors('email');
    }
}
