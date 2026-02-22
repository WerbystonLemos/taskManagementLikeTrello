<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ColumnController;
use App\Http\Controllers\TaskController;
use App\Models\Comment;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::get('/projects', [ProjectController::class, 'getAllProjects']);
Route::post('/saveProject', [ProjectController::class, 'saveProject']);
Route::delete('/destroy/{id}', [ProjectController::class, 'destroy']);

Route::get('/columns', [ColumnController::class, 'getAllColumns']);
Route::get('/columns/{id}', [ColumnController::class, 'getColumnById']);
Route::get('/columnswithProjectId/{id}', [ColumnController::class, 'getColumnsWithTasksByProjectId']);
Route::get('/columnsWithTasksByIdProject/{id}', [ColumnController::class, 'getColumnsWithTasksByIdProject']);
Route::post('/saveColumn', [ColumnController::class, 'saveColumn']);
Route::patch('/column/reorder', [ColumnController::class, 'reorder']);
Route::delete('/deleteColumn/{id}', [ColumnController::class, 'destroyColumn']);

Route::get('/tasks', [TaskController::class, 'getAllTasks']);
Route::get('/tasks/{id}', [TaskController::class, 'getTasksByIdColumn']);
Route::post('/task', [TaskController::class, 'store']);
Route::get('/task/{id}', [TaskController::class, 'getTasksById']);
Route::patch('/task/reorder', [TaskController::class, 'reorder']);
Route::patch('/task/{id}', [TaskController::class, 'setStatusTask']);
Route::patch('/task/edit/{id}', [TaskController::class, 'editTask']);
Route::delete('/task/{id}', [TaskController::class, 'destroy']);

Route::get('/comments', [Comment::class, 'getAllComments']);