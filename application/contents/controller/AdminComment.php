<?php 
 
namespace app\contents\controller; 
use lib\base\BaseController; 
 
class AdminComment extends BaseController{ 
    use \lib\base\Finder;  
    public function index(){ 
        return $this->finder( 
                'contents', 
                'contents_comment', 
                [],
                [ 
                    'title'=>'评论列表', 
                    'del_support'=>true, 
            ],'contents_id',[],'contents_id desc' 
        ); 
    } 
} 
