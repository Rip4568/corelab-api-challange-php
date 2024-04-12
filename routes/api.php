<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AddUserID;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('login', [UserController::class, 'login']);

Route::apiResource('users', UserController::class);

Route::apiResource('tasks', TaskController::class)->middleware(['auth:sanctum', AddUserID::class]);

/* Route::group(['middleware' => 'auth:sanctum'], function () {

    Route::prefix('v1')->group(function () {
        Route::post('tasks', [TaskController::class, 'store']);
    });
}); */
