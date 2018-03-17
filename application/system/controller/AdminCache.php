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

 * 时间: 2018-03-17 23:28:32
 */  
namespace app\system\controller; 
use lib\base\BaseController; 
use think\facade\Cache; 
use think\Log; 
 
class AdminCache extends BaseController{ 
    public function cache(){ 
        return $this->showTpl(); 
    } 
    public function cacheDataDel(){ 
        if(Cache::clear()){ 
            return $this->success("操作成功"); 
        }else{ 
            return $this->error("操作失败"); 
        } 
    } 
    public function cacheTplDel(){ 
        $dir=shopXianEnv('runtime_path').'temp'; 
        $this->delDirFiles($dir); 
        return $this->success("操作成功"); 
    } 
    public function cacheLogDel(){ 
        $dir=shopXianEnv('runtime_path').'log'; 
        $this->delDirFiles($dir); 
        return $this->success("操作成功"); 
    } 
    private function delDirFiles($dir){ 
        $files=scandir($dir); 
        foreach($files as $v){ 
            if($v!='.'&&$v!='..'){ 
                if(is_dir($dir.DIRECTORY_SEPARATOR.$v)){ 
                    $this->delDirFiles($dir.DIRECTORY_SEPARATOR.$v); 
                }else{ 
                    unlink($dir.DIRECTORY_SEPARATOR.$v); 
                } 
            } 
        } 
         
    } 
     
    public function cacheStaticDel(){ 
        $this->delStaticFiles(dirname($_SERVER['SCRIPT_FILENAME']).DIRECTORY_SEPARATOR); 
        return $this->success("操作成功"); 
    } 
    private function delStaticFiles($dir){ 
        $files=scandir($dir); 
        
        $out_dir=['static','app','apiDoc','template','libDoc']; 
        foreach($files as $v){ 
            if($v!='.'&&$v!='..'&& !in_array($v, $out_dir)){ 
                if(is_dir($dir.DIRECTORY_SEPARATOR.$v)){ 
                    $this->delStaticFiles($dir.DIRECTORY_SEPARATOR.$v); 
                }else{ 
                    $pathinfo=pathinfo($dir.DIRECTORY_SEPARATOR.$v); 
                    if(isset($pathinfo['extension'])&&config('template.view_suffix')==$pathinfo['extension']){ 
                        unlink($dir.DIRECTORY_SEPARATOR.$v); 
                    } 
                     
                } 
            } 
        } 
         
    } 
} 
