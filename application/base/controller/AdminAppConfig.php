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
namespace app\base\controller; 
use lib\base\BaseController; 
 
class AdminAppConfig extends BaseController{ 
    use \lib\base\Finder; 
    public function get(){ 
       return $this->finder( 
                'base', 
                'base_app_config', 
                [],
                [ 
                    'title'=>'参数列表', 
                    'add_support'=>true, 
            ] ,'code',[],'code desc' 
        ); 
    } 
    public function autoToAdd($model,$element_id,$url='',$data=[]){ 
         if(!$data)$data= input('post.'); 
        if($model==false||$element_id==false)return trigger_error('参数错误'); 
        $obj=appModel(request()->module(), $model); 
        $ok=$obj->isUpdate($obj->find($data[$element_id])==true)->save($data); 
        return $this->statusMsg(true, "操作成功", $url); 
     } 
} 
