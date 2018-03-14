<?php 
 
 
 
 
namespace app\desktop\controller; 
use Exception; 
use think\exception\Handle; 
use think\exception\HttpException; 
 
class TestHttp  extends Handle{ 
     
    public function render(Exception $e) 
    { 
        if ($e instanceof HttpException) { 
            $statusCode = $e->getStatusCode(); 
        } 
        
        
        return parent::render($e); 
    } 
 
} 
