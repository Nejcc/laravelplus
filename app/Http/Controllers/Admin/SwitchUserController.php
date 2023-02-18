<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SwitchUserController extends Controller
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
     * @param Request $request
     * @return RedirectResponse
     */
    public function loginAs(Request $request)
    {
        $request->validate([
            'switch_user_to' => 'required|integer',
            'main_user_id'   => 'required|integer',
        ]);

        auth()->loginUsingId((int)$request->input('switch_user_to'), true);
        session()->put('switch_user_to', (int)$request->input('switch_user_to'));
        session()->put('main_user_id', (int)$request->input('main_user_id'));
        return redirect()->route('home');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function back(Request $request)
    {
        $request->validate([
            'main_user_id' => 'required|integer',
        ]);

        auth()->loginUsingId((int)$request->input('main_user_id'), true);
        session()->forget('switch_user_to');
        session()->forget('main_user_id');
        return redirect()->route('home');
    }

}
