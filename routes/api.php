<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);


Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('logout', [UserController::class, 'logout']);
    Route::post('update_profile', [UserController::class, 'update_profile']);
    Route::get('get_projects', [ProjectController::class, 'get_projects']);
    Route::post('add_project', [ProjectController::class, 'add_project']);
    Route::delete('delete_project', [ProjectController::class, 'delete_project']);
});

