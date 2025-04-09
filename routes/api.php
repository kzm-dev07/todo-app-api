<?php

use Illuminate\Support\Facades\Route;
use KzmTodoApp\Application\Controllers\HelloController;
use KzmTodoApp\Application\Controllers\TaskController;

Route::get('/hello', [HelloController::class, 'index']);

Route::get('/tasks', [TaskController::class, 'index']);

Route::post('/task', [TaskController::class, 'create']);

Route::delete('/task/{key}', [TaskController::class, 'delete']);

Route::put('/task/{key}', [TaskController::class, 'update']);
