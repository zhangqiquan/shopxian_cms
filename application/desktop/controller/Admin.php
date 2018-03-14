<?php 
 
namespace app\desktop\controller; 
use lib\base\BaseController; 
use think\Request; 
use lib\desktop\Menu; 
class Admin extends BaseController 
{ 
    public function index() 
    { 
        $new_menus=Menu::getAdminMenu($this->user_id,true); 
        return $this->showTpl('',['menus'=>$new_menus]); 
    } 
    public function main(){ 
        return $this->showTpl(); 
    } 
}