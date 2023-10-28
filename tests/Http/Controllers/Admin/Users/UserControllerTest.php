<?php

declare(strict_types=1);

namespace Tests\Http\Controllers\Ajax\User\Notification;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Tests\TestCase;

final class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testAdminUsersIndex(): void
    {
        $admin = User::factory()
            ->admin()
            ->create();

        $response = $this->actingAs($admin)
            ->get(route('admin.users.index'));

        $response->assertOk();
        $response->assertViewIs('admin.users.index');
        $response->assertViewHas('users');
    }


    public function testAdminUsersStore(): void
    {
        $admin = User::factory()
            ->admin()
            ->create();

        $user = User::factory()
            ->make();

        $response = $this->actingAs($admin)
            ->post(route('admin.users.store'), $user->toArray());

        $response->assertOk();
        $response->assertViewIs('admin.users.show');
        $response->assertViewHas('user', $user);

        $this->assertDatabaseHas('users', $user->toArray());
    }

    public function testAdminUsersShow(): void
    {
        $admin = User::factory()
            ->admin()
            ->create();

        $user = User::factory()
            ->create();

        $response = $this->actingAs($admin)
            ->get(route('admin.users.show', $user));

        $response->assertOk();
        $response->assertViewIs('admin.users.show');
        $response->assertViewHas('user', $user);
    }

    public function testAdminUsersEdit(): void
    {
        $admin = User::factory()
            ->admin()
            ->create();

        $user = User::factory()
            ->create();

        $response = $this->actingAs($admin)
            ->get(route('admin.users.edit', $user));

        $response->assertOk();
        $response->assertViewIs('admin.users.edit');
        $response->assertViewHas('user', $user);
    }

    public function testAdminUsersUpdate(): void
    {
        $admin = User::factory()
            ->admin()
            ->create();

        $user = User::factory()
            ->create();

        $user2 = User::factory()
            ->make();

        $response = $this->actingAs($admin)
            ->patch(route('admin.users.store'), $user->toArray());

        $response->assertOk();
        $response->assertViewIs('admin.users.show');
        $response->assertViewHas('user', $user);

        $this->assertDatabaseHas('users', $user2->toArray());
    }

    public function testAdminUsersDelete(): void
    {
        $admin = User::factory()
            ->admin()
            ->create();

        $user = User::factory()
            ->create();

        $response = $this->actingAs($admin)
            ->delete(route('admin.users.destroy'), ['id' => $user->id]);

        $response->assertOk();
        $response->assertViewIs('admin.users.show');
        $response->assertViewHas('user', $user);

        $this->assertDatabaseMissing('users', $user->toArray());
        // or
        // $this->assertSoftDeleted('users', $user->toArray());
    }
}
