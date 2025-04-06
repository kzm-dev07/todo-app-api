<?php

use Illuminate\Support\Facades\Route;
use KzmTodoApp\Application\Controllers\HelloController;
use KzmTodoApp\Application\Controllers\TaskController;

Route::get('/hello', [HelloController::class, 'index']);

Route::post('/task', [TaskController::class, 'create']);
