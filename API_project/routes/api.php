<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserApiController;
use App\Http\Controllers\ProductController;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//get api for show users
Route::get('/users/{id?}', [UserApiController::class,'showUser']);

//post api for add users
Route::post('/add-users/', [UserApiController::class,'addUser']);

//post api for add products
Route::post('/add-product/', [ProductController::class,'addProducts']);

//update api for products
Route::put('/update-product/{id}', [ProductController::class,'updateProducts']);

//single data update api for products
Route::patch('/update-single-product-data/{id}', [ProductController::class,'updateSingleDataProducts']);

//single data delete api for products
Route::delete('/delete-single-product/{id}', [ProductController::class,'deleteProducts']);

//single data delete api for products with json
Route::delete('/delete-single-product-json', [ProductController::class,'deleteProductsJson']);

//multiple data delete api for products
Route::delete('/delete-multiple-product/{ids}', [ProductController::class,'deleteMultipleProducts']);

//single data delete api for products with json
Route::delete('/delete-multiple-product-json', [ProductController::class,'deleteMultipleProductsJson']);