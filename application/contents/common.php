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

            * 时间: 2018-03-11 16:08:28
            */
        
if (!function_exists('mb_truncation')) { 
    function mb_truncation($data,$length=30){ 
        $suffix=''; 
        if(mb_strlen($data)>$length)$suffix='...'; 
        return mb_substr($data, 0, $length).$suffix; 
    } 
} 
if (!function_exists('aimg')) { 
    function aimg($data){ 
        return request()->domain().'/'.explode(',', $data)[0]; 
    } 
} 
