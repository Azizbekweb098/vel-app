<?php 
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



// register start
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/verify', [RegisterController::class, 'verify']);
// register end

// login start 
Route::post('/login', [LoginController::class, 'login']);
// login end

Route::middleware(['auth:sanctum'])->group( function () {
    
    Route::post('logout', [LogoutController::class, 'logout']);
});
