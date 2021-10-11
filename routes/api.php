<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Public routes
Route::get('todos', [TodoController::class, 'index']);
Route::get('todos/{id}', [TodoController::class, 'show']);

// Private routes
Route::post('todos', [TodoController::class, 'store']);
Route::put('todos/{id}', [TodoController::class, 'update']);
Route::delete('todos/{id}', [TodoController::class, 'destroy']);