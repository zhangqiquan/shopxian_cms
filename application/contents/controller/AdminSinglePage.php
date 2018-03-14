<?php 
 
namespace app\contents\controller; 
use lib\base\BaseController; 
 
class AdminSinglePage extends BaseController{ 
    use \lib\base\Finder;  
    public function index(){ 
        return $this->finder( 
                'contents', 
                'contents_sgpage', 
                [],
                [ 
                    'title'=>'单页内容列表', 
                    'add_support'=>true, 
                    'del_support'=>true, 
            ],'id',[],'id desc' 
        ); 
    } 
}