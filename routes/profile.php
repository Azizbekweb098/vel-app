<?php


use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\post\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth:sanctum'])->group( function () {
    
    Route::get('profile', [ProfileController::class, 'show']);

    Route::post('profile', [ProfileController::class, 'update']);

    Route::put('user', [ProfileController::class, 'userupdate']);

    Route::patch('password', [ProfileController::class, 'updatePassword']);


});

