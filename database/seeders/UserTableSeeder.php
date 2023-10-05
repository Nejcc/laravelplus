<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

final class UserTableSeeder extends Seeder
{
    private $roles = ['super-admin', 'admin', 'editor', 'writer', 'translator', 'power user', 'user'];

    private $permissionsOnGroup = [
        'super-admin' => [
            'view'   => [
                'user',
                'sitemap',
                'role',
                'permission',
            ],
            'create' => [
                'permission',
                'sitemap',
                'user',
                'role',
            ],
            'update' => [
                'permission',
                'sitemap',
                'user',
                'role',
            ],
            'delete' => [
                'permission',
                'sitemap',
                'user',
                'role',

            ],
        ],
        'admin'       => [
            'view'   => [
                'user',
                'sitemap',
                'role',
                'permission',
            ],
            'create' => [
                'permission',
                'sitemap',
                'user',
                'role',
            ],
            'update' => [
                'permission',
                'sitemap',
                'user',
                'role',
            ],
            'delete' => [
                'sitemap',
                'user',
            ],
        ],
        'user'        => [],
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->generateAllRoles();
        $this->generateAllUsers();
    }

    private function generateAllRoles(): void
    {
        //        $god = Role::create(['name' => 'super-admin']);

        foreach ($this->roles as $role) {
            $roleSlug = Str::slug($role);
            $newRole = Role::create(['name' => $role, 'slug' => $roleSlug]);
            if (!empty($this->permissionsOnGroup[$role])) {
                foreach ($this->permissionsOnGroup[$role] as $key => $permission) {
                    if (!empty($permission[0])) {
                        foreach ($permission as $p) {
                            $permissionSlug = Str::slug("{$key} {$p}");
                            $newPermission = Permission::updateOrCreate(['name' => "{$key} {$p}", 'slug' => $permissionSlug, 'group_name' => $p]);
                            $newRole->givePermissionTo($newPermission);
                        }
                    }
                }
            }
        }
    }

    private function GenerateAllUsers(): void
    {
        $users = [
            ['name' => 'Admin', 'username' => 'admin', 'email' => null, 'password' => 'admin', 'role' => 'super-admin'],
            ['name' => 'Paweł Kuna', 'username' => 'pawel', 'email' => null, 'password' => 'codecalm', 'role' => 'super-admin'],
            ['name' => 'user', 'username' => 'user', 'email' => null, 'password' => 'user', 'role' => 'user'],
            ['name' => 'neic', 'username' => 'neic', 'email' => null, 'password' => 'secret', 'role' => 'super-admin'],
        ];

        foreach ($users as $user) {
            $user_object = User::create([
                'name'     => $user['name'],
                'username' => $user['username'],
                'email'    => $this->generateUserEmailAddress($user),
                'password' => $this->generateUserPassword($user),
            ]);

            $user_object->assignRole($user['role']);
        }
    }

    private function generateUserEmailAddress($user)
    {
        if ($user['email'] === null) {
            return $user['username'].'@'.config('app.domain');
        }

        return $user['email'];
    }

    private function generateUserPassword($user)
    {
        if ($user['password'] === null) {
            return bcrypt($user['username'].config('auth.password_default'));
        }

        return bcrypt($user['password']);
    }
}
