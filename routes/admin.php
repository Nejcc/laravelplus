<?php

declare(strict_types=1);

use App\Http\Controllers\Admin\Permissions\PermissionController;
use App\Http\Controllers\Admin\Roles\RoleController;
use App\Http\Controllers\Admin\Users\SwitchUserController;
use App\Http\Controllers\Admin\Users\UserController;
use App\Http\Controllers\Admin\Users\UserNotificationController;
use App\Http\Controllers\HomeController;
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

Route::name('admin.')->group(function (): void {
    Route::get('/', [HomeController::class, 'index'])->name('index');
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

    /*
     * Users
     */
    Route::prefix('users')->name('users.')->group(function (): void {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/', [UserController::class, 'store'])->name('store');
        Route::get('/{user}', [UserController::class, 'show'])->name('show');
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('edit');
        Route::put('/{user}', [UserController::class, 'update'])->name('update');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');

        // User Notifications Routes
        Route::prefix('{user}/notifications')->name('notifications.')->group(function (): void {
            Route::post('/{notification}/mark-as-read', [UserNotificationController::class, 'markAsRead'])->name('markAsRead');
            Route::post('/mark-all-as-read', [UserNotificationController::class, 'markAllAsRead'])->name('markAllAsRead');
        });
    });

    /*
     * Roles
     */
    Route::resource('roles', RoleController::class);
    Route::get('/roles/{role}/users', [RoleController::class, 'users'])->name('roles.users.show');

    /*
     * Permissions
     */
    Route::prefix('permissions')->name('permissions.')->group(function (): void {
        Route::get('/', [PermissionController::class, 'index'])->name('index');
        Route::post('/', [PermissionController::class, 'store'])->name('store');
        Route::put('/{permission}', [PermissionController::class, 'update'])->name('update');
        Route::delete('/{permission}', [PermissionController::class, 'destroy'])->name('destroy');
    });

    /*
     * Switch user
     */
    Route::post('/switch-user', [SwitchUserController::class, 'loginAs'])->name('switch-user.login-as');
});
