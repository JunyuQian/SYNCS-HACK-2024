<?php

use Illuminate\Support\Facades\Route;

Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/getNextUser', [\App\Http\Controllers\HomeController::class, 'getNextUser'])->name('getNextUser');

Route::get('/msg', [\App\Http\Controllers\MsgController::class, 'index'])->name('msg');

Route::get('/msgDetail/{id}', [\App\Http\Controllers\MsgDetailController::class, 'index'])->name('msgDetail');
