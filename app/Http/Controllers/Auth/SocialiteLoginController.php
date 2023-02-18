<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\RedirectResponse;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SocialiteLoginController extends Controller
{
    /**
     * @return RedirectResponse|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirectToGithubProvider()
    {
        return Socialite::driver('github')->redirect();
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function handleGithubProviderCallback(Request $request)
    {
        $user = Socialite::driver('github')->user();

        $authUser = $this->findOrCreateUser($user, 'github');

        Auth::login($authUser, true);

        return redirect()->to('/home');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function handleFacebookProviderCallback(Request $request)
    {
        $user = Socialite::driver('facebook')->user();

        $authUser = $this->findOrCreateUser($user, 'facebook');

        Auth::login($authUser, true);

        return redirect()->to('/home');
    }

    /**
     * @param $socialUser
     * @param $provider
     * @return User
     */
    private function findOrCreateUser($socialUser, $provider) : User
    {
        $authUser = User::where('provider_id', $socialUser->getId())->first();

        if ($authUser) {
            return $authUser;
        }

        $user = new User();
        $user->name = $socialUser->getName();
        $user->email = $socialUser->getEmail();
        $user->provider = $provider;
        $user->provider_id = $socialUser->getId();
        $user->avatar = $socialUser->getAvatar();
        $user->save();

        return $user;
    }
}
