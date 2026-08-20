<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InternalUseController;
use App\Http\Controllers\POSController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductReturnController;
use App\Http\Controllers\ProductStockController;
use App\Http\Controllers\RemittanceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);

    Route::middleware(['auth:sanctum', 'token.session'])->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/me', [AuthController::class, 'me']);

        Route::post('/add-category', [ProductCategoryController::class, 'addCategory']);
        Route::get('/get-categories', [ProductCategoryController::class, 'getCategory']);
        Route::delete('/delete-category/{id}', [ProductCategoryController::class, 'deleteCategory']);
        Route::patch('/update-category/{id}', [ProductCategoryController::class, 'updateCategory']);

        Route::get('/get-products', [ProductController::class, 'getProducts']);
        Route::post('/add-product', [ProductController::class, 'addProduct']);
        Route::delete('/delete-product/{id}', [ProductController::class, 'deleteProduct']);

        Route::post('/add-sales', [POSController::class, 'addSale']);
        Route::get('/get-sales', [POSController::class, 'getSales']);
        Route::post('/sale-items/{saleItem}/return', [POSController::class, 'returnSaleItem']);
        Route::post('/sales/{sale}/return-all', [POSController::class, 'returnAllSaleItems']);

        Route::get('/get-product-stocks', [ProductStockController::class, 'getProductStocks']);
        Route::post('/add-product-stock', [ProductStockController::class, 'addProductStock']);

        Route::get('/get-internal-uses', [InternalUseController::class, 'getInternalUses']);
        Route::post('/add-internal-use', [InternalUseController::class, 'addInternalUse']);

        Route::get('/dashboard', [DashboardController::class, 'dashboard']);

        Route::post('/send-remittance', [RemittanceController::class, 'sendRemittance']);
        Route::get('/get-remittances', [RemittanceController::class, 'getRemittances']);

        Route::get('/get-product-returns', [ProductReturnController::class, 'getProductReturns']);
    });
});


Route::get('/test', function () {
    return response()->json(['message' => 'API is working']);
});
