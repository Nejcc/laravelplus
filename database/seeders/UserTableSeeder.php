<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;


class UserTableSeeder extends Seeder
{
    private $roles = ['admin', 'editor', 'writer', 'translator', 'power user', 'user'];
    private $permissionsOnGroup = [
        'admin' => [
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
        'user'  => [
        ]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->generateAllRoles();
        $this->generateAllUsers();
    }

    /**
     * @return void
     */
    private function generateAllRoles(): void
    {
        $god = Role::create(['name' => 'super-admin']);

        foreach ($this->roles as $role) {
            $newRole = Role::create(['name' => $role]);
            if (!empty($this->permissionsOnGroup[$role])) {
                foreach ($this->permissionsOnGroup[$role] as $key => $permission) {
                    if (!empty($permission[0])) {
                        foreach ($permission as $p) {
                            $newPermission = Permission::updateOrCreate(['name' => "{$key} {$p}", 'group_name' => $p]);
                            $newRole->givePermissionTo($newPermission);
                        }
                    }
                }
            }
        }
    }

    /**
     * @return void
     */
    private function GenerateAllUsers(): void
    {
        $users = [
            ['name' => 'Admin', 'username' => 'admin', 'email' => null, 'password' => null, 'role' => 'super-admin'],
            ['name' => 'user', 'username' => 'user', 'email' => null, 'password' => null, 'role' => 'user'],
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
            return $user['username'] . '@' . config('app.domain');
        }

        return $user['email'];
    }

    private function generateUserPassword($user)
    {
        if ($user['password'] == null) {
            return bcrypt($user['username'] . config('auth.password_default'));
        }

        return bcrypt($user['password']);
    }
}