<?php

use App\Http\Controllers\BannerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\cmsController;
use App\Http\Controllers\configurationController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//auth route for both 
Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index')->name('dashboard');
});
// for admin
Route::group(['middleware' => ['auth', 'role:admin|superadmin']], function () {
    Route::get('/users', [UserController::class, 'showUsers']);
    Route::get('/users/register', [UserController::class, 'addUserPage']);
    Route::post('/addUserPost', [UserController::class, 'addUser']);
    Route::get('/deleteUser/{id}', [UserController::class, 'deleteUser']);
    Route::get('/users/{id}/userDetails', [UserController::class, 'userDetails']);
    Route::post('/editUserPost', [UserController::class, 'editUser']);

    //banner management

    Route::resource('coupon', CouponController::class);
    Route::resource('contacts', ContactsController::class);
    Route::resource('cms', cmsController::class);
    Route::resource('configuration', configurationController::class);
    Route::resource('reports', ReportsController::class);
});
// for inventory manager
Route::group(['middleware' => ['auth', 'role:inventory manager|admin|superadmin']], function () {
    Route::resource('/category', CategoryController::class);
    Route::resource('/product', ProductsController::class);
});
// order manager
Route::group(['middleware' => ['auth', 'role:order manager|admin|superadmin']], function () {
    Route::resource('banner', BannerController::class);
    Route::resource('orderManagement', OrderController::class);
});



require __DIR__ . '/auth.php';
