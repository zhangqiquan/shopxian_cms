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
 
class AdminPacking extends BaseController{ 
    protected $files=[]; 
    public function release(){ 
        return $this->showTpl(); 
    } 
    public function add(){ 
        $post= input(); 
        if($post['add_path']==false|| count(explode('/', $post['add_path']))>1)return $this->error ("请填写一个正确的发布目录"); 
        if($post['save_path']==false)return $this->error ("请填写一个正确的保存目录"); 
        $path=shopXianEnv('app_path').'../'.$post['add_path']; 
        $post= input(); 
        $this->traverse($path); 
        cookie('packPost', json_encode($post)); 
        $data=['files'=> json_encode($this->files),'post'=>$post]; 
        return $this->showTpl('',$data); 
    } 
    public function toAdd($model = '', $data = '', $element_id = '', $url = '') { 
        $req= input(); 
        $post= json_decode(cookie('packPost'), true); 
        if(file_exists($post['save_path'])==false)mkdir (dirname($_SERVER['SCRIPT_FILENAME']).'/'.$post['save_path']);
        
        $mkpath=dirname($_SERVER['SCRIPT_FILENAME']) . 'public'.DIRECTORY_SEPARATOR.$post['save_path'].DIRECTORY_SEPARATOR.$post['add_path']; 
        
        $add_path_arr1=explode($post['add_path'], $req['path']); 
        if(isset($add_path_arr1[1])){$add_path_arr1=$add_path_arr1[1];}else{$add_path_arr1='';} 
        $exarr=explode(DIRECTORY_SEPARATOR, $add_path_arr1); 
        $save_file=shopXianEnv('app_path').'../'.$post['add_path'].$add_path_arr1; 
        foreach($exarr as $k=>$v){ 
            $mkpath.=$v.DIRECTORY_SEPARATOR; 
            $mkpath1= rtrim($mkpath, DIRECTORY_SEPARATOR); 
            
            if((!is_file($save_file)|| count ($exarr)-1>$k)&&!is_dir($mkpath1))mkdir ($mkpath1, 0777); 
        } 
        $mkpath= rtrim($mkpath,DIRECTORY_SEPARATOR); 
        if(is_file($save_file)){ 
            $save_data=$this->trimall($this->removeComment(file_get_contents($save_file))); 
            file_put_contents($mkpath, $save_data); 
        } 
        
        return $this->success("发布成功"); 
    } 
    public function traverse($path = '.') { 
        $path= rtrim($path,DIRECTORY_SEPARATOR); 
        $current_dir = opendir($path);    
        while(($file = readdir($current_dir)) !== false) {    
            $sub_dir = $path . DIRECTORY_SEPARATOR . $file;    
            if($file == '.' || $file == '..') { 
                continue; 
            } else if(is_dir($sub_dir)) {    
                $this->files[]=$file; 
                $this->traverse($sub_dir); 
            } else {    
                $this->files[]=$path.DIRECTORY_SEPARATOR.$file; 
            } 
        } 
    } 
     
   private function trimall($str){   
       $qian=array("\t","\r");   
       return str_replace($qian, '', $str);     
   }  
    
   private function removeComment($content){ 
     return preg_replace("/(\/\*.*\*\/)|(#.*?\n)|(\/\/.*?\n)/s", '', str_replace(array("\r\n", "\r"), "\n", $content)); 
   } 
} 
