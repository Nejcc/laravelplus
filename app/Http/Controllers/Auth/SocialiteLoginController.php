<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

final class SocialiteLoginController extends Controller
{
    /**
     * @return RedirectResponse|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirectToGithubProvider()
    {
        return Socialite::driver('github')->redirect();
    }

    /**
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
     * @return RedirectResponse
     */
    public function handleFacebookProviderCallback(Request $request)
    {
        $user = Socialite::driver('facebook')->user();

        $authUser = $this->findOrCreateUser($user, 'facebook');

        Auth::login($authUser, true);

        return redirect()->to('/home');
    }

    private function findOrCreateUser($socialUser, $provider): User
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
