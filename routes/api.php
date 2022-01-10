<?php

use App\Http\Controllers\ApiBannerController;
use App\Http\Controllers\ApiCategoryController;
use App\Http\Controllers\apiContactController;
use App\Http\Controllers\ApiProductsController;
use App\Http\Controllers\customarAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['middleware' => 'api'], function ($router) {
    Route::post('/register', [customarAuth::class, 'register']);
    Route::post('/login', [customarAuth::class, 'login']);
    Route::post('/logout', [customarAuth::class, 'logout']);
    Route::post('/refresh', [customarAuth::class, 'refresh']);
    Route::get('/profile', [customarAuth::class, 'profile']);
});
Route::apiResource('/contacts', apiContactController::class);
Route::apiResource('/banners', ApiBannerController::class);
Route::apiResource('/category', ApiCategoryController::class);
Route::apiResource('/products', ApiProductsController::class);
