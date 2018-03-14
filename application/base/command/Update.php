<?php 
 
namespace app\base\command; 
 
use think\config; 
use think\Cache; 
use think\console\Command; 
use think\console\Input; 
use think\console\input\Option; 
use think\console\Output; 
use lib\base\mysql; 
 
class Update  extends Command{ 
    protected $mysqli; 





    protected function configure() 
    { 
        
        $this 
            ->setName('update') 
            ->addOption('path', 'd', Option::VALUE_OPTIONAL, 'path to clear', null) 
            ->setDescription('维护更新dbstruct和desktop'); 
    } 
    protected function execute(Input $input, Output $output) 
    { 
        return $this->commonExecute($input, $output); 
    } 
    public function commonExecute(Input $input, Output $output){ 
       $mysql=new mysql(); 
       $database= config('database.'); 
       $this->mysqli=new \mysqli($database['hostname'], $database['username'], $database['password'], $database['database'],$database['hostport']?$database['hostport']:'3306'); 
       $mysql->mysqli=$this->mysqli; 
       if(mysqli_connect_errno()) 
        { 
           echo __FILE__.'=='.__LINE__; 
           $output->writeln(mysqli_connect_error()); 
           return false; 
        } 
        $this->mysqli->set_charset($database['charset']); 
        
        $app_path=scandir(shopXianEnv('extend_path').'dbstruct'); 
        $base_app=config('shopxian.base_app'); 
        $query_list=[]; 
        try { 
            $query_obj=$this->mysqli->query('select * from '.$database['prefix'].'base_app'); 
            $list=[]; 
            if($query_obj!=false){ 
                while ($row = mysqli_fetch_assoc ($query_obj)) { 
                    $list[]=$row['app_id']; 
                } 
            } 
            $query_list=$list; 
        } catch (Exception $exc) { 
             
        } 
        $query_list= array_merge($base_app, $query_list); 
        if($app_path){ 
          foreach($app_path as $k=>$v){ 
              if(!in_array($v, $query_list))continue; 
              if($v!='.'&&$v!='..'){ 
                  if(is_dir(shopXianEnv('extend_path').'dbstruct/'.$v)){ 
                      $dbstructure_path=scandir(shopXianEnv('extend_path').'dbstruct/'.$v); 
                      if($dbstructure_path){ 
                          foreach($dbstructure_path as $k1=>$v1){ 
                                $pathinfo=pathinfo($v1); 
                                $is_php=false; 
                                if(isset($pathinfo['extension'])&&$pathinfo['extension']=='php')$is_php=true; 
                                if($v1!='.'&&$v1!='..'&&$is_php){ 
                                    
                                    if(cache($v1)==false||cache($v1)!=  filemtime(shopXianEnv('extend_path').'dbstruct/'.$v.'/'.$v1)){ 
                                        if(!is_dir(shopXianEnv('extend_path').'model/'.$v))mkdir (shopXianEnv('extend_path').'model/'.$v); 
                                        $model_file=explode('_', $v1); 
                                        $data=  include_once shopXianEnv('extend_path').'dbstruct/'.$v.'/'.$v1; 
                                        if($model_file&&  is_array($model_file)){ 
                                            $model_file_name=''; 
                                            foreach($model_file as $k2=>$v2){ 
                                                $model_file_name.=strtoupper($v2[0]).substr($v2, 1); 
                                            } 
                                            if($model_file&&!file_exists(shopXianEnv('extend_path').'model/'.$v.'/'.$model_file_name)){ 
                                                $dbname=  str_replace('.php', '', $v1); 
                                                $dbname=  str_replace('.php', '', $v1); 
                                                $classname=  str_replace('.php', '', $model_file_name); 
                                                $primary=$data['primary']; 
                                                $pk= count($primary)==1?'"'.$primary[0].'"':''; 
                                                if($pk=='')$pk= '["'.implode ('","', $primary).'"]'; 
                                                file_put_contents(shopXianEnv('extend_path').'model/'.$v.'/'.$model_file_name, "<?php\nnamespace model\\$v;\n class  $classname extends \\think\Model{\n    protected \$table = '". $database['prefix']."{$dbname}';\n    protected \$pk = ". $pk.";\n} \n"); 
                                            } 
                                        }                                         
                                        $table_name=$database['prefix'].basename($v1,'.php'); 
                                        $result=$this->mysqli->query("SHOW FULL FIELDS FROM   {$table_name}"); 
                                        if($result==false){ 
                                            $sql= $mysql->create_sql($data,$table_name); 
                                            if($sql)$output->writeln("\n create  table\n"); 
                                        }else{ 
                                            $sql= $mysql->alert_sql($data,$table_name); 
                                            if($sql)echo "\n alter table\n"; 
                                        } 
                                        if(!empty($sql)){ 
                                            $status=$this->mysqli->query($sql); 
                                            if($status==false){ 
                                                $output->writeln('Error SQL: '.$sql."\n"); 
                                                $output->writeln('Error FILE: '.'dbstruct/'.$v.'/'.$v1."\n".mysqli_error($this->mysqli)."\n"); 
                                            }else{ 
                                                cache($v1,filemtime(shopXianEnv('extend_path').'dbstruct/'.$v.'/'.$v1),3600*10000); 
                                                $output->writeln($sql."\n\n sql Execute successfully\n\n"); 
                                            } 
                                        } 
                                    }                                     
                                } 
                          } 
                      } 
                  } 
              } 
          }   
        }         
        config('database', $database); 
        $app_path=appModel('base', 'BaseApp')->where(['enabled'=>'true'])->column('app_id'); 
        $app_path1=$app_path; 
        $app_path=array_merge($app_path,$base_app); 
        if($app_path){ 
            
            $delete=appModel('desktop', 'DesktopMenu')->where('menus_id!=0')->delete(); 
            
            $this->mysqli->query('ALTER TABLE `'.$database['prefix'].'desktop_menu` AUTO_INCREMENT=1'); 
            foreach($app_path as $k=>$v){ 
                if(file_exists(shopXianEnv('app_path').$v.DIRECTORY_SEPARATOR.'desktop.php')){ 
                    $res = include shopXianEnv('app_path').$v.DIRECTORY_SEPARATOR.'desktop.php'; 
                    if(!in_array($v, $app_path1)){ 
                        $app_config= include shopXianEnv('app_path').$v.DIRECTORY_SEPARATOR.'app.php'; 
                       appModel('base', 'BaseApp')->isUpdate(false)->save([ 
                           'app_id'=>$v, 
                           'app_name'=>$app_config['name'], 
                           'description'=>$app_config['description'], 
                           'enabled'=>'true', 
                       ]); 
                    } 
                    echo $v.",DesktopMenu update \n"; 
                    foreach($res as $k0=>$v0){ 
                        $top_id= $this->update($v0, 0); 
                        if(isset($v0['menu'])){ 
                            foreach($v0['menu'] as $k1=>$v1){ 
                                $top_id1= $this->update($v1, $top_id); 
                                if(isset($v1['menu'])){ 
                                    foreach($v1['menu'] as $k2=>$v2){ 
                                        $this->update($v2, $top_id1); 
                                    } 
                                } 
                            } 
                        } 
                    } 
                } 
            } 
        } 
        if(appModel('desktop', 'DesktopUser')->find(1)==false){ 
            appModel('desktop', 'DesktopUser')->isUpdate(false)->save(['user_id'=>1,'uname'=>'admin','pwd'=>password_encode(http_build_query(['uname'=>'admin','pwd'=>'admin123']))]); 
        } 
        echo 'ok!Some menu functions may need to be cleaned up before they can be displayed.'; 
        
        mysqli_close($this->mysqli); 
    } 
 
    public function update($arr,$pid=0,$enabled=1){ 
        $Menu=new \model\desktop\DesktopMenu(); 
        $data=[ 
            'app'=>$arr['app'], 
            'controller'=>$arr['controller'], 
            'method'=>$arr['method'], 
            'parent_id'=>$pid 
        ]; 
        $find= $Menu->where($data)->find(); 
        $data['name']=$arr['name']; 
        if($find)$find=$find->toArray(); 
        $data['parent_id']=$pid; 
        $data['arg']= isset($arr['arg'])?$arr['arg']:''; 
        $data['rank']=$arr['rank']; 
        $data['display']=$arr['display']; 
        $data['enabled']=$enabled; 
        if($find==false){ 
            $Menu->isUpdate(false)->save($data); 
        }else{ 
            $data['menus_id']=$find['menus_id']; 
            $Menu->isUpdate(true)->save($data); 
        } 
        if(isset($Menu['menus_id']))return $Menu['menus_id']; 
    } 
} 
