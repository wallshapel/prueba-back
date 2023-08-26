<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('', [AuthController::class, 'index']);
Route::post('register', [AuthController::class, 'register']);
Route::delete('delete/{id}', [AuthController::class, 'destroy']);
