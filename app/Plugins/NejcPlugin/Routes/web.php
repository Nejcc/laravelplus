<?php


use Illuminate\Support\Facades\Route;

Route::prefix('nejc')->group(function () {
    Route::get('/', [App\Plugins\ExamplePlugin\Controllers\ExampleController::class, 'index']);
});
