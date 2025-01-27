<?php

use App\Http\Controllers\commet\CommetController;
use App\Http\Controllers\FrontPosts\FrontPostController;
use App\Http\Controllers\post\PostController;
use App\Http\Controllers\search\SearchController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth:sanctum'])->group( function () {
    
    Route::get('search', [SearchController::class, 'index']);
    });


