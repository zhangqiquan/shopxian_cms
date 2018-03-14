<?php 
 
namespace app\system\controller; 
use lib\base\BaseController; 
 
class AdminQueue extends BaseController{ 
    use \lib\base\Finder; 
    public function index(){ 
        return $this->finder( 
                'base', 
                'base_queue', 
                [],
                [ 
                    'title'=>'队列执行列表',  
                    'actions'=>[
                        ['type'=>'submit','url'=>url('add','',true,true),'val'=>'添加','iclass'=>'alert_iframe','width'=>'90%','height'=>'90%'], 
                        ['type'=>'submit','url'=>url('finderDel','model=BaseQueue',true,true),'val'=>'批量删除','iclass'=>'delconfirm'], 
                ], 
            ],'id',[],'id desc' 
        ); 
    } 
} 
