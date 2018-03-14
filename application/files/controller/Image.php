<?php 
 
namespace app\files\controller; 
use lib\base\SiteController; 
use lib\base\ShopToken; 
use lib\files\Images; 
 
class Image extends SiteController 
{ 
    protected $shop_id; 
    function __construct(\think\Request $request = null) { 
        parent::__construct($request); 
        $this->shop_id=ShopToken::shopId(); 
    } 
    public function index($k='',$type=0) 
    { 
        $FileShopDir=[]; 
        $data=[ 
            'dir'=>$FileShopDir 
        ]; 
        $this->assign('class', $k); 
        if($type==1)return $this->showTpl('addsku',$data); 
        return $this->showTpl('',$data); 
    } 
    public function getfile($dir){ 
        $post= input(); 
        $obj= appModel('files', 'FilesData')->where(['dir'=>$dir,'shop_id'=> $this->shop_id])->order('file_id desc')->paginate(60,false,$post); 
        $data=[ 
            'list'=>$obj->toarray(), 
            'page'=>$obj->render() 
        ]; 
        echo json_encode($data); 
    } 
    
    public function upload(){ 
        $path=Images::upload(request()->file('file'), $_FILES['file']['name'], 0); 
        if($path)return $this->success ("上传成功", '', ['src'=>$path]); 
    } 
} 
