<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::prefix('ajax')->name('ajax.')->group(function(){
    Route::post('/user/notification/read', App\Http\Controllers\Ajax\User\Notification\ReadWhatsNewController::class)->name('read.news');
});
