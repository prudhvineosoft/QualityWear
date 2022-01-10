## Quality Wear
quality wear is a e commerse application designed by using Laravel and Vue js designing a admin panel using admin lte and customar pane using eshopper theam

## Authentication
using breeze authentication system

-- creating new project using 
$ laravel new Quality wear
--

-- create database in php myadmin name qualitywear
-- first wee need to migrate our project using
$ cd QualityWear
$ php artisan migrate
--  install Laravel Breeze using Composer:
$ composer require laravel/breeze --dev
$ php artisan breeze:install
-- then install node 
$ npm install && npm run dev

## Role managing
using laratrust role management package

-- install the package using composer:
$ composer require santigarcor/laratrust
-- Publish the configuration file:
$ php artisan vendor:publish --tag="laratrust"
-- Run the setup command:
$ php artisan laratrust:setup
-- now we need to create laratrust seeder
$ php artisan laratrust:seeder
-- Then to customize the roles, modules and permissions you can publish the laratrust_seeder.php file:
$ php artisan vendor:publish --tag="laratrust-seeder"
-- finally dump the composer 
$ composer dump-autoload
-- In the database/seeds/DatabaseSeeder.php file you have to add this to the run method:
   $this->call(LaratrustSeeder::class);

-- now we need to configure the roles in Your config/laratrust_seeder.php
    I am adding superadmin,admin,inventory manager,order manager,Customer
-- then we need to migrate the data base
$ php artisan migrate
-- then wee need to seed the roles into the database
$ php artisan db:seed
-- we need to attach roles so add the code into http/contrller/auth/RegisterdUserController
    $user->attachRole("admin");
-- then we need to reister (present role is admin) so register as admin and chage the role to 
    $user->attachRole($request->role_id);
-- then we need to add a hidden input field to define a user type as a user in views/auth/register.blade.php
    <input type="hidden" name="role_id" value="user" />
-- now we need a controller to define different user views 
$ php artisan make:controller DashboardController
$ php artisan make:controller UserController
-- then add this routes to web.php
    //auth route for both 
    Route::group(['middleware' => ['auth']], function () {
        Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index')->name('dashboard');
    });
    // for admin
    Route::group(['middleware' => ['auth', 'role:admin']], function () {
    });
    // for users
    Route::group(['middleware' => ['auth', 'role:user|admin']], function () {
    });

## making starter page 
Iam using admin lte as my admin page

-- first we need to install laravel ui
$ composer require laravel/ui
-- then install bootstrap version 3.6.1 (mandatory)
$ npm i bootstrap@4.6.0
-- then we need to install adminlte3.1 (mandatory)
$ npm install admin-lte@^3.1 --save
$ npm install
-- configure some files with resources/js/bootstrap.js
    try {
        require('bootstrap');
        require('admin-lte');
    } catch (e) {}
-- resources/scss/app.scss
    
    //fontawesome
    $fa-font-path:"../webfonts";

    // Bootstrap
    @import '~bootstrap/scss/bootstrap';

    //AdminLTE
    @import '~admin-lte/dist/css/adminlte.css';

    @import "~@fortawesome/fontawesome-free/scss/fontawesome.scss";
    @import "~@fortawesome/fontawesome-free/scss/solid.scss";
    @import "~@fortawesome/fontawesome-free/scss/regular.scss";

-- then run mix js using
$ npm run dev
-- than add another link to resources/scss/app.scss
    @import "~@fortawesome/fontawesome-free/scss/brands.scss";
-- again run 
$ npm run dev



    


