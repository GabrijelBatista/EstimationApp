<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('get_users', [UserController::class, 'get_users']);
    Route::get('logout', [UserController::class, 'logout']);

    Route::get('delete_reply/{id}', [ReplyController::class, 'delete_reply']);
    Route::get('delete_comment/{id}', [CommentController::class, 'delete_comment']);
    Route::post('add_reply', [ReplyController::class, 'add_reply']);
    Route::post('add_comment', [CommentController::class, 'add_comment']);
    Route::post('edit_comment', [CommentController::class, 'edit_comment']);
    Route::post('edit_reply', [ReplyController::class, 'edit_reply']);

    Route::get('search/{search}', [ProjectController::class, 'search']);
    Route::get('get_current_project/{name}', [ProjectController::class, 'get_current_project']);
    Route::post('update_profile', [UserController::class, 'update_profile']);
    Route::get('get_projects', [ProjectController::class, 'get_projects']);
    Route::post('add_project', [ProjectController::class, 'add_project']);
    Route::get('delete_project/{id}', [ProjectController::class, 'delete_project']);
    Route::post('add_module', [ProjectController::class, 'add_module']);
    Route::post('add_task', [ProjectController::class, 'add_task']);
    Route::post('edit_project', [ProjectController::class, 'edit_project']);
    Route::get('delete_task/{id}', [ProjectController::class, 'delete_task']);
    Route::get('delete_module/{id}', [ProjectController::class, 'delete_module']);

    Route::get('read_notification/{id}', [NotificationController::class, 'read_notification']);
    Route::post('estimations-notification', [NotificationController::class, 'sendEstimationsNotification']);
});

