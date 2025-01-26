<?php

use App\Http\Controllers\commet\CommetController;
use App\Http\Controllers\FrontPosts\FrontPostController;
use App\Http\Controllers\post\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;




Route::middleware(['auth:sanctum'])->group( function () {
    
//   post start
Route::apiResource('posts', PostController::class);

Route::get('frontpost', [FrontPostController::class, 'index']);

Route::post('commet_like', [CommetController::class, 'store']);
});