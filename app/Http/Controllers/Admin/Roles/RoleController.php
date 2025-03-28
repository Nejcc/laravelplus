<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin\Roles;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

final class RoleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View|Factory|Application
    {
        $roles = Role::query()->withCount('users')->get();

        //        dd($roles);

        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View|Factory|Application
    {
        return view('admin.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name',
            'description' => 'nullable|string|max:255',
        ]);

        Role::create($request->all());

        return redirect()->route('admin.roles.index')
            ->with('success', __('Role created successfully.'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role): View|Factory|Application
    {
        $permission_groups = DB::table('permissions')
            ->select('group_name')
            ->distinct()
            ->get();

        $role_permissions = $role->permissions->pluck('id')->toArray();

        return view('admin.roles.roles_has_permissions', compact('permission_groups', 'role_permissions', 'role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role): View|Factory|Application
    {
        return view('admin.roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $role->id,
            'description' => 'nullable|string|max:255',
        ]);

        $role->update($request->all());

        return redirect()->route('admin.roles.index')
            ->with('success', __('Role updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role): RedirectResponse
    {
        $role->delete();

        return redirect()->route('admin.roles.index')
            ->with('success', __('Role deleted successfully.'));
    }

    /**
     * Display the users for the specified role.
     */
    public function users(Role $role): View|Factory|Application
    {
        $role->load('users');

        return view('admin.roles.users', compact('role'));
    }
}
