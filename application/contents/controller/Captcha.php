<?php 

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
