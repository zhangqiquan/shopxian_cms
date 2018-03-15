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
use lib\base\SiteController; 
 
class Ad extends SiteController{ 
    public function get($id='',$limit='',$orderby='',$cat_id='0',$ad_type=''){ 
        $orderby= str_replace('__', ' ', $orderby); 
        $list=[]; 
        if($id){ 
            exit($this->index($id)); 
        }else{ 
            $where1=[ 
                [ 
                    'cat_id','=',$cat_id 
                ], 
                [ 
                    'starttime','<', time() 
                ], 
                [ 
                    'endtime','>', time() 
                ] 
            ]; 
            $where2=[ 
                [ 
                    'cat_id','=',$cat_id 
                ], 
                [ 
                    'timeset','=', 0 
                ] 
            ]; 
            if($ad_type){ 
                $where1[]=['ad_type','=',$ad_type]; 
                $where2[]=['ad_type','=',$ad_type]; 
            } 
            $list=appModel('contents', 'ContentsAd')->whereOr([$where1,$where2])->limit($limit)->order($orderby)->cache(1)->column('ad_height,title,id','id'); 
            if($list==false)exit (''); 
            foreach ($list as $key => $value) { 
                $fm='<iframe height="'.$value['ad_height'].'px" width="100%" scrolling="no"  frameborder="0" src="'. url('contents/Ad/index','id='.$value['id'], true, true).'"></iframe>'; 
                echo 'document.write(\''.$fm.'\');'; 
            } 
        } 
        die; 
    } 
 
    public function index($id){ 
        $data=appModel('contents', 'ContentsAd')->cache(3)->find($id); 
        if($data==false)exit (''); 
        $this->assign('data', $data); 
        exit($this->showTpl('index')); 
    } 
} 
