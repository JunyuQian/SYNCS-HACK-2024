<?php

use Illuminate\Support\Facades\Route;

Route::get('/custom', function () {
    return 'This is a custom route!';
});
