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
use lib\contents\ContentCat; 
 
class Cat extends Base{ 
    public function index($id){ 
        $cat=appModel('contents', 'ContentsCat')->cache(3)->find($id); 
        $tpl=''; 
        switch ($cat->getData('attribute')) { 
            case 0: 
                $tpl=$cat->getData('templist'); 
                break; 
            case 1: 
                $tpl=$cat->getData('tempindex'); 
                break; 
            case 2: 
                return $this->redirect($cat->getData('redirecturl')); 
                break; 
            default: 
                $tpl=$cat->getData('templist'); 
                break; 
        } 
        
        $data= cache(__CLASS__.$id); 
        if($data==false){ 
            $lib=new ContentCat(); 
            $data=$lib->getParentCat($id); 
            cache(__CLASS__.$id,$data,3); 
        } 
        $this->assign('parent_cat', $data); 
        $this->assign('cat', $data[count($data)-1]); 
        $this->assign('outermost_cid', $data[0]['cat_id']); 
        return $this->template('contents', $this->df_style, $tpl,[],[],true); 
    } 
} 
