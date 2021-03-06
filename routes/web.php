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
Route::prefix('/test')->group(function(){   //中间件 ->middleware('api.filt')
    Route::get('/redis','TestController@testRedis');
    Route::get('/aaa','TestController@testaaa');
    Route::get('/access','TestController@getAccessToken'); //获取用户accesstoken
    Route::get('/curl','TestController@curl1'); //curl
    Route::get('/curl2','TestController@curl2'); //curl
    Route::get('/guzzle','TestController@guzzle1'); //guzzle
    Route::get('/guzzle2','TestController@guzzle2'); //guzzle

    Route::get('/get1','TestController@get1');  //处理get的请求接口
    Route::post('/post1','TestController@post1');  //处理post的请求接口
    Route::post('/post2','TestController@post2');  //处理post的请求接口
    Route::post('/post3','TestController@post3');  //处理post的请求接口

    Route::post('/upload','TestController@upload');  //处理post上传文件
    Route::get('/getHttp','TestController@http');  //获取当前完整的url地址
    Route::get('/str','TestController@redisStr');  //获取当前完整的url地址

    Route::get('/redis/count1','TestController@count'); //访问量的操作
    Route::get('/url1','TestController@url1'); //每个页面的限制访问
    Route::get('/url2','TestController@url2'); //每个页面的限制访问

    Route::get('/md1','TestController@md5Send'); //发送端
    Route::get('/md2','TestController@md5Request'); //接收端

    Route::get('/decrypt','TestController@decrypt');//解密
    Route::get('/decrypt1','TestController@decrypt1');//对称解密

    Route::get('/decr','TestController@decr'); //数据加密+签名
});

Route::prefix('/guzzle')->group(function(){
    Route::get('guzzle','TestController@guzzleGet');  //guzzle的get请求
    Route::post('guzzle1','TestController@guzzlePost');  //guzzle的post请求
    Route::post('guzzleUpload','TestController@guzzleUpload'); //文件上传 post形式
});

//关于用户
Route::prefix('/api')->group(function(){
    Route::get('/info','Api\UserController@userInfo');  //用户信息
    Route::post('/reg','Api\UserController@reg');  //用户注册

    Route::get('/weather','Api\UserController@weather'); //获取天气
});


//获取用户的pv uc ip等
Route::prefix('/goods')->group(function(){
    Route::get('/goods','GoodsController@goods');
});

//非对称解密
Route::get('/rdecr','TestController@rdecr');
Route::get('/verify','TestController@rsaVerify');//非对称加密验证签名


//支付宝接口调用
Route::prefix('/alipay')->group(function(){
    Route::get('/alipay','ApiController@test');
});

