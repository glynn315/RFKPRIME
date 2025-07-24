<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserAccountController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');



Route::get('/userAccount', [UserAccountController::class,'displayList']);
Route::post('/userAccount', [UserAccountController::class,'addUser']);

Route::get('/supplier', [SupplierController::class,'displayList']);
Route::post('/supplier', [SupplierController::class,'addSupplier']);


Route::get('/product', [ProductController::class,'displayList']);
Route::post('/product', [ProductController::class,'addProduct']);

Route::get('/customer', [CustomerController::class,'displayList']);
Route::post('/customer', [CustomerController::class,'addCustomer']);

Route::get('/cart', [CartController::class,'displayCart']);
Route::post('/cart', [CartController::class,'addCart']);