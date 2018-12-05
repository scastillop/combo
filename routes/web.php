<?php

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


Route::group(['middleware' => ['auth']], function() {
	Route::get('/', function () {
    return view('app');
	});
	Route::get('/home', function () {
	    return view('app');
	});
	Route::resource('sales', 'SaleController');
	Route::resource('promos', 'PromoController');
	Route::resource('customers', 'CustomerController');
	Route::resource('families', 'FamilyController');
	Route::resource('products', 'ProductController');
	Route::resource('providers', 'ProviderController');
	Route::resource('purchase_orders', 'PurchaseOrderController');
	Route::post('/products/search','ProductController@search');
});
//login
Auth::routes();


