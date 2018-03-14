<?php 

namespace app\contents\controller;
use lib\base\BaseController;

class AdminFriendLink extends BaseController{
    use \lib\base\Finder;
    public function index(){
        return $this->finder(
                'contents',
                'contents_friendlink', 
                [],
                [
                    'title'=>'友情链接列表', 
                    'add_support'=>true,
                    'del_support'=>true,
            ] ,'id',[],'id desc'
        );
    }
}
