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

// REGISTER
Route::post('/register', [App\Http\Controllers\Api\Auth\RegisterController::class, 'index']);


// ROLE
Route::get('/role', [App\Http\Controllers\Api\Public\RoleController::class, 'index']);

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

        // ROLES ALL
        Route::get('/roles/all', [\App\Http\Controllers\Api\Admin\RoleController::class, 'all'])
        ->middleware('permission:roles.index');

        // ROLES
        Route::apiResource('/roles', App\Http\Controllers\Api\Admin\RoleController::class)
        ->middleware('permission:roles.index|roles.store|roles.update|roles.delete');

        // USER IDENTITAS ALL
        Route::get('/users/identifies/all', [\App\Http\Controllers\Api\Admin\UserIdentifiesController::class, 'all'])
        ->middleware('permission:users.identifies.index');

        // USER IDENTITAS
        Route::apiResource('/users/identifies', App\Http\Controllers\Api\Admin\UserIdentifiesController::class)
        ->middleware('permission:users.identifies.index|users.identifies.store|users.identifies.update|users.identifies.delete');

        // USERS
        Route::apiResource('/users', App\Http\Controllers\Api\Admin\UserController::class)
        ->middleware('permission:users.index|users.store|users.update|users.delete');

        // PENGADUAN CATEGORIES ALL
        Route::get('/pengaduan/categories/all', [\App\Http\Controllers\Api\Admin\PengaduanCategoryController::class, 'all'])
        ->middleware('permission:pengaduan.categories.index');

        // PENGADUAN CATEGORIES
        Route::apiResource('/pengaduan/categories', App\Http\Controllers\Api\Admin\PengaduanCategoryController::class)
        ->middleware('permission:pengaduan.categories.index|pengaduan.categories.store|pengaduan.categories.update|pengaduan.categories.delete');

        // PENGADUAN STATUS ALL
        Route::get('/pengaduan/status/all', [\App\Http\Controllers\Api\Admin\PengaduanStatusController::class, 'all'])
        ->middleware('permission:pengaduan.statuses.index');

        // PENGADUAN STATUS
        Route::apiResource('/pengaduan/status', App\Http\Controllers\Api\Admin\PengaduanStatusController::class)
        ->middleware('permission:pengaduan.statuses.index|pengaduan.statuses.store|pengaduan.statuses.update|pengaduan.statuses.delete');

        // PENGADUAN
        Route::apiResource('/pengaduan', App\Http\Controllers\Api\Admin\PengaduanController::class)
        ->middleware('permission:pengaduan.index|pengaduan.store|pengaduan.update|pengaduan.delete');




    });

});

// MIDDLEWARE AUTH
Route::group(['middleware' => 'auth:api'], function() {


    Route::get('/pengaduan', [App\Http\Controllers\Api\Public\PengaduanController::class, 'index']);
    Route::post('/pengaduan', [App\Http\Controllers\Api\Public\PengaduanController::class, 'store']);
    Route::get('/pengaduan/categories', [App\Http\Controllers\Api\Public\PengaduanCategoryController::class, 'index']);
    Route::get('/pengaduan/status', [App\Http\Controllers\Api\Public\PengaduanStatusController::class, 'index']);

});
