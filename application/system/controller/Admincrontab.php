<?php 
 
namespace app\system\controller; 
use lib\base\BaseController; 
 
class Admincrontab extends BaseController{ 
    use \lib\base\Finder; 
    public function index(){ 
        return $this->finder( 
                'base', 
                'base_crontab', 
                [],
                [ 
                    'title'=>'定时任务列表',  
                    'actions'=>[
                        ['type'=>'submit','url'=>url('add','',true,true),'val'=>'添加','iclass'=>'alert_iframe','width'=>'90%','height'=>'90%'], 
                        ['type'=>'submit','url'=>url('finderDel','model=BaseCrontab',true,true),'val'=>'批量删除','iclass'=>'delconfirm'], 
                ], 
            ],'id',[],'id desc' 
        ); 
    } 
    public function add($id='') { 
        return $this->finderAdd('base', 'base_crontab', url('toAdd','',true,true),$id,  []); 
    } 
    public function toAdd($model = '', $data = '', $element_id = '', $url = '') { 
        return  $this->finderToAdd('BaseCrontab', input(), 'id', url('index','',true,true)); 
    } 
} 
