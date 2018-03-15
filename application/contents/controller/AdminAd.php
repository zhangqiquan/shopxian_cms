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
 
class AdminAd extends BaseController{ 
    use \lib\base\Finder;  
    public function index(){         
        return $this->finder( 
                'contents', 
                'contents_ad', 
                [],
                [ 
                    'title'=>'广告列表', 
                    'add_support'=>true, 
                    'del_support'=>true, 
            ],'id',[],'id desc' 
        ); 
    } 
    public function finderAdd($app_name, $db_name, $element_id, $id = false) { 
        $getfield=self::getDbstructField('contents', 'contents_ad'); 
        $Cat= appModel('contents','ContentsCat')->order('rank asc')->column('cat_id,cat_name,parent_id'); 
        $data=ContentCat::treeList($Cat); 
        $cat=[];         
        foreach($data as $k=>$v){ 
            $cat[$k]=$v['level_html'].$v['cat_name']; 
        } 
        $getfield['cat_id']['value']+=$cat; 
         
        $row=[]; 
        if($id){ 
            $row=appModel('contents', 'ContentsAd')->find($id); 
            if($row){ 
                $row=$row->toArray (); 
                foreach($row as $k=>$v){ 
                    if(isset($getfield[$k]))$getfield[$k]['default']=isset ($getfield[$k]['fun'])?$getfield[$k]['fun']($v):$v;; 
                } 
                if($row['starttime']==0)$getfield['starttime']['default']=''; 
                if($row['endtime']==0)$getfield['endtime']['default']=''; 
                if($row['ad_type']!='code')$row['ad_body']= json_decode ($row['ad_body'], true); 
            } 
        } 
        $submit_url= url('toAdd'); 
        $this->assign('row', $row); 
        $getfield['ad_body']['tag_val']= $this->showTpl('add', []); 
        return $this->formBuilder('contents', 'contents_ad',[], $submit_url,$getfield); 
    } 
    public function toAdd() { 
        $post= input('post.'); 
        if($post['cat_id']==-1)return $this->statusMsg(false, "请选择广告投放范围"); 
        switch ($post['ad_type']) { 
            case 'aimg': 
                if($post['__aimg_path']==false)return $this->statusMsg(false, "图片地址不能为空"); 
                if($post['__aimg_link']==false)return $this->statusMsg(false, "图片链接不能为空"); 
                if($post['__aimg_alt']==false)return $this->statusMsg(false, "图片描述不能为空"); 
                appModel('contents', 'ContentsAd')->isUpdate($post['id']==true)->save([ 
                    'id'=>$post['id'], 
                    'cat_id'=>$post['cat_id'], 
                    'title'=>$post['title'], 
                    'timeset'=>$post['timeset'], 
                    'starttime'=>$post['starttime']?strtotime($post['starttime']):'', 
                    'endtime'=>$post['endtime']?strtotime($post['endtime']):'', 
                    'ad_type'=>$post['ad_type'], 
                    'rank'=>$post['rank'], 
                    'add_time'=> time(), 
                    'ad_body'=> json_encode([ 
                        'path'=>$post['__aimg_path'], 
                        'link'=>$post['__aimg_link'], 
                        'alt'=>$post['__aimg_alt'] 
                    ], JSON_UNESCAPED_UNICODE), 
                    'ad_height'=>$post['ad_height'], 
                    'user_id'=> $this->user_id, 
                ]); 
                break; 
            case 'text': 
                if($post['__text_body']==false)return $this->statusMsg(false, "文字内容不能为空"); 
                if($post['__text_link']==false)return $this->statusMsg(false, "文字链接不能为空"); 
                if($post['__text_color']==false)return $this->statusMsg(false, "文字颜色不能为空"); 
                appModel('contents', 'ContentsAd')->isUpdate($post['id']==true)->save([ 
                    'id'=>$post['id'], 
                    'cat_id'=>$post['cat_id'], 
                    'title'=>$post['title'], 
                    'timeset'=>$post['timeset'], 
                    'starttime'=>$post['starttime']?strtotime($post['starttime']):'', 
                    'endtime'=>$post['endtime']?strtotime($post['endtime']):'', 
                    'ad_type'=>$post['ad_type'], 
                    'rank'=>$post['rank'], 
                    'add_time'=> time(), 
                    'ad_body'=> json_encode([ 
                        'text'=>$post['__text_body'], 
                        'link'=>$post['__text_link'], 
                        'color'=>$post['__text_color'], 
                        'font_size'=>$post['__text_font_size'] 
                    ], JSON_UNESCAPED_UNICODE), 
                    'ad_height'=>$post['ad_height'], 
                    'user_id'=> $this->user_id, 
                ]); 
                break; 
            case 'imgs': 
                if(isset($post['__imgs'])==false)return $this->statusMsg(false, "幻灯片数据没有提交"); 
                foreach ($post['__imgs'] as $key => $value) { 
                    if($value==false)return $this->statusMsg(false, "图片地址不能为空"); 
                    if($post['__imgs_link'][$key]==false)return $this->statusMsg(false, "图片链接不能为空"); 
                    if($post['__imgs_alt'][$key]==false)return $this->statusMsg(false, "图片描述不能为空"); 
                } 
                appModel('contents', 'ContentsAd')->isUpdate($post['id']==true)->save([ 
                    'id'=>$post['id'], 
                    'cat_id'=>$post['cat_id'], 
                    'title'=>$post['title'], 
                    'timeset'=>$post['timeset'], 
                    'starttime'=>$post['starttime']?strtotime($post['starttime']):'', 
                    'endtime'=>$post['endtime']?strtotime($post['endtime']):'', 
                    'ad_type'=>$post['ad_type'], 
                    'rank'=>$post['rank'], 
                    'add_time'=> time(), 
                    'ad_body'=> json_encode([ 
                        'path'=>$post['__imgs'], 
                        'link'=>$post['__imgs_link'], 
                        'alt'=>$post['__imgs_alt'] 
                    ], JSON_UNESCAPED_UNICODE), 
                    'ad_height'=>$post['ad_height'], 
                    'user_id'=> $this->user_id, 
                ]); 
                break; 
            case 'code': 
                if($post['__code']==false)return $this->statusMsg(false, "广告代码不能为空"); 
                appModel('contents', 'ContentsAd')->isUpdate($post['id']==true)->save([ 
                    'id'=>$post['id'], 
                    'cat_id'=>$post['cat_id'], 
                    'title'=>$post['title'], 
                    'timeset'=>$post['timeset'], 
                    'starttime'=>$post['starttime']?strtotime($post['starttime']):'', 
                    'endtime'=>$post['endtime']?strtotime($post['endtime']):'', 
                    'ad_type'=>$post['ad_type'], 
                    'rank'=>$post['rank'], 
                    'add_time'=> time(), 
                    'ad_body'=>$post['__code'] , 
                    'ad_height'=>$post['ad_height'], 
                    'user_id'=> $this->user_id, 
                ]); 
                break; 
            default: 
                return $this->statusMsg(false, "未知的广告类型"); 
                break; 
        } 
        return $this->statusMsg(true, "操作成功"); 
    } 
} 
