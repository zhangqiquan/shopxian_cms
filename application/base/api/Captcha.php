<?php 

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
