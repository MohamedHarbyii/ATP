<?php

use App\Http\Middleware\test;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/storage-link', function () {
    $target = storage_path('app/public');
    $link = public_path('storage');
    if (!file_exists($link)) {
        symlink($target, $link);
        return 'Storage Linked Successfully!';
    }
    return 'Already Linked!';
});
Route::middleware(test::class.":editor")->group(function() {
Route::get('/middle',function() {return "HI with middle";});
Route::get('/without-middle',function() {return "HI without middle";})->withoutMiddleware('test');
});