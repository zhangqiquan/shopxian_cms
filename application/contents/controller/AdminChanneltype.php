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

 * 时间: 2018-03-17 23:28:31
 */  
namespace app\contents\controller; 
use lib\base\BaseController; 
 
class AdminChanneltype extends BaseController{ 
    use \lib\base\Finder;  
    public function index(){ 
        return $this->finder( 
                'contents', 
                'contents_channel_type', 
                [],
                [ 
                    'title'=>'内容模型列表', 



                    'add_support'=>true, 
            ],'channeltype_id',[],'channeltype_id desc' 
        ); 
    } 
    public function finderAdd($app_name, $db_name, $element_id, $id = false) { 
        $getfield=self::getDbstructField('contents', 'contents_channel_type'); 
        if($id){ 
            $row=appModel('contents', 'ContentsChannelType')->find($id); 
            $field_list= json_decode($row['field_list'],true ); 
            $this->assign('field_list',$field_list); 
            if($row){ 
                $row=$row->toArray (); 
                foreach($row as $k=>$v){ 
                    if(isset($getfield[$k]))$getfield[$k]['default']=$v; 
                } 
            } 
            $getfield['name']['input_type']='readonly'; 
        } 
        $getfield['field_list']['tag_val']= $this->showTpl('add', []); 
        return $this->formBuilder('contents', 'contents_channel_type',[], url('toAdd', '', true, true),$getfield);         
    } 
    public function toAdd(){ 
        $post= input('post.'); 
        $this->verify($post); 
        $py=$this->writeDbStru($post); 
        $field_list=[]; 
        $field_list['label']=$post['label']; 
        $field_list['field']=$post['field']; 
        $field_list['input_type']=$post['input_type']; 
        $field_list['value']=$post['value']; 
        $field_list['default']=$post['default']; 
        $field_list['length']=$post['length']; 
        $post['field_list']= json_encode($field_list, JSON_UNESCAPED_UNICODE); 
        $post['table_name']='contents_'.$py; 
        unset($post['label'],$post['field'],$post['input_type'],$post['value'],$post['default'],$post['length']); 
        appModel('contents', 'ContentsChannelType')->isUpdate($post['channeltype_id']!=false)->save($post); 
        
        (new \app\base\controller\AdminApp())->updatDbstruct('contents'); 
        return $this->statusMsg(true, "操作成功"); 
    } 
     
    public function get($id){ 
        $data=appModel('contents', 'ContentsChannelType')->find($id); 
        if($data){ 
            $data=$data->toArray(); 
        }else{ 
            $data=[]; 
        } 
        exit(json_encode($data)); 
    } 
    protected function verify($post){ 
        foreach($post['label'] as $k=>$v){ 
            if($post['field'][$k]==false)exit ($v.'的字段名称不能为空'); 
            for($i=0;$i<strlen($post['field'][$k]);$i++){ 
                if(!preg_match("/^[a-zA-Z\s]+$/",$post['field'][$k][$i]))exit ($post['field'][$k].'中只能全部是英文不能带下划线或者数字'); 
            } 
            
            if(in_array($post['input_type'][$k], ['radio','checkbox','select'])){ 
                if($post['value'][$k]=='')exit ($post['field'][$k]."数据类型为radio checkbox select,可选值不能为空"); 
            } 
            
            if($post['value'][$k]){ 
                $values=explode(',', $post['value'][$k]); 
                if($post['default'][$k]&& !in_array($post['default'][$k], $values))exit($post['field'][$k].'默认值'.$post['default'][$k].'不在'.$post['value'][$k].'中'); 
            } 
            
            if($post['length'][$k]==false)exit ($post['field'][$k]."最大长度不能空且必须大于0"); 
            $lengths=explode(',', $post['length'][$k]); 
            if(count($lengths)>2)exit ($post['field'][$k].'最大长度格式错误'); 
            if(!is_numeric($lengths[0]))exit ($post['field'][$k].'最大长度格式错误'); 
            if(count($lengths)>=2){ 
                if(!is_numeric($lengths[1]))exit ($post['field'][$k].'最大长度格式错误'); 
                if($lengths[1]>5)exit ($post['field'][$k].'最大长度小数点位数请小于5'); 
            }             
        } 
    } 
    protected function writeDbStru($post){ 
        $data="<?php \nreturn [ 
    'Stru'=>[ 
        'id'=>[ 
            'type'=>'int', 
            'length'=>'11', 
            'default'=>null, 
            'label'=>'文章id', 
            'in_list' => true, 
            'input_type'=>'hidden', 
        ],"; 
        foreach($post['label'] as $k=>$v){ 
            $length=$post['length'][$k]; 
            $input_type=$post['input_type'][$k]; 
            $field=$post['field'][$k]; 
            $default=$post['default'][$k]; 
            $val_str=''; 
            if($post['value'][$k]){ 
                $values=explode(',', $post['value'][$k]); 
                $val_str="'value'=>["; 
                foreach ($values as $key => $value) { 
                    $val_str.="'{$value}'=>'{$value}',"; 
                } 
                $val_str.="],"; 
            } 
            $data.="\n        '{$field}'=>[ 
                'type'=>'varchar', 
                'length'=>'{$length}',
                'comment'=>'{$v}', 
                'label'=>'{$v}', 
                'in_list' => false, 
                {$val_str} 
                'default'=>'{$default}', 
                'input_type'=>'{$input_type}', 
            ],"; 
        } 
        $data.="\n    ], 
    'Charset'=>'utf8', 
    'Collate'=>'utf8_unicode_ci', 
    'Engine'=>'MyISAM', 
    'Annotation'=>'', 
    'primary'=>[ 
            'id', 
    ], 
];"; 
        $py=\lib\base\Pinyin::pinyin($post['name']); 
        $py=str_replace(' ', '', $py); 
        $save_path=shopXianEnv('extend_path').'dbstruct'.DIRECTORY_SEPARATOR.'contents'.DIRECTORY_SEPARATOR.'contents_'.$py.'.php'; 
        file_put_contents($save_path, $data); 
        return $py; 
    } 
} 
