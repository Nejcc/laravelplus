<?php

declare(strict_types=1);

namespace App\Http\Controllers;

final class HomeController extends Controller
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
        return view('home');
    }

    /**
     * @return array
     */
    private function getTranslations(): array
    {
        return $this->translations = [
            'test_translation' => __('Document Serial Number'),
        ];
    }

    /**
     * @return array
     */
    private function getPermissions(): array
    {
        return $this->permissions = [
            'view home',
        ];
    }
}
