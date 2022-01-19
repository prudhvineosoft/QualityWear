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
    Route::get('/dashboard/users', [UserController::class, 'showUsers']);
    Route::get('/dashboard/users/register', [UserController::class, 'addUserPage']);
    Route::post('/addUserPost', [UserController::class, 'addUser']);
    Route::get('/deleteUser/{id}', [UserController::class, 'deleteUser']);
    Route::get('/dashboard/users/{id}/userDetails', [UserController::class, 'userDetails']);
    Route::post('/editUserPost', [UserController::class, 'editUser']);

    //banner management

    Route::resource('dashboard/coupon', CouponController::class);
    Route::resource('dashboard/contacts', ContactsController::class);
    Route::resource('dashboard/cms', cmsController::class);
    Route::resource('dashboard/configuration', configurationController::class);
    Route::resource('dashboard/reports', ReportsController::class);
});
// for inventory manager
Route::group(['middleware' => ['auth', 'role:inventory manager|admin|superadmin']], function () {
    Route::resource('/dashboard/category', CategoryController::class);
    Route::resource('dashboard/product', ProductsController::class);
});
// order manager
Route::group(['middleware' => ['auth', 'role:order manager|admin|superadmin']], function () {
    Route::resource('dashboard/banner', BannerController::class);
    Route::resource('dashboard/orderManagement', OrderController::class);
});



require __DIR__ . '/auth.php';
