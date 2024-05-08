<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserDetailController;
use App\Http\Controllers\AuthRestaurantController;
use App\Http\Controllers\RestaurantsDetailsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['prefix' => 'auth'], function () {
    // login de usuarios
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/loginRestaurants', [AuthRestaurantController::class, 'loginrestaurant']);
});


// Login de Restaurantes

// Rutas protegidas de usuarios
Route::middleware('JWTVerify')->group(function () {
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/me', [AuthController::class, 'me']);
    Route::get('/user', [UserController::class, 'index']);
    Route::get('/profile', [UserDetailController::class, 'show']);
    Route::post('/user-details', [UserDetailController::class, 'store']);
    Route::put('/user-details/{id}', [UserDetailController::class, 'update']);

    //carrito
    Route::get('/cart', [CartController::class, 'index']);
    Route::post('/cart', [CartController::class, 'store']);
    Route::get('/cart/{cart}', [CartController::class, 'show']);
    Route::put('/cart/{cart}', [CartController::class, 'update']);
    Route::delete('/cart/{cart}', [CartController::class, 'destroy']);
});

// Rutas protegidas de Restaurantes
Route::middleware('JWTVerify')->prefix('restaurants')->group(function () {
    Route::post('/logoutRestaurants', [AuthRestaurantController::class, 'logoutRestaurants']);
    Route::post('/Restaurants-details', [RestaurantsDetailsController::class, 'store']);
    Route::get('/products', [ProductController::class, 'index']);
    Route::post('/me', [AuthRestaurantController::class, 'me']);


    Route::get('products', [ProductController::class, 'index']);
    Route::post('products', [ProductController::class, 'store']);
    Route::get('products/{product}', [ProductController::class, 'show']);
    Route::put('products/{product}', [ProductController::class, 'update']);
    Route::delete('products/{product}', [ProductController::class, 'destroy']);
});

Route::middleware('JWTVerify')->prefix('admin')->group(function () {
    Route::get('categories', [CategoryController::class, 'index']);
    Route::post('categories', [CategoryController::class, 'store']);
    Route::get('categories/{category}', [CategoryController::class, 'show']);
    Route::put('categories/{category}', [CategoryController::class, 'update']);
    Route::delete('categories/{category}', [CategoryController::class, 'destroy']);
});
