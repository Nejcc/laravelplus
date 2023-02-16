<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Auth::routes();

Route::get('login/github', [\App\Http\Controllers\Auth\SocialiteLoginController::class, 'redirectToGithubProvider'])->name('sociolite.github.login');
Route::get('login/github/callback', [\App\Http\Controllers\Auth\SocialiteLoginController::class, 'handleGithubProviderCallback'])->name('sociolite.github.callback');

//Route::get('login/facebook', 'Auth\LoginController@redirectToFacebookProvider');
//Route::get('login/facebook/callback', 'Auth\LoginController@handleFacebookProviderCallback');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/tos', [App\Http\Controllers\HomeController::class, 'index'])->name('tos');
