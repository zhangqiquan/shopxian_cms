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

            * 时间: 2018-03-11 18:24:39
            */
        
namespace app\contents\controller; 
use lib\contents\ContentCat; 
 
error_reporting(0); 
 
class Contents extends Base{ 
    public function index($id){ 
        $data=appModel('contents', 'Contents')->cache(3)->find($id); 
        $temparticle=appModel('contents', 'ContentsCat')->cache(3)->find($data['cat_id']); 
        $tpl=$temparticle->getData('temparticle'); 
        if($data->getData('channeltype_id')==false)$data->channeltype_id=1; 
        
        $dbstruct=[]; 
        if($data->getData('channeltype_id')&&$channeltype= appModel('contents', 'ContentsChannelType')->cache(3)->find($data->getData('channeltype_id'))){ 
            $channeltype_table_name=$channeltype->table_name; 
            $dbstruct=include shopXianEnv('extend_path').'dbstruct'.DIRECTORY_SEPARATOR.'contents'.DIRECTORY_SEPARATOR.$channeltype_table_name.'.php'; 
            foreach ($dbstruct['Stru'] as $key => $value) { 
                if($value['input_type']=='baiduUmeditor'|$key=='id')unset ($dbstruct['Stru'][$key]); 
            } 
            $dbstruct=$dbstruct['Stru']; 
            $channeltype_model= $this->getModelName($channeltype_table_name); 
            $addition=appModel('contents', $channeltype_model)->find($id); 
            if($addition==false){ 
                $addition=[]; 
            }else{ 
                $addition=$addition->toArray(); 
            }     
            $data= array_merge($addition, $data->toArray()); 
        } 
        
        $parent_cat= cache('contentsContents'.$id); 
        if($parent_cat==false){ 
            $lib=new ContentCat(); 
            $parent_cat=$lib->getParentCat($data['cat_id']); 
            cache('contentsContents'.$id,$parent_cat,3); 
        }         
        
        $up_content=appModel('contents', 'Contents')->where([['id','<',$id]])->order('id desc')->cache(3)->find(); 
        $next_content=appModel('contents', 'Contents')->where([['id','>',$id]])->order('id asc')->cache(3)->find(); 
        $up_content_data=[ 
            'url'=>'javascript:void(0);', 
            'title'=>'没有了', 
        ]; 
        if($up_content)$up_content_data=[ 
            'url'=> url("contents/Contents/index", "id=".$up_content->id, true, true), 
            'title'=>$up_content->title, 
        ]; 
        
        $next_content_data=[ 
            'url'=>'javascript:void(0);', 
            'title'=>'没有了', 
        ]; 
        if($next_content)$next_content_data=[ 
            'url'=> url("contents/Contents/index", "id=".$next_content->id, true, true), 
            'title'=>$next_content->title, 
        ]; 
        $this->assign('dbstruct', $dbstruct); 
        $this->assign('next_content', $next_content_data); 
        $this->assign('up_content', $up_content_data); 
        $this->assign('parent_cat', $parent_cat); 
        $this->assign('content', $data); 
        $this->assign('cat_id', $data['cat_id']); 
        $this->assign('outermost_cid', $parent_cat[0]['cat_id']); 
        return $this->template('contents', $this->df_style, $tpl,[],[],true); 
    } 
    public function click($id){ 
        appModel('contents', 'ContentsCount')->where(['id'=>$id])->setInc('click', 1); 
        $res=appModel('contents', 'ContentsCount')->find($id); 
        exit('document.write('.$res->getData('click').');'); 
    } 
    public function so($q){ 
        $where1=[['title','like','%'.$q.'%'],['permission','=','1']]; 
        $where2=[['description','like','%'.$q.'%'],['permission','=','1']]; 
        $list=appModel('contents', 'Contents')->whereOr([$where1,$where2])->order('id desc')->cache(30)->paginate(20,false,['query'=>['q'=>$q]]); 
        $tpl='list_search'; 
        $this->assign('keyword', $q); 
        $this->assign('page', $list->render()); 
        $this->assign('search_data', $list); 
        return $this->template('contents', $this->df_style, $tpl,[],[]); 
    } 
    public function getPraiseTrampleData($id){ 
        $row=appModel('contents', 'ContentsCount')->cache(1)->find($id); 
        $res=['praise'=> isset($row['praise'])?$row['praise']:0,'trample'=> isset($row['trample'])?$row['trample']:0]; 
        return $res; 
    } 
 
    public function praise($id){ 
        if(cookie('praise'.$id)==1)return $this->error("已经操作过了");       
        if(appModel('contents', 'ContentsCount')->where(['id'=>$id])->setInc('praise', 1)){ 
            cookie('praise'.$id, 1); 
            return $this->success ("赞成功"); 
        } 
        return $this->error ("赞失败"); 
    } 
    public function trample($id){ 
        if(cookie('praise'.$id)==1)return $this->error("已经操作过了"); 
        if(appModel('contents', 'ContentsCount')->where(['id'=>$id])->setInc('trample', 1)){ 
            cookie('praise'.$id, 1); 
            return $this->success ("踩成功"); 
        } 
        return $this->error ("踩失败"); 
    } 
    public function download($id){ 
        $row=appModel('contents', 'ContentsXiazai')->cache(30)->find($id); 
        if(!$row)return $this->_empty ();                                   
        $filepath = $row->downloadurl;   
        $arr = explode( '/' , $filepath); 
        $filename= $arr[count($arr)-1];     
        if($filepath){ 
            header("Content-type: text/plain"); 
            header("Accept-Ranges: bytes"); 
            header("Content-Disposition: attachment; filename=".$filename); 
            header("Cache-Control: must-revalidate, post-check=0, pre-check=0" ); 
            header("Pragma: no-cache" ); 
            header("Expires: 0" ); 
            readfile($filepath); 
            exit(0); 
        } 
    } 
} 
