<?php
/**
 * Created by PhpStorm.
 * User: Miss
 * Date: 2018/8/16
 * Time: 23:32
 */

namespace app\api\validate;


use think\Validate;

class Members extends  Validate
{

    protected  $rule=[
        'tel|电话号码'=>'require|unique:members'
    ];
    protected $scene=[
        'reg'=>['tel'],
    ];
}