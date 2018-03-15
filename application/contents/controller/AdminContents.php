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
namespace app\contents\controller; 
use lib\base\BaseController; 
use lib\contents\ContentCat; 
 
 
class AdminContents extends BaseController{ 
    use \lib\base\Finder;  
    public function index(){ 
        $tree_id= input('tree_id', false); 
        if($cat_id=input('cat_id',false))$tree_id=$cat_id; 
        unset($_GET['tree_id']); 
        $where=[]; 
        if($tree_id){ 
            $cat_ids=[$tree_id]; 
            $ContentCat=new ContentCat(); 
            $cat_ids= array_merge($ContentCat->allSonid($tree_id)); 
            $where[]=['cat_id','in',$cat_ids]; 
        } 
        return $this->finder( 
                'contents', 
                'contents', 
                $where,
                [ 
                    'fieldHeight'=>'60px', 
                    'title'=>'文档列表', 
                    'actions'=>[
                        ['type'=>'submit','url'=>url('add','cat_id='.$tree_id,true,true),'val'=>'添加','iclass'=>'alert_iframe','width'=>'98%','height'=>'98%'],                         
                        ['type'=>'submit','url'=>url('del','',true,true),'val'=>'删除','iclass'=>'delconfirm','width'=>'98%','height'=>'98%'],           
                    ], 
            ],'id',[],'id desc' 
        ); 
    } 
    public function add($id='',$cat_id=''){  
        $app_name='contents'; 
        $db_name='contents'; 
        $model='Contents'; 
        $element_id='id'; 
        $getfield=$this->getDbstructField($app_name, $db_name,[]); 
        $merge= $getfield; 
        if($id){ 
            $row=appModel($app_name, $model)->find($id); 
            if($row){ 
                $row=$row->toArray (); 
                $cat_id=$row['cat_id']; 
                foreach($row as $k=>$v){ 
                    if(isset($getfield[$k]))$merge[$k]['default']= isset ($merge[$k]['fun'])?$merge[$k]['fun']($v):$v; 
                } 
            } 
        } 
        $Cat= appModel('contents','ContentsCat')->order('rank asc')->cache(2)->column('*'); 
        $data=ContentCat::treeList($Cat); 
        $cat=[]; 
        foreach($data as $k=>$v){ 
            $merge['cat_id']['value'][$k]=$v['level_html'].$v['cat_name']; 
        } 
        $channeltype_id=1; 
        $channeltype_table_name='contents_putongwenzhang'; 
        $channeltype_model='ContentsPutongwenzhang'; 
        if($cat_id){ 
            $cat=appModel('contents','ContentsCat')->find($cat_id); 
            if($cat->channeltype_id&&$channeltype= appModel('contents', 'ContentsChannelType')->find($cat->channeltype_id)){ 
                $channeltype_table_name=$channeltype->table_name; 
                $channeltype_model= $this->getModelName($channeltype_table_name); 
            } 
            $merge['cat_id']['default']=$cat_id; 
        }     
        $getfield=$this->getDbstructField($app_name, $channeltype_table_name,['id']); 
        $merge= array_merge($merge, $getfield); 
        if($id){ 
            $row=appModel($app_name, $channeltype_model)->find($id); 
            if($row){ 
                $row=$row->toArray (); 
                foreach($row as $k=>$v){ 
                    if(isset($getfield[$k]))$merge[$k]['default']= isset ($merge[$k]['fun'])?$merge[$k]['fun']($v):$v; 
                } 
            } 
        } 
        $submit_url= url ('toAdd', "model=$model&element_id=$element_id", true, true);         
        return $this->formBuilder($app_name, $db_name,[], $submit_url,$merge); 
    } 
    public function toAdd(){ 
        $post= input('post.'); 
        if($post['cat_id']==false||$post['cat_id']<=0)exit("请选择文章栏目"); 
        $cat_id=$post['cat_id']; 
        $cat=appModel('contents','ContentsCat')->find($cat_id); 
        if($cat->channeltype_id&&$channeltype= appModel('contents', 'ContentsChannelType')->find($cat->channeltype_id)){ 
            $channeltype_table_name=$channeltype->table_name; 
            $channeltype_model= $this->getModelName($channeltype_table_name); 
            $app_name='contents'; 
            $db_name='contents'; 
            $model='Contents'; 
            $getfield=$this->getDbstructField($app_name, $db_name,[]); 
            $save_data1=[]; 
            foreach ($getfield as $key => $value) { 
                if(isset($post[$key]))$save_data1[$key]=$post[$key];                 
            } 
            
            $contentsObj=appModel($app_name, $model); 
            if($post['id']==false)unset($save_data1['id']); 
            $save_data1['add_time']= strtotime($post['add_time']); 
            $save_data1['channeltype_id']=$cat->channeltype_id; 
            $contentsObj->isUpdate($post['id']==true)->save($save_data1); 
            $id=$contentsObj->id;         
            
            $getfield=$this->getDbstructField($app_name, $channeltype_table_name,[]); 
            $save_data2=[]; 
            foreach ($getfield as $key => $value) { 
                if(isset($post[$key]))$save_data2[$key]=$post[$key];                 
            } 
            unset($save_data2['id']); 
            $save_data2['id']=$id; 
            $contentsfbObj=appModel($app_name, $channeltype_model); 
            if($contentsfbObj->find($id)){ 
                
                appModel('contents', 'ContentsCount')->isUpdate(true)->save([ 
                    'id'=>$id, 
                    'cat_id'=>$cat_id, 
                    'permission'=>$post['permission'], 
                ]); 
                $contentsfbObj->isUpdate(true)->save($save_data2);
            }else{ 
                
                appModel('contents', 'ContentsCount')->isUpdate(false)->save([ 
                    'id'=>$id, 
                    'cat_id'=>$cat_id, 
                    'permission'=>$post['permission'], 
                ]); 
                $contentsfbObj->isUpdate(false)->save($save_data2);
            } 
        }else{ 
            exit("附表不存在"); 
        } 
        return $this->statusMsg(true, "发布成功"); 
    } 
    public function del($id){ 
        if(is_array($id)){ 
            $id= array_values ($id); 
        }else{ 
            $id=[$id]; 
        } 
        $lists=appModel('contents', 'Contents')->where('id','in',$id)->column('*'); 
        appModel('contents', 'Contents')->destroy($id); 
        foreach ($lists as $k => $v) { 
            $cat=appModel('contents','ContentsCat')->find($v['cat_id']); 
            if($cat->channeltype_id&&$channeltype= appModel('contents', 'ContentsChannelType')->find($cat->channeltype_id)){ 
                
                $channeltype_table_name=$channeltype->table_name; 
                $channeltype_model= $this->getModelName($channeltype_table_name); 
                
                appModel('contents', $channeltype_model)->where(['id'=>$v['id']])->delete(); 
            } 
        } 
        return $this->statusMsg(true, "删除成功", ''); 
    } 
} 
