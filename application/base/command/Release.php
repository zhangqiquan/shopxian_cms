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

            * 时间: 2018-03-11 16:08:28
            */
        
namespace app\base\command; 
use think\console\Command; 
use think\console\Input; 
use think\console\input\Option; 
use think\console\Output; 
 
class Release  extends Command{ 
    protected function configure() 
    { 
        
        $this 
            ->setName('release') 
            ->addOption('versions', '发布的版本号', Option::VALUE_OPTIONAL, '发布的版本号如1.0', null) 
            ->addOption('apps', '发布的app列表', Option::VALUE_OPTIONAL, '发布的app列表base,items', null) 
            ->setDescription('代码发布'); 
    } 
    protected $versions; 
    protected $extension_arr=[ 
        'php', 

    ]; 
    protected $trim=[ 
        "\r", 
        "\t" 
    ]; 
    protected function execute(Input $input, Output $output) 
    { 
        $versions = $input->getOption('versions'); 
        $this->versions='shopxian_release/'.$versions; 
        if($versions==false)exit ("versions  Can't be empty\n correct format:".$this->correctFormat()); 
        $apps = $input->getOption('apps'); 
        if($apps==false)exit ("apps  Can't be empty\n correct format:".$this->correctFormat()); 
        
        $app_dir=shopXianEnv('root_path').'public'; 
        if(file_exists($app_dir.'/'.$this->versions)){ 
            echo "DIRECTORY ALREADY EXISTS ,deleting...\n"; 
            $this->unlink($app_dir.'/'.$this->versions); 
        } 
        $app_list= explode(',', $apps); 
        foreach($app_list as $v){ 
            
            $app_dir=shopXianEnv('app_path').$v; 
            $this->getAppCode($app_dir); 
        } 
        $this->trim=["\r","\n","\t"]; 
        $app_dir=shopXianEnv('extend_path').'common'; 
        $this->getAppCode($app_dir); 
         
        
        $app_dir=shopXianEnv('app_path'); 
        $this->getSaveFile($app_dir); 
         
        
        $app_dir=shopXianEnv('root_path'); 
        $this->getSaveFile($app_dir); 
         
        
        $app_dir=shopXianEnv('route_path'); 
        $this->getAppCode($app_dir); 
         
        
        $app_dir=shopXianEnv('config_path'); 
        $this->getAppCode($app_dir); 
         
        
        $app_dir=shopXianEnv('root_path').'vendor'; 
        $this->getAppCode($app_dir);         
         
        
        $this->getAppCode(shopXianEnv('root_path').'public'); 
         
        
        $this->extension_arr=['html','php']; 
        foreach($app_list as $v){ 
            
            $app_dir=shopXianEnv('extend_path').'dbstruct/'.$v; 
            $this->getAppCode($app_dir,false); 
            
            $app_dir=shopXianEnv('extend_path').'model/'.$v; 
            $this->getAppCode($app_dir,false); 
            
            $app_dir=shopXianEnv('extend_path').'lib/'.$v; 
            $this->getAppCode($app_dir,false); 
        } 
         
        $this->trim=["\r","\t"]; 
        $app_dir=shopXianEnv('extend_path').'view'; 
        $this->getAppCode($app_dir); 
         
        
        $save_path= shopXianEnv('root_path').'public/'.$this->versions.'/'; 
        file_put_contents($save_path.'public/index.php', "<?php 

           /**
            * 秀仙系统 shopxian_release/3.0.0
            * ============================================================================
            * * 版权所有 2017-2018 上海秀仙网络科技有限公司，并保留所有权利。
            * 网站地址: http://www.shopxian.com；
            * ----------------------------------------------------------------------------
            * 本软件只能免费使用  不允许对程序代码以任何形式任何目的再发布或者出售。
            * ============================================================================
            * 作者: 张启全 

            * 时间: 2018-03-11 16:08:28
            */
        namespace think; 
if(isset(\$_SERVER['PATH_INFO'])==false||\$_SERVER['PATH_INFO']=='/')exit(header('Location:/index.php/install-Index-index')); 
require __DIR__ . '/../include/base.php'; 
Container::get('app')->run()->send();"); 
         
        
        $app_dir=shopXianEnv('root_path').'include'; 
        $this->copyCode($app_dir); 
    } 
    private function correctFormat(){ 
        return 'php think release --versions 1.0.0 --apps base,desktop,contents,files,index,install,system'; 
    } 
     
    protected function getSaveFile($app_dir){ 
        $save_path= str_replace(shopXianEnv('root_path'), shopXianEnv('root_path').'public/'.$this->versions.'/', $app_dir); 
        $sca=scandir($app_dir); 
        foreach ($sca as $key => $value) { 
            if($value!='.'&&$value!='..'){ 
                $file=$app_dir.'/'.$value;     
                if(is_file($file)){ 
                    $save_file_path=$save_path.'/'.$value; 
                    
                    $pathinfo=pathinfo($value); 
                    $extension= isset($pathinfo['extension'])?$pathinfo['extension']:''; 
                    $extension_arr= $this->extension_arr; 
                    if(in_array($extension, $extension_arr)){ 
                        $save_data=$this->trimall($this->removeComment(file_get_contents($file)));
                    }else{ 
                        $save_data=file_get_contents($file);
                    } 
                    file_put_contents($save_file_path, $save_data);
                    echo $save_file_path." ok \n"; 
                } 
            } 
        }     
    } 
     
    public function getAppCode($app_dir,$essential=true){ 
        if($essential==false&&!file_exists($app_dir))return ; 
        if($essential&&!file_exists($app_dir))exit ($app_dir.' app non-existent'); 
        $save_path= str_replace(shopXianEnv('root_path'), shopXianEnv('root_path').'public/'.$this->versions.'/', $app_dir); 
        if(!file_exists($save_path)){ 
            $this->mkdirs(str_replace(shopXianEnv('root_path'), $this->versions.'/', $app_dir)); 
        } 
        $sca=scandir($app_dir); 
        foreach ($sca as $key => $value) { 
            if($value!='.'&&$value!='..'&&$value!='shopxian_release'&&$value!='.git'){ 
                $file=$app_dir.'/'.$value;                 
                if(is_dir($file)){ 
                    
                    if(!file_exists($file)){ 
                        $mkdir=str_replace(shopXianEnv('root_path'), $this->versions.'/', $app_dir).'/'.$value; 
                        $this->mkdirs($mkdir); 
                    } 
                    $this->getAppCode($file);
                }else{ 
                    $save_file_path=$save_path.'/'.$value; 
                    
                    $pathinfo=pathinfo($value); 
                    $extension= isset($pathinfo['extension'])?$pathinfo['extension']:''; 
                    $extension_arr= $this->extension_arr; 
                    if(in_array($extension, $extension_arr)){ 
                        $save_data=$this->trimall($this->removeComment(file_get_contents($file)));
                    }else{ 
                        $save_data=file_get_contents($file);
                    } 
                    $save_data= $this->addComment($save_data, $extension); 
                    file_put_contents($save_file_path, $save_data);
                    echo $save_file_path." ok \n"; 
                } 
            } 
        } 
    } 
     
     
   private function trimall($str){   
       foreach($this->trim as $v){ 
           $str=str_replace($v, " ", $str);    
       } 


       return $str; 
   }  
    
   private function removeComment($content){ 
        return preg_replace('/((\/\*[\s\S]*?\*\/)|(\/\/.*))/', '', $content); 
   } 
   private function addComment($content,$suffix){ 
       $date= date('Y-m-d H:i:s'); 
       $versions=$this->versions; 
       $data=" 
            
       "; 
       if($suffix=='php')return str_replace ('<?php 

           /**
            * 秀仙系统 shopxian_release/3.0.0
            * ============================================================================
            * * 版权所有 2017-2018 上海秀仙网络科技有限公司，并保留所有权利。
            * 网站地址: http://www.shopxian.com；
            * ----------------------------------------------------------------------------
            * 本软件只能免费使用  不允许对程序代码以任何形式任何目的再发布或者出售。
            * ============================================================================
            * 作者: 张启全 

            * 时间: 2018-03-11 16:08:28
            */
       ', "<?php 

           /**
            * 秀仙系统 shopxian_release/3.0.0
            * ============================================================================
            * * 版权所有 2017-2018 上海秀仙网络科技有限公司，并保留所有权利。
            * 网站地址: http://www.shopxian.com；
            * ----------------------------------------------------------------------------
            * 本软件只能免费使用  不允许对程序代码以任何形式任何目的再发布或者出售。
            * ============================================================================
            * 作者: 张启全 

            * 时间: 2018-03-11 16:08:28
            */
        \n".$data, $content); 
       return $content; 
   } 
   protected function mkdirs($path){ 
        $path=str_replace('\\', '/', $path); 
        $exarr=explode('/',$path); 
        $mkpath=shopXianEnv('root_path').'public/'; 
        foreach($exarr as $k=>$v){ 
            $mkpath.=$v.DIRECTORY_SEPARATOR; 
            if(!is_dir($mkpath)&&$v)mkdir ($mkpath, 0777); 
        } 
   } 
   protected function unlink($dir){ 
       $sca=scandir($dir); 
        foreach ($sca as $key => $value) { 
            if($value!='.'&&$value!='..'){ 
                $file=$dir.'/'.$value; 
                if(is_dir($file)){ 
                    $this->unlink($file); 
                }else{ 
                    unlink($file); 
                } 
            } 
        }     
   } 
   protected function copyCode($app_dir){ 
        if(!file_exists($app_dir))exit ($app_dir.' app non-existent'); 
        $save_path= str_replace(shopXianEnv('root_path'), shopXianEnv('root_path').'public/'.$this->versions.'/', $app_dir); 
        if(!file_exists($save_path)){ 
            $this->mkdirs(str_replace(shopXianEnv('root_path'), $this->versions.'/', $app_dir)); 
        } 
        $sca=scandir($app_dir); 
        foreach ($sca as $key => $value) { 
            if($value!='.'&&$value!='..'&&$value!='shopxian_release'&&$value!='.git'){ 
                $file=$app_dir.'/'.$value;                 
                if(is_dir($file)){ 
                    
                    if(!file_exists($file)){ 
                        $mkdir=str_replace(shopXianEnv('root_path'), $this->versions.'/', $app_dir).'/'.$value; 
                        $this->mkdirs($mkdir); 
                    } 
                    $this->copyCode($file);
                }else{ 
                    $save_file_path=$save_path.'/'.$value; 
                    
                    copy($file, $save_file_path); 
                    echo $save_file_path."  copy ok \n"; 
                } 
            } 
        } 
   } 
} 
