<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EmailChangeTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_change_email()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'sanctum')
            ->postJson('/api/user/email', [
                'email' => 'newemail@example.com',
            ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'email' => 'newemail@example.com',
        ]);
    }
    public function test_email_must_be_valid()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'sanctum')
            ->postJson('/api/user/email', [
                'email' => 'not-an-email',
            ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('email');
    }
    public function test_email_must_be_unique()
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        $response = $this->actingAs($user1, 'sanctum')
            ->postJson('/api/user/email', [
                'email' => $user2->email,
            ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('email');
    }

    public function test_guest_cannot_change_email()
    {
        $response = $this->postJson('/api/user/email', [
            'email' => 'guestemail@example.com',
        ]);

        $response->assertStatus(401); // Unauthorized
    }

    public function test_email_is_required()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'sanctum')
            ->postJson('/api/user/email', []);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('email');
    }

    public function test_cannot_change_to_same_email()
    {
        $user = User::factory()->create([
            'email' => 'currentemail@example.com',
        ]);

        $response = $this->actingAs($user, 'sanctum')
            ->postJson('/api/user/email', [
                'email' => 'currentemail@example.com',
            ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('email');
    }

    
}
