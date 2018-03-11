<?php 

           /**
            * 秀仙系统 shopxian_release/3.0.0
            * ============================================================================
            * * 版权所有 2017-2018 上海秀仙网络科技有限公司，并保留所有权利。
            * 网站地址: http://www.shopxian.com；
            * ----------------------------------------------------------------------------
            * 本软件只能免费使用  不允许对程序代码以任何形式任何目的再发布或者出售。
            * ============================================================================
            * 作者: 张启全 

            * 时间: 2018-03-11 16:08:51
            */
        namespace lib\base;  class Api {     use \lib\base\Reflection;     public static function run($class,$method){         $obj=new self;         $obj->__Reflection($class, $method);         $data=$obj->exec(input());         if(!in_array(true, [is_array($data),is_string($data)]))exit (abort(500, $class.'->'.$method.'()数据错误,返回结果必须是字符串或者数组'));         if(is_array($data))$data= json_encode ($data, JSON_UNESCAPED_UNICODE);         return $data;     } } 