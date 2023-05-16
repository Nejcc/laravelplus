<?php

use Illuminate\Support\Facades\Route;

Route::prefix('example')->group(function () {
    Route::get('/', [App\Plugins\ExamplePlugin\Controllers\ExampleController::class, 'index']);
});
