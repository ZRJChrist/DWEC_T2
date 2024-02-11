<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PolicyController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::ApiResource('users', UserController::class);
Route::ApiResource('customers', CustomerController::class);
Route::ApiResource('policies', PolicyController::class);
Route::ApiResource('provinces', ProvinceController::class);
