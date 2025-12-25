<?php

use App\Http\Middleware\test;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/debug-cloud', function () {
    dd(config('cloudinary'));
});