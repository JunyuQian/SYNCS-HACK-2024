<?php

use Illuminate\Support\Facades\Route;

Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/getNextUser', [\App\Http\Controllers\HomeController::class, 'getNextUser'])->name('getNextUser');
