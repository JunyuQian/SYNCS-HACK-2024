<?php

use Illuminate\Support\Facades\Route;

Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])
    ->name('home')
    ->middleware('auth');

Route::post('/getNextUser', [\App\Http\Controllers\HomeController::class, 'getNextUser'])
    ->name('getNextUser')
    ->middleware('auth');

Route::get('/msg', [\App\Http\Controllers\MsgController::class, 'index'])
    ->name('msg')
    ->middleware('auth');

Route::get('/msgDetail/{id}', [\App\Http\Controllers\MsgDetailController::class, 'index'])
    ->name('msgDetail')
    ->middleware('auth');

Route::post('/api/msg', [\App\Http\Controllers\MsgDetailController::class, 'store'])
    ->name('storeMsg');

Route::get('/messages/{user1}/{user2}', [\App\Http\Controllers\MsgDetailController::class, 'getMessagesBetweenUsers']);
