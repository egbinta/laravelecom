<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\API\TestController;
//use App\Http\Controllers\API\TestProductController;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum', 'isApiAdmin'])->group(function () {

    Route::get('/checkingAuthenticated', function () {
        return response()->json(['message' => 'you are in', 'status' => 200]);
    });

    Route::post('logout', [AuthController::class, 'logout']);

    // Categories
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/get-all-category', [CategoryController::class, 'allcategory']);
    Route::post('/store-category', [CategoryController::class, 'store']);
    Route::get('/edit-category/{id}', [CategoryController::class, 'edit']);
    Route::put('/update-category/{id}', [CategoryController::class, 'update']);
    Route::delete('/delete-category/{id}', [CategoryController::class, 'destroy']);

    // product
    Route::get('/get-products', [ProductController::class, 'index']);
    Route::post('/add-product', [ProductController::class, 'store']);
    Route::get('/edit-product/{id}', [ProductController::class, 'edit']);
    Route::put('/update-product/{id}', [ProductController::class, 'update']);

    // testPro
    Route::post('/test-product', [TestController::class, 'store']);
    Route::get('/get-testpro', [TestController::class, 'index']);
    Route::get('/getProduct/{id}', [TestController::class, 'edit']);
    Route::put('/update-testpro/{id}', [TestController::class, 'update']);
});

Route::middleware(['auth:sanctum'])->group(function () {

    Route::post('logout', [AuthController::class, 'logout']);
});
