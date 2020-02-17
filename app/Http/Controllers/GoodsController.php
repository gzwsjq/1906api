<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\GoodsStatisticModel;

class GoodsController extends Controller
{
    //获取用户的pv uv ip等
    public function goods(Request $request){
        $goods_id=$request->get('id'); //获取商品id
        $ua=$_SERVER['HTTP_USER_AGENT'];

        $userInfo=[
            'goods_id'=>$goods_id,
            'ua'       =>$ua,
            'ip'       =>$_SERVER['SERVER_ADDR']
        ];

        $id=GoodsStatisticModel::insertGetId($userInfo);
        echo $id;

    }
}
