<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
   $message = 'Salom User';

   return response()->json([
    'message' => $message,
   ]);
});