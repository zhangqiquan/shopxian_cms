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

            * 时间: 2018-03-11 18:24:39
            */
       
namespace app\contents\controller;
use lib\images\Captcha as lib;

class Captcha {
    public function index($w=130,$h=40,$fontSize=20){
        $config =    [
            
            'fontSize'    =>    $fontSize,    
            
            'length'      =>    3,   
            'imageH'   => $h,
            
            'imageW'   => $w,
        ];
        $captcha = new lib($config);
        return $captcha->entry('contents');   
    }
}
