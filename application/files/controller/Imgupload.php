<?php 
 
namespace app\files\controller; 
use lib\base\SiteController; 
use lib\images\Img; 
use lib\base\ShopToken; 
 
class Imgupload extends SiteController{ 
    protected $shop_id; 
    protected $water; 
    function __construct(\think\Request $request = null) { 
        parent::__construct($request); 
        $this->water= config('app.water_img'); 
        $this->shop_id=ShopToken::shopId(); 
    } 
    public function submit(){ 
        $file = request()->file('file'); 
        $info_name=$_FILES['file']['name']; 
        $dir='default'; 
        if(isset($_COOKIE['dir']))$dir=$_COOKIE['dir']; 
        
        $root_path= dirname($_SERVER['SCRIPT_FILENAME']).DIRECTORY_SEPARATOR; 
        $move_path=$root_path . 'uploads'.DIRECTORY_SEPARATOR.'business'.DIRECTORY_SEPARATOR.'shop_'.$this->shop_id.DIRECTORY_SEPARATOR.'image'.DIRECTORY_SEPARATOR.$dir.DIRECTORY_SEPARATOR. date('Ym').DIRECTORY_SEPARATOR.'level0'.DIRECTORY_SEPARATOR; 
        $info = $file->rule('uniqid')->move($move_path); 
        $save_path=''; 
        if($info){ 
            $img_type=$info->getExtension();
            $save_path=$move_path.$info->getSaveName(); 
            $Filename=$info->getFilename(); 
            $imgcompress=config("shopxian.imgcompress"); 
            foreach($imgcompress as $key=>$value){ 
                $img=new Img($save_path); 
                $img->scale($value['width'], $value['height']); 
                if($this->water)$img->water($this->water, 14); 
                $new_save_path=str_replace(DIRECTORY_SEPARATOR.'level0'.DIRECTORY_SEPARATOR, DIRECTORY_SEPARATOR.$key.DIRECTORY_SEPARATOR, $save_path); 
                $new_save_dir=dirname($new_save_path); 
                if(is_dir($new_save_dir)==false)mkdir ($new_save_dir); 
                if($img_type=='png'){ 
                    $img->savePng($new_save_path, 100); 
                }else if($img_type=='gif'){ 
                     
                }else{ 
                    $img->saveJpeg($new_save_path, 100); 
                } 
            } 
            $FileData= appModel('files', 'FilesData'); 
            $adj_path=str_replace('\\','/',str_replace($root_path, '', $save_path)); 
            $save_data=[ 
                'file_id'=> orderId(), 
                'dir'=>$dir, 
                'adj_path'=>$adj_path, 
                'file_type'=>'image', 
                'shop_id'=> $this->shop_id, 
                'file_name'=>$info_name 
            ]; 
            $FileData->save($save_data,false); 
            exit(json_encode([ 
               'status'=>'1', 
                'id'=>$FileData->file_id, 
                'path'=>$adj_path, 
                'msg'=>'操作成功' 
            ])); 






        }else{ 
            exit(json_encode([ 
               'status'=>'0', 
                'id'=>'', 
                'path'=>$adj_path, 
                'msg'=>$file->getError() 
            ])); 
        } 
        return  json_encode([ 
               'status'=>'0', 
                'id'=>'', 
                'path'=>'', 
                'msg'=>'操作失败' 
            ]); 
        die(); 
    } 
    public function file_id(){ 
        uniqid(); 
    } 
} 
