<?php

use Illuminate\Http\Request;

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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/
/*
route for product
*/
Route::apiResource('product','ProductController');
/*
-------------------------------- route for category -----------------------------------
*/
Route::apiResource('category','CategoryController');
Route::resource('category.product','CategoryProductController',['only'=>['index']]);
/*
route for users
*/
Route::apiResource('user','UserController');
Route::get('user/varify/{token}',"UserController@varify")->name('varify');
/*
----------------------------------route for Transaction------------------------
*/
Route::resource('transaction','TransactionController',['only'=>['index','show']]);
/*
route for Transaction seller
*/
Route::resource('transaction.seller','TransactionSellerController',['only'=>['index']]);
/*
-----------------------------------route for seller--------------------------------------
*/
Route::resource('seller','SellerController',['only'=>['index','show']]);
Route::resource('seller.transaction','SellerTransactionController',['only'=>['index']]);
Route::apiResource('seller.product','SellerProductController',['except'=>['show']]);
/*
---------------------------------routes for buyer--------------------------------
*/
Route::resource('buyer','BuyerController',['only'=>['index','show']]);

/*
route for  buyer Transactions
*/
Route::resource('buyer.transaction','BuyerTransactionController',['only'=>['index']]);
/*
route for  buyer Transactions
*/
Route::resource('buyer.product','BuyerProductController',['only'=>['index']]);
/*
route for  buyer Transactions
*/
Route::resource('buyer.seller','BuyerSellerController',['only'=>['index']]);
//------------------------------------------------------------------------
Route::post('oauth/token ','\Laravel\Passport\Http\Controllers\AccessTokenController@issueToken');