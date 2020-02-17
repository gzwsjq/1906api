<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use GuzzleHttp\Client;

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


    //获取用户的access_token
    public function getAccessToken(){
        $appid='wx1135f9fbcc72574d';
        $appsecret='3de18ef25a6c271964458e76b94a7a36';
        $url='https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$appid.'&secret='.$appsecret;
        echo $url;
        echo "<hr>";
        //使用file_get_contents发起get请求
        $res=file_get_contents($url);
        var_dump($res);
        echo "<hr>";
        $arr=json_decode($res,true);
        print_r($arr);
    }

    public function curl1(){
        $appid='wx1135f9fbcc72574d';
        $appsecret='3de18ef25a6c271964458e76b94a7a36';
        $url='https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$appid.'&secret='.$appsecret;
        echo $url;
        echo"<hr>";

        //初始化
        $ch=curl_init($url);

        //设置参数选项
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1) ; //0启用浏览器输出  1 关闭浏览器输出  可用变量接收响应

        //执行会话
        $data=curl_exec($ch);

        //关闭会话
        curl_close($ch);


        //捕获并处理错误
        $errno=curl_errno($ch);
        $error=curl_error($ch);
        if($errno>0){   //错误码为0则是不报错
            echo "错误码：".$errno;echo "<br>";
            echo "错误信息:".$error;die;
            die;
        }



        //echo "服务器响应的数据:";echo '<br>';
        //echo $data;echo "<hr>";

        //$arr=json_decode($data,true);
        //print_r($arr);
    }

    //curl post请求
    public function curl2(){
         $access_token='30_Ld-NF6ENzHQRV_dLgl8ZWpxXS0I8oF_vPdaITUSBw6Z95IEP9sc6ktFKA5eomtvXG06gqWSQyQhtCSwNxleVAm6nXBKFV1IsZlPpO8XouwDZy23MWZsqwb_JCIwCDHgAHAYZD';
         $url="https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$access_token;

        $menu=[
            "button"=>[
                    [
                        "type"=>"click",
                         "name"=>"CURL",
                         "key"=>"curl101"
                    ]
                        ]
          ];

        //初始化
        $ch=curl_init($url);

        //设置参数选项
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1) ; //0启用浏览器输出  1 关闭浏览器输出  可用变量接收响应
        //post请求
        curl_setopt($ch,CURLOPT_POST,true);
        //发送json数据 非form-data形式
        curl_setopt($ch,CURLOPT_HTTPHEADER,['Content-Type：application/json']);
        curl_setopt($ch,CURLOPT_POSTFIELDS,json_encode($menu));

        //执行会话
        $data=curl_exec($ch);

        //捕获并处理错误
        $errno=curl_errno($ch);
        $error=curl_error($ch);
        if($errno>0){   //错误码为0则是不报错
            echo "错误码：".$errno;echo "<br>";
            echo "错误信息:".$error;die;
            die;
        }

        //关闭会话
        curl_close($ch);

        //数据处理
        var_dump($data);


    }

   //guzzle get额请求
    public function guzzle1(){
        $appid='wx1135f9fbcc72574d';
        $appsecret='3de18ef25a6c271964458e76b94a7a36';
        $url='https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$appid.'&secret='.$appsecret;
        echo $url;
        echo"<hr>";

        $client=new client();
        $response=$client->request('GET',$url);
        $res=$response->getBody();  //获取服务端的响应
        echo $res;
    }

    //guzzle  post  请求
    public function guzzle2(){
        $access_token='30_3U1JTgRNkqROp1sh62zKCQvn7pXXEa3iiBRtgsZzjFDiPDveKIyki8a97JlmagKsiO0b8IA6y81zSo6kl8b_8T9ePZJeluRpfN9CJzYMgEX4bdX5wvCawNFc0w32OuZhJIHeJiD-uTlj2ZoECDLhAJAWXF';
        $url="https://api.weixin.qq.com/cgi-bin/menu/addconditional?access_token=".$access_token;

        $client=new client();
        $response = $client->post($url, [
            'headers' => ['Content-Type' => 'application/json'],
            'json' => ['token' => 'foo']
        ]);


        //$response=$client->request('POST',$url);
        $res=$response->getBody();  //获取服务端的响应
        echo $res;


    }


    //处理get请求的接口
    public function get1(){
        echo "<pre>";print_r($_GET);echo "</pre>";
    }

    //处理post请求的接口
    public function post1(){
        echo '<hr>';
        echo "我是开始 API";
        echo"<pre>";print_r($_POST);echo "</pre>";
        echo "我是结束 API";
    }

    public function post2(){
        echo "<pre>";print_r($_POST);echo "</pre>";
    }

    public function post3(){
        $data=file_get_contents("php://input");  //接收json或者xml字符串
        echo $data;echo '<hr>';

        $arr=json_decode($data,true);
        echo "<pre>";print_r($arr);echo "</pre>";
    }

    //接收post 上传文件
    public function upload(){
        echo "<pre>";print_r($_POST);echo "</pre>";
        echo "接收文件：";echo "<hr>";
        echo "<pre>";print_r($_FILES);echo "</pre>";
    }

    //guzzle的get请求
    public function guzzleGet(){
        echo "接收到的数据：";echo "<hr>";
        echo "<pre>";print_r($_GET);echo "</pre>";
    }

    //guzzle的post请求
    public function guzzlePost(){
        echo "<hr>";
        echo "我是API的开始";echo "<br>";
        echo "接收的数据：";echo "<br>";
        echo "<pre>";print_r($_POST);echo "</pre>";
        echo "我是API的结束";
        echo "<hr>";
    }


    //文件上传
    public function guzzleUpload(){
        echo "<hr>";
        echo "我是API的开始";echo "<br>";
        echo "接收的数据是：";echo "<br>";
        echo "<pre>";print_r($_POST);echo "</pre>";
        echo "上传的文件是：";echo "<br>";
        echo "<pre>";print_r($_FILES);echo "</pre>";
        echo "我是API的结束";
        echo "<hr>";
    }

    //获取当前的完整的url地址
    public function http(){
        $http=$_SERVER['REQUEST_SCHEME'];  //获取协议
        //echo $http;echo '<br>';

        $host=$_SERVER['HTTP_HOST'];//获取host
        //echo $host;echo '<br>';

        $uri=$_SERVER['REQUEST_URI'];//获取资源路径
        //echo $uri;echo '<br>';

        //完整的路径
        $url=$http.'://'.$host.$uri;
        echo "当前url:".$url;echo '<br>';

        echo "<pre>";print_r($_SERVER);echo "</pre>";
    }

    public function redisStr(){
        $key='age';
        $val='19';

        //写入值
        Redis::set($key,$val);//等价于 set name lisi

        //设置过期时间
        Redis::expire($key,300);
    }
}
