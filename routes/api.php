<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\BookController;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\ProductController;
use App\Http\Controllers\api\ShopController;
use App\Http\Controllers\api\OrderController;
use App\Http\Controllers\api\ReviewController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::prefix('auth') -> name('auth.') -> group(function(){
    // Route for API signup
    Route::post('signup', [AuthController::class, 'signup']) -> name('signup');
    // Route for API signin
    Route::post('signin', [AuthController::class, 'signin']) -> name('signin');
    // Route for API signout
    Route::post('signout', [AuthController::class, 'signout']) -> name('signout')->middleware('auth:sanctum');
});
// Routes books
Route::prefix('books') -> name('books.') -> group(function(){
    
    Route::get('/onsale', [BookController::class, 'getOnSale']) -> name('getOnSale');
    
    Route::prefix('/featured') -> name('featured.') -> group(function(){
        
        Route::get('/popular', [BookController::class, 'getPopular']) -> name('getPopular');
        
        Route::get('/recommended', [BookController::class, 'getRecommended']) -> name('getRecommended');
        
        Route::get('/', [BookController::class, 'getFeatured']) -> name('getFeatured');
    });
    
    Route::get('/', [BookController::class, 'getListBooks']) -> name('getListBooks');
});
Route::prefix('shop') -> name('shop.') -> group(function(){
    
    Route::apiResource('/', ShopController::class)->only(['index'])
        -> missing(function (Request $request) {
            return response()->json(['message' => 'Not Found!'], 404);
    });
    
    Route::get('/filtering', [ShopController::class, 'getListFiltering']) -> name('getFiltering');
    
    Route::prefix('product') -> name('product.') -> group(function(){
       
        Route::apiResource('/review', ReviewController::class)->only(['index', 'store']);
        Route::get('/review/rating', [ReviewController::class, 'getRating']) -> name('getRating');
       
        Route::get('/', [ProductController::class, 'show']);
    });
    
    Route::middleware('auth:sanctum')->apiResource('/order', OrderController::class)->only(['index', 'store']);
});
