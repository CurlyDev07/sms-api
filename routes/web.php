<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    dd('ssssss');
    return '✅ Laravel custom route is working!';
});


Route::get('/test', function () {
    return 'Route working!';
});
