<?php

use Illuminate\Support\Facades\Route;

Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])
    ->name('home')
    ->middleware('auth');

Route::post('/getNextUser', [\App\Http\Controllers\HomeController::class, 'getNextUser'])
    ->name('getNextUser')
    ->middleware('auth');

Route::get('/messages', [\App\Http\Controllers\MsgController::class, 'index'])
    ->name('messages')
    ->middleware('auth');

Route::get('/message/{id}', [\App\Http\Controllers\MsgDetailController::class, 'index'])
    ->name('msgDetail')
    ->middleware('auth');

Route::post('/api/msg', [\App\Http\Controllers\MsgDetailController::class, 'store'])
    ->name('storeMsg');

Route::get('/messages/{user1}/{user2}', [\App\Http\Controllers\MsgDetailController::class, 'getMessagesBetweenUsers']);

Route::get('/profile/{id}', [\App\Http\Controllers\HomeController::class, 'othersProfile']);


