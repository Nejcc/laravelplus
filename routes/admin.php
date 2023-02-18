<?php

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

Route::name('admin.')->group(function (){
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

    /*
     * Roles
     */
    Route::get('/roles', [App\Http\Controllers\Admin\RoleController::class, 'index'])->name('roles.index');
    Route::get('/roles/{role:slug}/users', [App\Http\Controllers\Admin\RoleController::class, 'users'])->name('roles.users.show');
    Route::get('/roles/{role:slug}', [App\Http\Controllers\Admin\RoleController::class, 'show'])->name('roles.show');
    /*
     * Permissions
     */
    Route::get('/permissions', [App\Http\Controllers\Admin\PermissionController::class, 'index'])->name('permissions.index');

    /*
     * Switch user
     */
    Route::post('/switch-user', [App\Http\Controllers\Admin\SwitchUserController::class, 'loginAs'])->name('switch-user.login-as');
});
