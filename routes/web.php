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

Route::get('/', function () {
    return view('welcome');
});


//Admin 
Route::middleware('auth')->group(function(){
    Route::group(['prefix'=>'admin','as'=>'admin.'], function(){
        Route::get('dashboard', ['as' => 'dashboard', 'uses' => 'Auth\HomeController@index']);
        Route::get('add-product', ['as' => 'addProduct', 'uses' => 'ProductController@addProduct']);
        Route::get('products', ['as' => 'productList', 'uses' => 'ProductController@products']);
        Route::delete('delete-selected-product', ['as' => 'selectedProductDelete', 'uses' => 'ProductController@selectedProductsDelete']);
        Route::post('store-product', ['as' => 'storeProduct', 'uses' => 'ProductController@storeProducts']);
        Route::post('delete-product/{id}', ['as' => 'deleteProduct', 'uses' => 'ProductController@destory']);
        Route::get('logout', ['as' => 'logout', 'uses' => 'Auth\UserController@logout']);
    });
});
Route::get('login',['as'=>'login','uses'=>'Auth\UserController@login']);
Route::post('send-email-notification', ['as' => 'emailNotification', 'uses' => 'Auth\UserController@emailNotification']);
Route::get('verify-email','Auth\UserController@verifyEmail')->name('verifyEmail');
Route::get('register',['as'=>'register','uses'=>'Auth\UserController@register']);
Route::get('verify-user/{token}','Auth\UserController@verifyUserToken');
Route::post('account-modification',['as'=>'resetPassword','uses'=>'Auth\UserController@resetPassword']);
Route::post('user-login', ['as' => 'userLogin', 'uses' => 'Auth\UserController@userLogin']);
Route::post('user-register', ['as' => 'userRegister', 'uses' => 'Auth\UserController@userRegister']);

