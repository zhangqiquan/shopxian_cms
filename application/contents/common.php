<?php 
 
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
