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

/*
|--------------------------------------------------------------------------
*/

// GROUP WITH MIDDLEWARE "auth"
Route::group(['middleware' => 'auth:api'], function() {

    // LOGOUT
    Route::post('/logout', [App\Http\Controllers\Api\Auth\LoginController::class, 'logout']);

});

/*
|--------------------------------------------------------------------------
*/

// GROUP WITH PREFIX "admin"
Route::prefix('admin')->group(function () {

    // GROUP WITH MIDDLEWARE "auth:api"
    Route::group(['middleware' => 'auth:api'], function () {

        // DASHBOARD
        Route::get('/dashboard', App\Http\Controllers\Api\Admin\DashboardController::class);

        // PERMISSIONS INDEX
        Route::get('/permissions', [\App\Http\Controllers\Api\Admin\PermissionController::class, 'index'])
        ->middleware('permission:permissions.index');

        // PERMISSIONS ALL
        Route::get('/permissions/all', [\App\Http\Controllers\Api\Admin\PermissionController::class, 'all'])
        ->middleware('permission:permissions.index');
    });

});
