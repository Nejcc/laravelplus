<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

final class SwitchUserController extends Controller
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
     * @return RedirectResponse
     */
    public function loginAs(Request $request)
    {
        $request->validate([
            'switch_user_to' => 'required|integer',
            'main_user_id'   => 'required|integer',
        ]);

        auth()->loginUsingId((int) $request->input('switch_user_to'), true);
        session()->put('switch_user_to', (int) $request->input('switch_user_to'));
        session()->put('main_user_id', (int) $request->input('main_user_id'));
        session()->put('rdp_on', true);

        return redirect()->route('home');
    }

    /**
     * @return RedirectResponse
     */
    public function back(Request $request)
    {
        $request->validate([
            'main_user_id' => 'required|integer',
        ]);

        auth()->loginUsingId((int) $request->input('main_user_id'), true);
        session()->forget('switch_user_to');
        session()->forget('main_user_id');
        session()->forget('rdp_on');

        return redirect()->route('home');
    }
}
