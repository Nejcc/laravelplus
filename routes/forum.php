<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::name('forum.')->group(function (): void {
    Route::get('/', \App\Http\Controllers\Forum\ForumController::class)->name('index');
    Route::get('/thread/{thread:slug}', \App\Http\Controllers\Forum\ThreadController::class)->name('thread');
    Route::get('/{topic:slug}', \App\Http\Controllers\Forum\ForumController::class)->name('topic');
});