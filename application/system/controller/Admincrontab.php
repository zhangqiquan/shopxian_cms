<?php 

           /**
            * 秀仙系统 shopxian_release/3.0.0
            * ============================================================================
            * * 版权所有 2017-2018 上海秀仙网络科技有限公司，并保留所有权利。
            * 网站地址: http://www.shopxian.com；
            * ----------------------------------------------------------------------------
            * 本软件只能免费使用  不允许对程序代码以任何形式任何目的再发布或者出售。
            * ============================================================================
            * 作者: 张启全 

            * 时间: 2018-03-11 18:24:39
            */
        
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
