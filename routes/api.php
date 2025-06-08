<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ElementController;

Route::get('/categories', [CategoryController::class, 'get']);
Route::get('/categories/{id}', [CategoryController::class, 'getById']);
Route::post('/categories', [CategoryController::class, 'create']);
Route::put('/categories/{id}', [CategoryController::class, 'update']);
Route::delete('/categories/{id}', [CategoryController::class, 'delete']);

Route::get('/elements', [ElementController::class, 'get']);
Route::get('/elements/{id}', [ElementController::class, 'getById']);
Route::post('/elements', [ElementController::class, 'create']);
Route::put('/elements/{id}', [ElementController::class, 'update']);
Route::delete('/elements/{id}', [ElementController::class, 'delete']);


