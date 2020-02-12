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
}
