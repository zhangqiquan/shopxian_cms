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

            * 时间: 2018-03-11 16:08:28
            */
        
namespace app\contents\controller; 
use lib\base\BaseController; 
 
class AdminCustomForm extends BaseController{ 
    use \lib\base\Finder;  
    public function index(){ 
        return $this->finder( 
                'contents', 
                'contents_form', 
                [],
                [ 
                    'is_detail'=>true,
                    'finder_app'=> 'contents', 
                    'finder_name'=> 'contents_form', 
                    'title'=>'自定义表单模型', 
                    'add_support'=>true, 
                    'del_support'=>true, 
            ],'form_id',[],'form_id desc' 
        ); 
    } 
    public function finderAdd($app_name, $db_name, $element_id, $id = false) { 
        $model=$this->getModelName($db_name);        
        $getfield=$this->getDbstructField($app_name, $db_name,[]); 
        $merge=$getfield; 
        $field_list=[]; 
        if($id){ 
            $row=appModel($app_name, $model)->find($id); 
            if($row){ 
                $row=$row->toArray (); 
                foreach($row as $k=>$v){ 
                    if(isset($getfield[$k]))$merge[$k]['default']=isset ($merge[$k]['fun'])?$merge[$k]['fun']($v):$v;; 
                } 
                $field_list= json_decode($row['fields'], true); 
            } 
        }         
        $submit_url= url ('autoToAdd', "model=$model&element_id=$element_id", true, true);         
        $merge['fields']['tag_val']= $this->showTpl('',['field_list'=>$field_list]); 
        return $this->formBuilder($app_name, $db_name,[], $submit_url,$merge); 
    } 
    public function autoToAdd($model, $element_id, $url = '', $data = array()) { 
        $post= input('post.'); 
        $field_list=[]; 
        $field_list['label']=$post['label']; 
        $field_list['field']=$post['field']; 
        $field_list['input_type']=$post['input_type']; 
        $field_list['value']=$post['value']; 
        $field_list['placeholder']=$post['placeholder']; 
        $field_list['length']=$post['length']; 
        $post['fields']= json_encode($field_list, JSON_UNESCAPED_UNICODE); 
        unset($post['label'],$post['field'],$post['input_type'],$post['value'],$post['placeholder'],$post['length']); 
        if(appModel('contents', $model)->isUpdate($post['form_id']==true)->save($post))return $this->statusMsg (true, "操作成功"); 
        return $this->statusMsg (false, "操作失败"); 
    } 
} 
