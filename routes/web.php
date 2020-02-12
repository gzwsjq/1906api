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
});

//关于用户
Route::prefix('/api')->group(function(){
    Route::get('/info','Api\UserController@userInfo');  //用户信息
    Route::post('/reg','Api\UserController@reg');  //用户注册
});

