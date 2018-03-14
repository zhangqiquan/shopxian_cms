<?php 
 
namespace app\contents\controller; 
use lib\base\BaseController; 
use lib\contents\ContentCat; 
 
class AdminCat extends BaseController{ 
    use \lib\base\Finder;  
     
    public function index(){ 
        $this->assign('script', $this->showTpl('script')); 
        $ContentCat=new ContentCat(); 
        $all_cat= $ContentCat->all(); 
        return $this->tree( 
                $all_cat, 
                'contents_cat', 
                [],
                [ 
                    'title'=>'栏目列表', 
                    'tree_title'=>'cat_name', 
                    'tree_parent_id'=>'parent_id', 
                    'edit_url'=> url('add', '', true, true), 
                    'list_url'=> url('AdminContents/index', '', true, true), 
                    'actions'=>[
                        ['type'=>'submit','url'=>url('add','',true,true),'val'=>'添加','iclass'=>'alert_iframe','width'=>'100%','height'=>'100%'],                   
                        
                ] 
            ],'cat_id',[],'cat_id desc' 
        ); 
    } 
     
    public function add($id=''){ 
        
        $getfield=self::getDbstructField('contents', 'contents_cat', []); 
        $getfield['channeltype_id']['value']=appModel('contents', 'ContentsChannelType')->where(['status'=>'1'])->cache(3)->column('name','channeltype_id'); 
        $Cat= appModel('contents','ContentsCat')->order('rank asc')->column('cat_id,cat_name,parent_id'); 
        $data=ContentCat::treeList($Cat); 
        $cat=[]; 
        foreach($data as $k=>$v){ 
            $cat[$k]=$v['level_html'].$v['cat_name']; 
        } 
        if($cat)$getfield['parent_id']['value']+=$cat; 
        $getfield['parent_id']['default']= input('parent_id', 0); 
        
        if($id){ 
            $obj=appModel('contents','ContentsCat'); 
            $data=$obj->get($id); 
            if($data){ 
                $data=$data->toArray (); 
            } 
            foreach($data as $k=>$v){ 
                if(isset($getfield[$k]))$getfield[$k]['default']=$v; 
            } 
        } 
        return $this->formBuilder('contents', 'contents_cat',[], url('toAdd','',true,true),$getfield,[], $this->showTpl()); 
    } 
     
    public function toAdd(){ 
        $data= input(); 
        if($data['channeltype_id']==false||$data['channeltype_id']<=0)exit("请选择内容模型,如没有可选项"); 
        $ok=appModel('contents','ContentsCat')->isUpdate((isset($data['cat_id'])&&$data['cat_id']))->save($data); 
        return $this->statusMsg('true', "操作成功", url('index','',true,true)); 
    } 
    public function contentsCount($id){ 
        $ContentCat=new ContentCat(); 
        echo $ContentCat->contentsCount($id); 
        die; 
    } 
} 
