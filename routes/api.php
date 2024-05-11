<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// LOGIN
Route::post('/login', [App\Http\Controllers\Api\Auth\LoginController::class, 'index']);

// GROUP WITH MIDDLEWARE "auth"
Route::group(['middleware' => 'auth:api'], function() {

    // LOGOUT
    Route::post('/logout', [App\Http\Controllers\Api\Auth\LoginController::class, 'logout']);

});
