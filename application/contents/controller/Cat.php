<?php 
 
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
