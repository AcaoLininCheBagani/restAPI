<?php

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
Route::group(['prefix'=>'/auth'], function(){
    Route::post('/login', 'AuthController@login');
    Route::post('/register', 'AuthController@register');
});

Route::group(['middleware'=>'api','prefix'=>'/registrados'], function(){
    
    Route::get('/','RegistradoController@index');
    Route::post('/create','RegistradoController@create');
});


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
