<?php

use App\Http\Controllers\CoachController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\GamesController;
use App\Http\Controllers\PackagesController;
use App\Http\Controllers\PartnerController;
use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::get('/test',[CoachController::class,'index']);
Route::apiResource('coach',CoachController::class);
Route::apiResource('game',GamesController::class);
Route::apiResource('package',PackagesController::class);
Route::apiResource('partner',PartnerController::class);
Route::apiResource('content',ContentController::class);