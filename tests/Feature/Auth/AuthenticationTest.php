<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Support\Facades\Hash;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_users_can_authenticate_using_the_login_screen(): void
    {
        $user = User::factory()->create([
            'email' => 'john@example.com',
            'password' => bcrypt('password'),
        ]);

        $response = $this->postJson('/api/login', [
            'email' => 'john@example.com',
            'password' => 'password',
        ]);

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'user' => [
                    'id', 'name', 'email', 'created_at', 'updated_at'
                ],
                'token'
            ]);
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
    // public function test_login_fails_with_non_existent_email(): void
    // {
    //     $response = $this->postJson('/api/login', [
    //         'email' => 'nonexistent@example.com',
    //         'password' => 'password',
    //     ]);

    //     $response->assertStatus(401)
    //     ->assertJson(['message' => 'The provided credentials are incorrect.']);
    // }

    
    // public function test_can_logout_a_user(): void
    // {
    // $user = User::factory()->create();
    // $token = $user->createToken('TestToken')->plainTextToken;

    // $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token])
    //                  ->postJson('/api/logout');

    // $response->assertStatus(200)
    //          ->assertJson(['message' => 'You are logged out.']);
    // }


    public function test_can_fetch_user_data()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $response = $this->getJson('/api/user');

        $response->assertStatus(200)
                 ->assertJson([
                     'id' => $user->id,
                     'name' => $user->name,
                     'email' => $user->email,
                 ]);
    }
    public function test_guest_cannot_access_protected_routes()
    {
        $response = $this->getJson('/api/user');

        $response->assertStatus(401);
    }
    public function test_can_get_authenticated_user()
    {
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
        ]);

        $token = $user->createToken('Test Token')->plainTextToken;

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token])
                         ->getJson('/api/user');

        $response->assertStatus(200)
                 ->assertJsonStructure(['id', 'name', 'email']);
    }





    // public function test_login_fails_with_missing_email_and_password(): void
    // {
    //     $response = $this->post('/login', []);

    //     $response->assertSessionHasErrors(['email', 'password']);
    // }
    // public function test_login_fails_with_inactive_user(): void
    // {
    //     $user = User::factory()->create(['active' => false]);

    //     $response = $this->post('/login', [
    //         'email' => $user->email,
    //         'password' => 'password',
    //     ]);

    //     $response->assertSessionHasErrors('email');
    // }

    // public function test_login_fails_with_unverified_email(): void
    // {
    //     $user = User::factory()->create(['email_verified_at' => null]);

    //     $response = $this->post('/login', [
    //         'email' => $user->email,
    //         'password' => 'password',
    //     ]);

    //     $response->assertSessionHasErrors('email');
    // }
    
}
