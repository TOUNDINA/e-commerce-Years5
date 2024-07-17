<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ProductController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// API URL for Authentication
Route::get('/verify_otp', [AuthenticationController::class, 'verifyOTP']);

// Test Stripe
// Route::get('/checkout', [StripeController::class, 'checkout']);
// Route::match(['get', 'post'], '/session', [StripeController::class, 'session'])->name('session');
// Route::get('/success', [StripeController::class, 'success'])->name('success');

// Student Routes
// Route::get('/student', [StudentController::class, 'displayform']);
// Route::post('/add_data', [StudentController::class, 'save']);
// Route::get('/studentview',[StudentController::class,'viewform']);
// Route::get('/studentview',[StudentController::class,'index']);
// Route::get('/studentadd',[StudentController::class,'displayform']);
// Route::get('click_edit/{id}',[StudentController::class,'edit_function']);
// Route::get('click_delete/{id}',[StudentController::class,'delete_function']);
// Route::post('/update/{id}',[StudentController::class,'update_function']);

// Route::post('api/products/create', [ProductController::class, 'create']);// just add
// Route::get('/product',[ProductController::class,'displayform1']);
// Route::post('/add_product',[ProductController::class,'createProduct']);
// Route::get('/productview',[ProductController::class,'viewform1']);
// Route::get('/productadd',[ProductController::class,'displayform1']);

// Route::get('click_edit/{id}',[ProductController::class,'edit_function']);
// Route::get('click_delete/{id}',[ProductController::class,'delete_function']);
// Route::post('/update/{id}',[ProductController::class,'update_function']);

// Route::get('/products', [App\Http\Controllers\ProductController::class, 'showProductView'])->name('products.index');

