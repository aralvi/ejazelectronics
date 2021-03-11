<?php

use Illuminate\Support\Facades\Artisan;
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

Route::get('/clear-all', function () {

    Artisan::call('view:clear');
    Artisan::call('route:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    // Artisan::call('config:cache');
    // Artisan::call('view:cache');

    $homeURL = url('/');

    return 'Views Cleared, Routes Cleared, Cache Cleared, and Config Cleared Successfully ! <a href="' . $homeURL . '">Go Back To Home</a>';
});

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::view('/404', '404');
Route::view(env('ADMIN_LOGIN_URI'), 'auth.admin_login');

Route::view('/activation', 'status');
Route::group(['middleware' => ['auth','checkStatus']], function () {
Route::get('/home', 'HomeController@index')->name('home');
Route::post('/generateInvoice', 'Admin\InvoicesController@store' );
Route::get('/invoice', 'HomeController@generate' );
Route::post('/autocomplete/fetch', 'Admin\InvoicesController@fetch')->name('autocomplete.fetch');
Route::get('/change-password', 'Admin\ProfileController@UserPassword');
Route::post('/password', 'Admin\ProfileController@update_UserPassword');
Route::get('print-invoice/{id}','Admin\InvoicesController@print');

});
Route::group(['prefix'=>'admin','middleware' => ['auth', 'checkStatus','checkAdmin']], function () {
    Route::get('/home', 'Admin\adminController@index');
    Route::get('/home/last-week', 'Admin\adminController@lastWeek');
    Route::get('/home/last-month', 'Admin\adminController@lastMonth');
    Route::resource('/categories','Admin\CategoriesController');
    Route::resource('/brands','Admin\BrandsController');
    Route::resource('/products','Admin\ProductsController');
    Route::resource('/stocks','Admin\StockController');
    Route::resource('/customers', 'Admin\ClientsController');
    Route::resource('/invoices','Admin\InvoicesController');
    Route::resource('/users','Admin\UsersController');
    Route::resource('/profile', 'Admin\ProfileController');
    Route::post('/profile/change_avatar', 'Admin\ProfileController@update_avatar');
    Route::get('/change-password', 'Admin\ProfileController@password');

    Route::post('/password', 'Admin\ProfileController@update_password');


});
Route::fallback(function () {
    return redirect('/404');
});
