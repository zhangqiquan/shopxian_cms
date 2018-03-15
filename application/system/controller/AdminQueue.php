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

 * 时间: 2018-03-15 19:07:10
 */  
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
