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

Route::get('add','UserController@index');

// 测试一个路由组
Route::prefix('study')->group(function(){
	Route::get('get/bonus','Study\BonusController@getBonus');

});


