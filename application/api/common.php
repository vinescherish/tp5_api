<?php
//返回API接口错误信息
 function api_json($status=0,$msg="登录失败",$data=null){
     $result= [
         'status'=>$status,
         'msg'=>$msg,
         'data'=>$data,
     ];
      return json($result);
 }