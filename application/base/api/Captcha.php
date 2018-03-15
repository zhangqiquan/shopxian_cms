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

 * 时间: 2018-03-15 19:07:10
 */  
namespace app\base\api; 
use lib\images\Captcha as lib; 
 
class Captcha { 
    public function index(){ 
        echo 222222;die; 
        $config =    [ 
            
            'fontSize'    =>    30,     
            
            'length'      =>    3,    
            
            'useNoise'    =>    false,  
            'imageH'=>500, 
            'imageW'=>300, 
            'bg'       => [242, 157, 177], 
        ]; 
        $captcha = new lib($config); 
        return $captcha->entry();  
    } 
} 
