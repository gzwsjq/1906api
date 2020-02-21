<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  App\Model\UserModel;

class UserController extends Controller
{
    //获取用户信息
    public function userInfo(){
        $info=[
            'name'=>'lisi',
            'age'=>'20',
            'time'=>date('Y-m-d H:i:s')
        ];
        return $info;
    }

    //用户注册
    public function reg(Request $request){
        $data=request()->input();   //接收数据

        $user_name=$request->input('user_name');
        //echo 'user_name:'.$user_name;

       $user_info=[
           'user_name'=>$request->input('user_name'),
           'email'=>$request->input('email'),
           'pass'=>'123456abc',
       ];

        //=入库
        $id=UserModel::insertGetId($user_info);
        echo "自增ID：".$id;
    }



    //获取天气
    public function weather(){
        //判断
        if(empty($_GET['location'])){
            echo "请输入你所在的地理位置";die;
        }

        $location=$_GET['location']; //城市

        $url="https://free-api.heweather.net/s6/weather?location=".$location."&key=42642076daa54aec8087c116c90e4761";
        $data=file_get_contents($url);
        $arr=json_decode($data,true);
        print_r($arr);

        return $arr;
    }
}
