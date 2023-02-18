<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
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
     * @return Application|Factory|View
     */
    public function index()
    {
        $roles = Role::query()->withCount('users')->get();

//        dd($roles);

        return view('admin.roles.index', compact('roles'));
    }

    public function users(Role $role)
    {
        $role->load('users');

        return view('admin.roles.users', compact('role'));
    }

//    public function show(Role $role)
//    {
////        $permission_groups = Permission::all()->groupBy('group_name');
//
//        $sql = "SELECT permission_id FROM role_has_permissions WHERE role_id = ". $role->id;
//        $role_permissions = collect(DB::select($sql))->unique()->pluck('permission_id')->toArray();
//
//        return view('admin.roles.roles_has_permissions', compact(['permission_groups', 'role_permissions', 'role']));
//    }
}
