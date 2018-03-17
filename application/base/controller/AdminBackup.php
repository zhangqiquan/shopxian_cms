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

 * 时间: 2018-03-17 23:28:31
 */  
namespace app\base\controller; 
use lib\base\BaseController; 
use lib\base\Backup; 
use app\install\lib\Install; 
 
class AdminBackup extends BaseController{ 
    public function index(){ 
        $dir=shopXianEnv('runtime_path').'Data/'; 
        $data=scandir($dir); 
        return $this->showTpl('',['data'=>$data]); 
    } 
    public function backup(){ 
        $config=array( 
            'path'     => shopXianEnv('runtime_path').'Data/',
            'part'     => 2097152000000,
            'compress' => 0,
            'level'    => 9 
        ); 
        $db= new Backup($config); 
        $schema= config('database.database'); 
        
        $sql="select table_name  
        from information_schema.tables  
        where table_schema='".$schema."'"; 
        $all_tables=\think\Db::query($sql); 
        foreach ($all_tables as $key => $value) { 
            $start= $db->setFile()->backup($value['table_name'], 0); 
            
            
        } 
        return $this->success("备份成功"); 
        
    } 
    public function recover($file){ 
        $config= config('database.'); 
        $obj_Install=new Install();  
        $obj=$obj_Install->link($config['hostname'], $config['username'], $config['password'], $config['database'], $config['hostport']);  
        $sql_data=file_get_contents(shopXianEnv('runtime_path').'Data/'.$file); 
        $obj->multi_query($sql_data);  
        return $this->success("还原成功"); 
    } 
 
    public function del($file){ 
        unlink(shopXianEnv('runtime_path').'Data/'.$file); 
        return $this->success("删除成功"); 
    } 
} 
