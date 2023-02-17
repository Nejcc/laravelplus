<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PermissionController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $permission_groups = Permission::all()->groupBy('group_name');

        $role_id = auth()->user()->roles->first()->id;

        $sql = "SELECT permission_id FROM role_has_permissions WHERE role_id = ". $role_id;
        $user_permissions = collect(DB::select($sql))->unique()->pluck('permission_id')->toArray();


        return view('admin.permissions.index', compact(['permission_groups', 'user_permissions']));
    }
}
