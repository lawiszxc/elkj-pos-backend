<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\ProductCategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/me', [AuthController::class, 'me']);

        Route::post('/add-category', [ProductCategoryController::class, 'addCategory']);
        Route::get('/get-categories', [ProductCategoryController::class, 'getCategory']);
        Route::delete('/delete-category/{id}', [ProductCategoryController::class, 'deleteCategory']);
    });
});

Route::get('/test', function () {
    return response()->json(['message' => 'API is working']);
});
