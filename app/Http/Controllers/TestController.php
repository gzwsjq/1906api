<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class TestController extends Controller
{
    //-redis测试
    public function testRedis(){
        $key='1906';
        $val=time();
        Redis::set($key,$val);  //set  一个键并赋值
        $value=Redis::get($key);  //获取key的值
        echo 'value:'.$value;
    }

    public function testAaa(){
        $user_info=[
            'name'=>'zahngsan',
            'sex'=>'男',
            'age'=>'19'
        ];
        return $user_info;
    }
}
