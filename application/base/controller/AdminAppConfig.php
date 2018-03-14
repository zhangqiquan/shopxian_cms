<?php 
 
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
