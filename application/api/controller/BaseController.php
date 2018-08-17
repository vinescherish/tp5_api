<?php

namespace app\api\controller;

use app\api\model\Members;
use think\Controller;
use think\Request;
use Lcobucci\JWT\ValidationData;
use Lcobucci\JWT\Parser;
class BaseController extends Controller
{
    //声明一个属性来存用户信息

    public $member;
    public function _initialize()
    {
        //跨域
        header('Access-Control-Allow-Origin:*');

        //获取当前控制器方法
        $url=strtolower(\request()->controller()."/".\request()->action());
        //判断的当前地址有没有在定义的数组中有则验证

        if(in_array($url,config('black_url'))){
            //取出$token字符串
            $token=\request()->header('token')??input('token');
            if($token===null){
                exit(api_json(-1,"没有令牌"));
           }
            //验证令牌
            $token = (new Parser())->parse((string) $token); // 把字符串令牌转化成对象
            $data = new ValidationData(); //  创建一个验证的对象
            $data->setIssuer(config('url'));//设置发行者
            if($token->validate($data)===false){
               exit(api_json(-2,'您的令牌有误'));
            }
            //验证通过

             $this->member=$token->getClaim('member');
            halt($this->member);
        }


        parent::_initialize();
    }







    //返回API接口信息
//    public function apiJson($status=0,$msg="登录失败",$data=null){
//        $result= [
//            'status'=>$status,
//            'msg'=>$msg,
//            'data'=>$data,
//        ];
//        return json($result);
//    }
}
