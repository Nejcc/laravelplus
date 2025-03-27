<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::name('admin.')->group(function (): void {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

    Route::resource('users', \App\Http\Controllers\Admin\Users\UserController::class);

    /*
     * Roles
     */
    Route::get('/roles', [\App\Http\Controllers\Admin\Roles\RoleController::class, 'index'])->name('roles.index');
    Route::get('/roles/{role:slug}/users', [\App\Http\Controllers\Admin\Roles\RoleController::class, 'users'])->name('roles.users.show');
    Route::get('/roles/{role:slug}', [\App\Http\Controllers\Admin\Roles\RoleController::class, 'show'])->name('roles.show');
    /*
     * Permissions
     */
    Route::get('/permissions', [\App\Http\Controllers\Admin\Permissions\PermissionController::class, 'index'])->name('permissions.index');

    /*
     * Switch user
     */
    Route::post('/switch-user', [\App\Http\Controllers\Admin\Users\SwitchUserController::class, 'loginAs'])->name('switch-user.login-as');
//});
