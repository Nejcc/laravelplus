<?php

declare(strict_types=1);

namespace Http\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

final class SwitchUserControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testRemoteUserLoginAs(): void
    {
        $this->withExceptionHandling();
        Role::create(['name' => 'super-admin', 'slug' => 'super-admin']);

        // Create two users to use for testing
        $mainUser = User::factory()->create();
        $mainUser->assignRole('super-admin');

        Role::create(['name' => 'user', 'slug' => 'user']);

        $switchUser = User::factory()->create();

        // Set up the request data
        $requestData = [
            'switch_user_to' => $switchUser->id,
            'main_user_id'   => $mainUser->id,
        ];

        // Send the request to the loginAs method
        $response = $this->actingAs($mainUser)->post('/admin/switch-user', $requestData);

        // Assert that the user was logged in and redirected to the home page
        $response->assertRedirect('/home');
        $this->assertTrue(auth()->check());
        $this->assertEquals($switchUser->id, auth()->id());
        $this->assertEquals($switchUser->id, session('switch_user_to'));
        $this->assertEquals($mainUser->id, session('main_user_id'));
    }

    public function testUserRemoteBack(): void
    {
        Role::create(['name' => 'super-admin', 'slug' => 'super-admin']);
// Create two users to use for testing
        $mainUser = User::factory()->create();
        $mainUser->assignRole('super-admin');

        Role::create(['name' => 'user', 'slug' => 'user']);
        $switchUser = User::factory()->create();
        $switchUser->assignRole('user');

        // Log in as the switch user
        auth()->loginUsingId($switchUser->id);

        // Set up the request data
        $requestData = [
            'main_user_id' => $mainUser->id,
        ];

        // Send the request to the back method
        $response = $this->actingAs($switchUser)->post('/switch-user-back', $requestData);

        // Assert that the user was logged in as the main user and redirected to the home page
        $response->assertRedirect('/home');
        $this->assertTrue(auth()->check());
        $this->assertEquals($mainUser->id, auth()->id());
        $this->assertNull(session('switch_user_to'));
        $this->assertNull(session('main_user_id'));
    }
}
