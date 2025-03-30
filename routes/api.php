<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use KzmTodoApp\Application\Controllers\HelloController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/hello', [HelloController::class, 'index']);
