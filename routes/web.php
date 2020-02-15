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

Route::get('/phpinfo',function(){
    phpinfo();
});

//test测试 路由分组
Route::prefix('/test')->group(function(){
    Route::get('/redis','TestController@testRedis');
    Route::get('/aaa','TestController@testaaa');
    Route::get('/access','TestController@getAccessToken'); //获取用户accesstoken
    Route::get('/curl','TestController@curl1'); //curl
    Route::get('/curl2','TestController@curl2'); //curl
    Route::get('/guzzle','TestController@guzzle1'); //guzzle
    Route::get('/guzzle2','TestController@guzzle2'); //guzzle
});

//关于用户
Route::prefix('/api')->group(function(){
    Route::get('/info','Api\UserController@userInfo');  //用户信息
    Route::post('/reg','Api\UserController@reg');  //用户注册
});

