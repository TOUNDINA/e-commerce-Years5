<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Order_productsController;
use App\Http\Controllers\AuthenticationController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// categories api urls
Route::get('/categories', [CategoryController::class,'getCategories']);
Route::post('/categories', [CategoryController::class,'createCategory']);
Route::get('/categories/{categoryId}', [CategoryController::class, 'getCategory']);
Route::patch('/categories/{categoryId}', [CategoryController::class, 'updateCategory']);
Route::delete('/categories/{categoryId}', [CategoryController::class,'deleteCategory']);
Route::get('/categories/{categoryId}/products', [CategoryController::class,'getProductsOfCategory']);

// products api urls

Route::get('/products', [ProductController::class,'getProducts']);
Route::post('/products', [ProductController::class,'createProduct']);
Route::get('/products/{productId}', [ProductController::class,'getProduct']);
Route::patch('/products/{productId}', [ProductController::class,'updateProduct']);
Route::delete('/products/{productId}', [ProductController::class,'deleteProduct']);
Route::get('/products/{productId}/images', [ProductController::class,'getImagesOfProduct']);
Route::get('/products/{productId}/categories',[ProductController::class,'findProductsOfCategory']);

//suppliers api urls
Route::get('/suppliers',[SupplierController::class,'getSuppliers']);
Route::post('/suppliers',[SupplierController::class , 'createSupplier']);
Route::get('/suppliers/{supplierId}',[SupplierController::class ,'getSupplier']);
Route::patch('/suppliers/{supplierId}',[SupplierController::class,'updateSupplier']);
Route::delete('/suppliers/{supplierId}',[SupplierController::class,'deleteSupplier']);  

//Images api urls 
Route::get('/images',[ImageController::class, 'getImages']);

Route::post('/images',[ImageController::class,'createImage']);
Route::patch('/images/{imageId}',[ImageController::class,'updateImage']);
Route::get('/images/{imageId}',[ImageController::class,'getImage']);
Route::delete('images/{imageId}',[ImageController::class,'deleteImage']);

//Orders api urls
Route::get('/orders',[OrderController::class,'getOrders']);
Route::post('/orders',[OrderController::class,'createOrder']);
Route::get('/orders/{orderId}',[OrderController::class,'getOrder']);
Route::patch('/orders/{orderId}',[OrderController::class,'updateOrder']);
Route::delete('/orders/{orderId}',[OrderController::class,'deleteOrder']);

//Order_products api urls
Route::get('/order_products',[Order_productsController::class,'getOrderProducts']);
Route::post('/order_products',[Order_productsController::class,'createOrderProduct']);
Route::get('/order_products/{order_productsId}',[Order_productsController::class , 'getOrderProduct']);
Route::patch('/order_products/{order_productsId}',[Order_productsController::class , 'updateOrderProduct']);
Route::delete('/order_products/{order_productsId}',[Order_productsController::class,'deleteOrderProduct']);

// api for Authentication
Route::post('/register',[AuthenticationController::class,'register']);
Route::post('/register',[AuthenticationController::class,'register']);
Route::post('/login', [AuthenticationController::class, 'login']);
// Route::post('/resetPassword', [AuthenticationController::class, 'resetPassword']);

Route::post('/forgot-password', [AuthenticationController::class, 'forgotPassword']);

Route::get('reset-password/{token}', [AuthenticationController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [AuthenticationController::class, 'resetPassword']);

use App\Http\Controllers\StripeController;

Route::get('/checkout', [StripeController::class, 'checkout'])->name('checkout');
Route::post('/session', [StripeController::class, 'session'])->name('session');
Route::get('/success', [StripeController::class, 'success'])->name('success');


// Route::get('/products/{productId}/getFirstImage',[ProductController::class,'getFirstImage']);

// Route::middleware(['cors'])->group(function(){
//     Route::post('/products', [ProductController::class,'createProduct']);
// });






