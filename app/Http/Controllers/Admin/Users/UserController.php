<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\Admin\Users\UserUpdateRequest;
use App\Http\Requests\Admin\Users\UserStoreRequest;
use Illuminate\Http\RedirectResponse;

final class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

        // this would lock the registration of new users to only admins and super-admins
        // idk what this app is for, so I'm not sure if this is what you want
        $this->authorizeResource(User::class, 'user');
    }

    public function index(): mixed
    {
        $users = User::paginate(config('admin.users.paginate_count', 15))
                        ->withQueryString();

        return view('admin.users.index', compact('users'));
    }

    public function create(): mixed
    {
        return view('admin.users.create');
    }

    public function store(UserStoreRequest $request): mixed
    {
        $user = User::create($request->validated());

        // Do we want to go directly to users index page?

        // return redirect()
        //     ->route('admin.users.index')
        //     ->with('success', 'User created successfully.');

        // Do we want to go directly to the user's edit page?

        return redirect()
            ->route('admin.users.show', $user)
            ->with('success', 'User created successfully.');
    }

    public function show(User $user): mixed
    {
        return view('admin.users.show', ['user' => $user]);
    }

    public function edit(User $user): mixed
    {
        return view('admin.users.edit', ['user' => $user]);
    }

    public function update(UserUpdateRequest $request, User $user): mixed
    {
        $user->update($request->validated());

        return redirect()
            ->route('admin.users.show', $user)
            ->with('success', 'User updated successfully.');
    }

    public function destroy(User $user): mixed
    {
        $user->delete();

        return redirect()
            ->route('users.index')
            ->with('success', 'User deleted successfully.');
    }
}
