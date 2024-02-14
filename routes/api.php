<?php

use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\TransportadoraController;
use Illuminate\Support\Facades\Route;

Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);
Route::post('logout', [UserController::class, 'logout'])->middleware('auth:sanctum');

Route::group(['prefix' => 'transportadora', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [TransportadoraController::class, 'index']);
    Route::post('add', [TransportadoraController::class, 'add']);
    Route::get('edit/{id}', [TransportadoraController::class, 'edit']);
    Route::post('update/{id}', [TransportadoraController::class, 'update']);
    Route::delete('delete/{id}', [TransportadoraController::class, 'delete']);
});

