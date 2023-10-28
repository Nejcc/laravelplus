<?php

declare(strict_types=1);

namespace App\Policies\Admin\Users;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

final class UserPolicy {
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        $currentUser = auth()->user();
        return $currentUser->is($user) || $currentUser->hasRole([
            'super-admin',
            'admin'
        ]);
    }

    public function view(User $user): bool
    {
        $currentUser = auth()->user();
        return $currentUser->is($user) || $currentUser->hasRole([
            'super-admin',
            'admin'
        ]);
    }

    public function create(User $user): bool
    {
        $currentUser = auth()->user();
        return $currentUser->is($user) || $currentUser->hasRole([
            'super-admin',
            'admin'
        ]);
    }

    public function restore(User $user): bool
    {
        $currentUser = auth()->user();
        return $currentUser->is($user) || $currentUser->hasRole([
            'super-admin',
            'admin'
        ]);
    }

    public function forceDelete(User $user): bool
    {
        $currentUser = auth()->user();
        return $currentUser->is($user) || $currentUser->hasRole([
            'super-admin',
            'admin'
        ]);
    }

    public function delete(User $user): bool {
        $currentUser = auth()->user();
        return $currentUser->is($user) || $currentUser->hasRole([
            'super-admin',
            'admin'
        ]);
    }

    public function store(User $user): bool {
        $currentUser = auth()->user();
        return $currentUser->is($user) || $currentUser->hasRole([
            'super-admin',
            'admin'
        ]);
    }

    public function update(User $user): bool {
        $currentUser = auth()->user();

        return $currentUser->id === $user->id || $currentUser->hasRole([
            'super-admin',
            'admin'
        ]);
    }
}


