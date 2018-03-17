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
namespace app\install\controller; 
use app\install\lib\Install; 
use think\Session; 
use think\Db; 
error_reporting(0); 
 
class Index extends \think\Controller{ 
    function __construct() { 
        parent::__construct(); 
        if(file_exists(shopXianEnv('app_path').'install.txt')){  
            exit("项目已经安装,删除".'application/install.txt可重装');  
        }  
    } 
 
    public function index(){ 
        return $this->fetch('site/index/index'); 
    } 
    protected function getCheck(){ 
        $data['PHP_OS']              = PHP_OS; 
        $data['SERVER_SOFTWARE']     = $_SERVER['SERVER_SOFTWARE']; 
        $data['PHP_VERSION']         = PHP_VERSION; 
        $data['upload_max_filesize'] = get_cfg_var( "upload_max_filesize" ) ? get_cfg_var( "upload_max_filesize" ) : "不允许上传附件"; 
        $data['max_execution_time']  = get_cfg_var( "max_execution_time" ) . "秒 "; 
        $data['memory_limit']        = get_cfg_var( "memory_limit" ) ? get_cfg_var( "memory_limit" ) : "0"; 
        
        $data['h_PHP_VERSION'] = PHP_VERSION; 
        $data['h_Pdo']         = extension_loaded( 'Pdo' ) ? '支持' : '不支持'; 
        $data['h_Gd']          = extension_loaded( 'Gd' ) ? '支持' : '不支持'; 
        $data['h_curl']        = extension_loaded( 'curl' ) ? '支持' : '不支持'; 
        return $data; 
    } 
 
    public function check(){ 
        $this->assign('data', $this->getCheck()); 
        return $this->fetch('site/index/check'); 
    } 
    public function config(){ 
        $data=$this->getCheck(); 
        if($data['PHP_VERSION']<7){ 
            return $this->statusMsg(false, "您的环境php版本必须大于7"); 
        } 
        if($data['h_Pdo']=='不支持'){ 
            return $this->statusMsg(false, "您的环境必须支持PDO"); 
        } 
        if($data['h_Gd']=='不支持'){ 
            return $this->statusMsg(false, "您的环境必须支持GD库"); 
        } 
        if($data['h_curl']=='不支持'){ 
            return $this->statusMsg(false, "您的环境必须支持CURL"); 
        } 
        if(request()->isAjax()){ 
            echo 1;die; 
        }else{ 
            return $this->fetch('site/index/config'); 
        } 
         
    } 
    public function testdbpwd(){ 
        $post= input('post.'); 
        $obj_Install=new Install(); 
        $status=$obj_Install->link($post['dbHost'], $post['dbUser'], $post['dbPwd'], "", $post['dbport']); 
        if(is_object($status))$status=1; 
        echo $status; 
    } 
 
    public function install($appName=''){ 
        $post= input('post.'); 
        foreach ($post as $key => $value) { 
            session($key,  $value); 
        } 
        $obj_Install=new Install(); 
        $obj=$obj_Install->link($post['dbhost'], $post['dbuser'], $post['dbpw'], "", $post['dbport']); 
        $dbname=$post['dbname']; 
        $is_null=$obj->query("SELECT count( * ) as count FROM information_schema.tables WHERE TABLE_SCHEMA = '{$dbname}'"); 
         $is_null=mysqli_fetch_assoc($is_null); 
         if($is_null['count']>0){ 
             return $this->error("{$dbname} 下已经存在数据请选择一个空库安装!"); 
         } 
        
        $isExists=$obj_Install->isExists($post['dbname']); 
        if($isExists==false){ 
            return $this->error("数据库不存在或者创建失败,请检查是否有权限"); 
        } 
        $writeConf=$obj_Install->writeConf($post); 
        if($writeConf==false)return trigger_error('配置文件写入失败');     
        sleep(1); 
        return $this->redirect(url('toInstall')); 
    } 
    public function toInstall(){ 
        $deploy= config('shopxian.base_app'); 
        $return_data=['deploy'=>  json_encode($deploy)];             
        return $this->fetch('site/index/install',$return_data); 
    } 
 
    public function installApp(){ 
        $get=input(); 
        $get['error']='0'; 
        $obj_Install=new Install(); 
        $config= session(''); 
        $obj_Install->link($config['dbhost'], $config['dbuser'], $config['dbpw'], $config['dbname'], $config['dbport']); 
        $return=$obj_Install->install($get['app']); 
        if($return!=1)$get['error']=$return; 
        echo json_encode($get); 
    } 
    public function intallDesktop(){ 
        $get=input(); 
        $get['error']='0'; 
        $obj_Install=new Install(); 
        $return=$obj_Install->intallDesktop($get['app']); 
        if($return!=1)$get['error']=$return; 
        echo json_encode($get); 
    } 
    public function finish(){ 
        
        $config= session(''); 
        if($config){ 
            
            $base_app=config('shopxian.base_app'); 
            foreach($base_app as $v){ 
                $sql_path= shopXianEnv('app_path').'install'.DIRECTORY_SEPARATOR.'sql'.DIRECTORY_SEPARATOR.$v.'.txt'; 
                if(file_exists($sql_path)){ 
                    $handler = fopen($sql_path,'r'); 
                    while(!feof($handler)){ 
                       $value=fgets($handler,4096); 
                       $value= str_replace('%s','zs_',$value ); 
                       if($value)Db::execute($value); 
                   } 
                }  
            } 
            
            appModel('desktop', 'DesktopUser')->isUpdate(false)->save(['uname'=>$config['manager'],'pwd'=>password_encode(http_build_query(['uname'=>$config['manager'],'pwd'=>$config['manager_pwd']]))]); 
            file_put_contents(shopXianEnv('app_path').'install.txt', 1); 
        } 
        
        if((isset($config['demo'])&&$config['demo']==1)&& file_exists(shopXianEnv('app_path').'install'.DIRECTORY_SEPARATOR.'sql'.DIRECTORY_SEPARATOR.'init.txt')){  
            $obj_Install=new Install();  
            $obj=$obj_Install->link($config['dbhost'], $config['dbuser'], $config['dbpw'], $config['dbname'], $config['dbport']);  
            $sql_data=file_get_contents(shopXianEnv('app_path').'install'.DIRECTORY_SEPARATOR.'sql'.DIRECTORY_SEPARATOR.'init.txt'); 
            $obj->multi_query($sql_data);  
        }  
        
        session(null); 
        file_put_contents(shopXianEnv('app_path').'install.txt', 1);
        return $this->fetch('site/index/finish'); 
    } 
    public function statusMsg($status='',$msg='',$url='',$close=true){ 
        if($status)return $this->success($msg,$url,$close); 
        return $this->error($msg, $url); 
    } 
} 
