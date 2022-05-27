<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserApiController;
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

Route::get('/users/{id?}',[UserApiController::class, 'showUser']);
Route::post('/add-user/',[UserApiController::class, 'addUser']);
Route::post('/add-multiple-user/',[UserApiController::class, 'addMultipleUser']);
Route::put('/update-user-detail/{id?}',[UserApiController::class, 'updateUserDetails']);
Route::patch('/update-user-singlerecord/{id}',[UserApiController::class, 'updateUsersingle']);
Route::delete('/delete-user-singlerecord/{id}',[UserApiController::class, 'deleteUsersingle']);
Route::delete('/delete-user-withjson/',[UserApiController::class, 'deleteUserwithjson']);
Route::delete('/delete-user-multiplerecord/{ids}',[UserApiController::class, 'deleteUserMultiple']);
Route::delete('/delete-multipleuser-withjson/',[UserApiController::class, 'deleteMultipleUserwithjson']);
