<?php

namespace app\api\controller;

use app\api\model\Members;
use Mrgoon\AliSms\AliSms;
use think\Cache;
use think\Controller;
use think\Db;
use Lcobucci\JWT\Builder;

class MemberController extends BaseController
{
    /**
     * @api {get} /api/member/login 用户登录
     * @apiVersion 1.0.0
     * @apiName login
     * @apiGroup member
     *
     * @apiDescription 用户登录
     *
     * @apiParam  {String} username="admin" 用户名
     * @apiParam  {String} password="111111" 密码
     *
     */
    public function login($username, $password)
    {
        //通过用户名找到用户实列
        $member = Db::name('members')->where('username', $username)->find();
        //判断用户是否存在以及密码是否正确
        if ($member && password_verify($password, $member['password'])) {
            //验证成功
            unset($member['password']);
            //1.生成令牌
            $token = (new Builder())->setIssuer(config('url'))//配置发行者
            ->setExpiration(time() + 3600 * 24 * 7)// 令牌有效时限
            ->set('member', $member)// 存用户信息
            ->getToken(); // 得到令牌
            //把令牌放入$member
            $member['token'] = (string)$token;
            return api_json(1, '登录成功', $member);
        }
        return api_json(0, '用户名或密码不正确');
    }

    /**
     * @api {get} /api/member/detail  用户详情信息
     * @apiVersion 1.0.0
     * @apiName detail
     * @apiGroup member
     *
     * @apiDescription 用户详情信息
     *
     * @apiHeader {string}  token="eyJ0eXAiOiJKV1QiLCJhbGciOiJub25lIn0.eyJpc3MiOiJodHRwOlwvXC93d3cuYXBpLmNvbSIsImV4cCI6MTUzNTAyOTgzOSwibWVtYmVyIjp7ImlkIjoxLCJ1c2VybmFtZSI6ImFkbWluIiwidGVsIjoiMTMyOTAwMjI5MzAiLCJjcmVhdGVkX2F0IjoiMjAxOC0wNy0yOCAwNzowMzo0OCIsInVwZGF0ZWRfYXQiOiIyMDE4LTA4LTEwIDE2OjM0OjQ0IiwibW9uZXkiOiI5OTk0ODY1IiwiamlmZW4iOjIxODAxfX0."    令牌
     *
     */
    public function detail()
    {
        //得到当前用户
        $member = Db::name('members')->where('id', $this->member->id)->find();

        if ($member) {
            return api_json(1, '获取成功', $member);
        }

    }

    /**
     * @api {post} /api/member/sms  获取短信验证码
     * @apiVersion 1.0.0
     * @apiName sms
     * @apiGroup member
     *
     * @apiDescription 获取短信验证码
     *
     * @apiParam  {vachar} tel 电话号码
     *
     */
    public function sms($tel)
    {
        //生成随机验证码
        $code = rand(1000, 9999);
        //把验证码存入缓存
        Cache::set('tel_' . $tel, $code, 60 * 60);

        $aliSms = new   AliSms();
        $response = $aliSms->sendSms($tel, 'SMS_140680124', ['code' => $code], config('sms'));

        if ($response->Message === 'OK') {

            return api_json(1, '获取验证码成功');
        }
        return api_json(0, $response->Message);
    }

    /**
     * @api {post} /api/member/reg  用户注册
     * @apiVersion 1.0.0
     * @apiName reg
     * @apiGroup member
     *
     * @apiDescription 获取短信验证码
     *
     * @apiParam  {string} username 用户名
     * @apiParam  {string} password 用户密码
     * @apiParam  {vachar}  tel 电话号码
     * @apiParam  {int} sms 验证码
     *
     */
    public function reg()
    {
        if (request()->post()) {
            //接收参数
            $data = request()->post();
            //取出验证码
            $code = Cache::get('tel_' . $data['tel']);
            //验证规则
            $vatedate = $this->validate($data, 'Members.reg');
            if ($vatedate !== true) {
                return api_json(0, $vatedate);
            }
            //验证验证码
            if ((string)$code !== $data['sms']) {
                return api_json(0, '验证码有误');
            }

            //密码加密
            $data['password']=password_hash($data['password'],1);
            //入库
            unset($data['sms']);
            $result = Db::name('members')->insert($data);
            if ($result) {
                return api_json(1, '注册成功');
            }
            return api_json(0, '注册失败');
        }
    }

     /**
          * @api {post} /api/member/forget  忘记密码
          * @apiVersion 1.0.0
          * @apiName forget
          * @apiGroup member
          *
          * @apiDescription 忘记密码
          *
          * @apiParam  {String} tel  用户电话
          * @apiParam  {String} sms  验证码
          * @apiParam  {String} password  密码
          * @apiParam  {String} newPassword  再次输入密码
          *
          */
    public  function forget(){
        if(request()->post()){
            $data=request()->post();
            //取出验证码
            $code=(string)Cache::get('tel_'.$data['tel']);
            //判断用户是否存在
            $member=Db::name('members')->where('tel',$data['tel'])->find();
            if ($member ) {
                //验证验证码
                if ($code !==$data['sms']){
                    return api_json(0,'验证码错误');
                }
                if ($data['password']!== $data['newPassword']){
                    return api_json(0,'两次密码不一样');
                }
                 //密码加密
                $data['password']=password_hash($data['password'],1);
                //入库

                unset($data['sms']);
                unset($data['newPassword']);
                $result=Db::name('members')->where('tel',$data['tel'])->update($data);
                if ($result){
                    return api_json(1,'重置密码成功');
                }
                return api_json(0,'重置密码失败');
            }
            return api_json(0,'手机号不存在');
        }

    }


}
