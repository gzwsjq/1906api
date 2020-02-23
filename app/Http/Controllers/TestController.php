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

    //访问量
    public function count(){
        //使用ua辨别用户
        $ua=$_SERVER['HTTP_USER_AGENT'];
        $u=md5($ua); //加密让ua变短
        $u=substr($u,6,6); //截取其中一段

        //允许访问次数
        $count=env('API_COUNT_NUMBER');
        // echo $count;die;

        //判断访问次数是否已到上限
        $key=$u .':count';
        $number=Redis::get($key);
        echo "现访问次数:".$number;
        echo "<br>";

        //超过上限
        if($number>$count){
            $timeout=env('API_TIMEOUT_MIN');
            Redis::expire($key,$timeout);
            echo "接口访问受限,已超过访问次数";echo "<br>";
            echo "请".$timeout."秒后访问";echo "<br>";
            die;
        }

        //已访问次数
        $num=Redis::incr($key);
        echo $num;echo '<hr>';
        echo "访问正常";

    }

    //每个接口
    public function url1(){
        $ua=$_SERVER['HTTP_USER_AGENT']; //用户ua
        $u=md5($ua); //加密让ua变短
        $u=substr($u,6,8); //截取其中一段
        echo "用户的UA:".$u;echo "<br>";

        //获取当前的uri
        $uri=$_SERVER['REQUEST_URI'];
        echo "URI为:".$uri;echo "<br>";

        $uriMd5=substr(md5($uri),0,6);
        echo $uriMd5;echo "<br>";

        $key="count:uri:".$u.":".$uriMd5;
        echo "Redis key:".$key;echo "<br>";
        echo "<br>";echo "<hr>";

        $count=Redis::get($key);
        echo "当前接口的访问数量:".$count;echo "<br>";
        $max=env('API_COUNT_NUMBER');//允许访问次数
        echo "接口访问的最大次数:".$max;echo "<br>";

        //判断
        if($count>$max){
            echo "你在不停的刷接口！！！";
            die;
        }

        Redis::incr($key);//每刷一次接口数量加1
    }

    //每个接口
    public function url2(){
        $ua=$_SERVER['HTTP_USER_AGENT']; //用户ua
        $u=md5($ua); //加密让ua变短
        $u=substr($u,6,8); //截取其中一段
        echo "用户的UA:".$u;echo "<br>";

        //获取当前的uri
        $uri=$_SERVER['REQUEST_URI'];
        echo "URI为:".$uri;echo "<br>";

        $uriMd5=substr(md5($uri),0,6);
        echo $uriMd5;echo "<br>";

        $key="count:uri:".$u.":".$uriMd5;
        echo "Redis key:".$key;echo "<br>";
        echo "<br>";echo "<hr>";

        $count=Redis::get($key);
        echo "当前接口的访问数量:".$count;echo "<br>";
        $max=env('API_COUNT_NUMBER');//允许访问次数
        echo "接口访问的最大次数:".$max;echo "<br>";

        //判断
        if($count>$max){
            echo "你在不停的刷接口！！！";
            die;
        }

        Redis::incr($key);//每刷一次接口数量加1
    }


    //发送端-->发送数据(原始数据+签名)
    public function md5Send(){
        $key="1906";   //发送端和接收端的key相同

        $str=$_GET['str']; //签名数据
        echo "签名前的数据:".$str;echo "<br>";

        //计算签名md5（原始数据+key）
        $sign=md5($str.$key);
        echo "计算的签名:".$sign;
    }


    //接收端--->接收数据（验证签名）
    public function md5Request(){
       $key="1906";    //接收端和发送端的key相同

        $data=$_GET['data'];  //接收的数据
        $sign=$_GET['sign'];  //接收的签名

        //验证签名 前提：需要与发送端使用相同的规则
        $sign2=md5($data.$key);
        echo "接收端计算的签名:".$sign2;
        echo "<br>";echo "<br>";

        //与接收到的签名对比
        if($sign2==$sign){
            echo "验证签名通过  数据完整";
        }else{
            echo "验证签名失败  数据损坏";
        }

    }

    //解密
    public function decrypt(){
        $data=$_GET['data'];  //密文

        //解密
        $length=strlen($data); //获取密文的字符串长度

        $str='';
        for($i=0;$i<$length;$i++){
            echo  $data[$i].'--'.ord($data[$i]);echo "<br>";
            $code=ord($data[$i])-1;

            echo "解密:".$data[$i].'--'.chr($code);echo "<br>";
            $str.=chr($code);
        }
        echo "解密数据:".$str;
    }

    //对称解密
    public function decrypt1(){
        $key="1120";//解密与加密的key相同

        $method="aes-128-cbc";  //算法
        $iv="queid1234xhsbdeh";    //vi必须为十六个字节 （16个ascii字符）
        echo "<hr>";echo "<br>";

        echo "接收到的数据:";echo "<br>";
        echo "<pre>";print_r($_GET);echo "</pre>";

        $dada=$_GET['data']; //接收的数据--》密文

        $b_data=base64_decode($dada);  //base64的解码
        echo "base解码数据:".$b_data;echo "<br>";

        $arr=openssl_decrypt($b_data,$method,$key,OPENSSL_RAW_DATA,$iv); //解密
        var_dump($arr);
    }


    //数据解密+签名
    public function decr(){
        $key="0000";    //接收端和发送端的key相同

        $data=$_GET['data'];  //接收的数据
        $sign=$_GET['sign'];  //接收的签名

        //验证签名 前提：需要与发送端使用相同的规则
        $sign2=md5($data.$key);
        echo "接收端计算的签名:".$sign2;
        echo "<br>";echo "<br>";

        //与接收到的签名对比
        if($sign2==$sign){
            echo "验证签名通过  数据完整";
        }else{
            echo "验证签名失败  数据损坏";
        }

        $method="aes-128-cbc";  //算法
        $iv="queid1234xhsbdeh";    //vi必须为十六个字节 （16个ascii字符）
        echo "<hr>";echo "<br>";

        echo "接收到的数据:";echo "<br>";
        echo "<pre>";print_r($_GET);echo "</pre>";

        $dada=$_GET['data']; //接收的数据--》密文

        $b_data=base64_decode($dada);  //base64的解码
        echo "base解码数据:".$b_data;echo "<br>";

        $arr=openssl_decrypt($b_data,$method,$key,OPENSSL_RAW_DATA,$iv); //解密
        var_dump($arr);
    }
}
