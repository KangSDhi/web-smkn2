<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController as Auth;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('/login', [Auth::class, 'login']);

Route::middleware('jwt')->group(function(){
    Route::get('/user', [Auth::class, 'getUser']);
});