<?php 
 
namespace app\contents\controller; 
use lib\base\BaseController; 
 
class AdminFileCache extends BaseController{ 
    public function index(){ 
        return $this->showTpl(); 
    } 
} 
