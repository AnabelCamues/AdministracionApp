<?php
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;



Route::group(['prefix' => 'organization', 'middleware' => ['auth', 'authorize']], function () {
    Route::view('/', 'sistema.organization.index');
    Route::get('/index', [OrganizationController::class, 'index']);
    Route::get('/{id}', [OrganizationController::class, 'show']);
    Route::post('/', [OrganizationController::class, 'store']);
    Route::patch('/{id}', [OrganizationController::class, 'update']);
    Route::delete('/{id}', [OrganizationController::class, 'destroy']);
});

Route::group(['prefix' => 'orders', 'middleware' => ['auth', 'authorize']], function () {
    Route::view('/', 'sistema.order.index');
    Route::get('/index', [OrderController::class, 'index']);
    Route::get('/{id}', [OrderController::class, 'show']);
    Route::post('/', [OrderController::class, 'store']);
    Route::patch('/{id}', [OrderController::class, 'update']);
    Route::delete('/{id}', [OrderController::class, 'destroy']);
});

Route::group(['prefix' => 'products', 'middleware' => ['auth', 'authorize']], function () {
    Route::view('/', 'sistema.product.index');
    Route::get('/index', [ProductController::class, 'index']);
    Route::get('/{id}', [ProductController::class, 'show']);
    Route::post('/', [ProductController::class, 'store']);
    Route::patch('/{id}', [ProductController::class, 'update']);
    Route::delete('/{id}', [ProductController::class, 'destroy']);
});
