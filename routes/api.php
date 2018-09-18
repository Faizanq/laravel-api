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

Route::prefix('user')->group(function () {
	Route::post('/register', 'UserController@register');
	Route::post('/login', 'UserController@login');
	Route::post('/userlisting', 'UserController@UserListing');
});


Route::get('/getToken','TokenController@index');

Route::apiresource('products', 'ProductController');
Route::prefix('Products')->group(function(){
    // Route::apiresource('{id}', 'ReviewController');
    Route::apiresource('{id}/reviews', 'ReviewController');
});
