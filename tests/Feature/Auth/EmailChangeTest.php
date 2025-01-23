<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EmailChangeTest extends TestCase
{
    use RefreshDatabase;

    // /** @test */
    // public function it_can_change_user_email()
    // {
    //     $user = \App\Models\User::factory()->create();
    //     $this->actingAs($user);

    //     $response = $this->putJson('/api/user/email', [
    //         'email' => 'newemail@example.com',
    //     ]);

    //     $response->assertStatus(200);
    //     $response->assertJson(['message' => 'Email updated successfully']);

    //     $this->assertDatabaseHas('users', [
    //         'id' => $user->id,
    //         'email' => 'newemail@example.com',
    //     ]);
    // }
    // public function test_email_change_fails_with_invalid_email(): void
    // {
    //     $user = User::factory()->create();

    //     $response = $this->actingAs($user)->put('/email/change', [
    //         'email' => 'invalid-email',
    //     ]);

    //     $response->assertSessionHasErrors('email');
    // }
    // public function test_email_change_fails_with_missing_email(): void
    // {
    //     $user = User::factory()->create();

    //     $response = $this->actingAs($user)->put('/email/change', []);

    //     $response->assertSessionHasErrors('email');
    // }

    // public function test_email_change_fails_with_email_already_taken(): void
    // {
    //     $user = User::factory()->create();
    //     $existingUser = User::factory()->create(['email' => 'existing@example.com']);

    //     $response = $this->actingAs($user)->put('/email/change', [
    //         'email' => 'existing@example.com',
    //     ]);

    //     $response->assertSessionHasErrors('email');
    // }
    // public function test_email_change_fails_with_invalid_email_format(): void
    // {
    //     $user = User::factory()->create();

    //     $response = $this->actingAs($user)->put('/email/change', [
    //         'email' => 'invalid-email-format',
    //     ]);

    //     $response->assertSessionHasErrors('email');
    // }
}
