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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::get('/user', function (Request $request) {
    return $request->user();
});
Route::group([ 'namespace' => 'Api','prefix' => 'v1'], function() {
	//Route::post('/', array('uses' => 'LoginController@indx'));
	Route::get('/login', array('uses' => 'LoginController@login'));
	Route::post('/register', array('uses' => 'LoginController@register'));
	//Route::get('/login', array('uses' => 'LoginController@apilogin'));
	Route::get('/getClient', array('uses' => 'LoginController@client'));
	Route::get('/clientRegister', array('uses' => 'LoginController@apiregister'));
	Route::get('/callback', array('uses' => 'LoginController@callback'));
	Route::get('/redirect', array('uses' => 'LoginController@redirect'));



});
