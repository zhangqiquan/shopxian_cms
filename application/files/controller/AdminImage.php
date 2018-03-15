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
namespace app\files\controller; 
use lib\base\BaseController; 
 
class AdminImage extends BaseController{ 
    use \lib\base\Finder;  
    public function index(){ 
        return $this->finder( 
                'files', 
                'files_data', 
                [],
                [ 
                    'title'=>'附件列表', 
                    'actions'=>[
                        ['type'=>'submit','url'=>url('finderDel','model=FilesData',true,true),'val'=>'批量删除','iclass'=>'delconfirm'], 
                ], 
            ] ,'file_id',[],'file_id desc' 
        ); 
    } 
 
    public function config(){ 
        $data=config('shopxian.imgcompress'); 
        $lang=lang('config_lang')['imgcompress']; 
        return $this->showTpl('config',['title'=>'图片配置','data'=>$data,'lang'=>$lang,'action'=> url('configToAdd', '', true, true)]); 
    } 
    public function configToAdd(){ 
        $post= input(); 
        $AdminConfig=new \app\system\controller\AdminConfig(); 
        if($AdminConfig->commonTo($post, 'imgcompress'))return $this->success ("操作成功"); 
        return $this->error("操作失败"); 
    } 
} 
