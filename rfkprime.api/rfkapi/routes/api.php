<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TermsController;
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
Route::get('/product/inventory', [ProductController::class, 'inventoryList']);
Route::get('/product/{id}', [ProductController::class,'displaySeelctedbyId']);
Route::post('/product', [ProductController::class,'addProduct']);
Route::post('/product/deduct', [ProductController::class, 'updateQuantity']);


Route::get('/customer', [CustomerController::class,'displayList']);
Route::post('/customer', [CustomerController::class,'addCustomer']);

Route::get('/cart', [CartController::class,'displayCart']);
Route::get('/cart/Active', [CartController::class,'displayCartActive']);
Route::post('/cart', [CartController::class,'addCart']);
Route::post('/cart/update', [CartController::class,'updateCart']);

Route::get('/payment', [PaymentController::class,'displayPayment']);
Route::post('/payment', [PaymentController::class,'storePayment']);

Route::get('/terms', [TermsController::class,'displayTerms']);
Route::get('/terms/customerTerms', [TermsController::class,'displayTermsListPerCustomer']);
Route::post('/terms', [TermsController::class,'addPaymentterms']);
Route::get('/terms/{orderID}', [TermsController::class,'PaymentListPerCustomer']);
Route::get('/terms/payment/{id}', [TermsController::class,'displayTermInformation']);
Route::put('/terms/{id}/status', [TermsController::class, 'updatePaymentStatus']);

Route::get('/orders', [OrderController::class,'displayList']);
Route::post('/orders', [OrderController::class,'addOrders']);
Route::get('/orders/{id}', [OrderController::class,'DisplayUser']);

Route::get('/products', fn() => \App\Models\Product::all());
Route::get('/customers', fn() => \App\Models\Customer::all());
Route::get('/sold-items', function() {
    return DB::table('carts')
        ->join('products', 'carts.product_id', '=', 'products.product_id')
        ->select('products.product_name', DB::raw('SUM(carts.quantity) as quantity_sold'), DB::raw('SUM(carts.quantity * carts.product_price) as total_amount'))
        ->groupBy('products.product_name')
        ->get();
});