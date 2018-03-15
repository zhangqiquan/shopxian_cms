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
namespace app\base\controller; 
use lib\base\BaseController; 
use think\facade\Cache; 
use lib\base\mysql; 
use think\Db; 
use lib\base\Zip; 
set_time_limit(0); 
 
class AdminApp extends BaseController{ 
    use \lib\base\Finder; 
    public function index(){ 
        if(Request()->isAjax()){ 
            $res=$this->getLayFinderData('base', 'base_app', [],[],'app_id',[],'app_id desc'); 
            exit(json_encode($res, JSON_UNESCAPED_UNICODE)); 
        } 
        return $this->finder( 
                'base', 
                'base_app', 
                [],
                [ 
                    'title'=>'应用管理列表', 
                    'is_detail'=>true,
                    'finder_app'=> 'base', 
                    'finder_name'=> 'base_app', 
                    'actions'=>[
                        ['type'=>'submit','url'=>url('maintain','',true,true),'val'=>'维护','iclass'=>'alert_iframe','width'=>'80%','height'=>'80%'], 
                ], 
            ],'app_id',[],'app_id desc' 
        ); 
    } 
    private function getLayFinderData($app_name, $table_name, $where = array(), $arguments = array(), $element_id, $out_field = array(), $order_by = 'desc') { 
        $model_file=explode('_', $table_name); 
         $model='Model不存在'; 
        if($model_file&&  is_array($model_file)){ 
            $model=''; 
            foreach($model_file as $k2=>$v2){ 
                $model.=strtoupper($v2[0]).substr($v2, 1); 
            } 
        }     
        $getfield= self::getFinderField($app_name, $table_name,$out_field); 
        $input= input();         
        $rule_satisfy=['eq','neq','elt','egt','like','between']; 
        foreach($getfield as $k=>$v){ 
            if(isset($input[$k])&&isset($input[$k]['val'])&& in_array(trim($input[$k]['rule']), $rule_satisfy)){ 
                $rule=trim($input[$k]['rule']); 
                $val=trim($input[$k]['val'],''); 
                $like=''; 
                if($rule=='like')$like='%'; 
                $val=$like.$val.$like; 
                $where[$k]=[$rule,$val]; 
            } 
        } 
        $field= implode(',',array_keys($getfield)); 
        $obj= appModel($app_name, $model); 
        $limit= input('limit', 1000); 
        
        $list_obj = $obj->where($where)->field($element_id.' as id,'.$field)->order($order_by)->cache(1)->paginate($limit,false); 
        $list_obj=$list_obj->toArray(); 
        $data=[]; 
        $app_path=scandir(shopXianEnv('app_path')); 
        if($app_path){ 
            $data_key=array_column($list_obj['data'], 'id'); 
            $out_app=['extra']; 
            foreach($app_path as $k=>$v){ 
                if(!in_array($v, $data_key)&& !in_array($v, $out_app)){ 
                    if(file_exists(shopXianEnv('app_path').$v.DIRECTORY_SEPARATOR.'app.php')){ 
                        $res = include shopXianEnv('app_path').$v.DIRECTORY_SEPARATOR.'app.php';     
                        $list_obj['data'][]=[ 
                            'id'=>$v, 
                            'app_id'=>$v, 
                            'app_name'=>$res['name'], 
                            'description'=>$res['description'], 
                            'enabled'=>'false' 
                        ]; 
                        $data[$v]=$res; 
                    } 
                } 
                 
            } 
        } 
        if(true){ 
            foreach ($list_obj['data'] as $key => $value) { 
                $list_obj['data'][$key]['finder_detail']='<i onClick="selectDetails(this)"  data-id="'.$value['id'].'" style="font-size: 28px;" class="icon Hui-iconfont finder_detail">&#xe681;</i>'; 
            } 
        } 
        $res=[ 
            'code'=>$list_obj['total']?0:1, 
            'msg'=>'没有数据', 
            'count'=>count($list_obj['data']), 
            'data'=> $this->getStructVals($app_name, $table_name, $list_obj['data']) 
        ]; 
        return $res; 
    } 
 
    public function maintain(){         
        $dbstruct_arr= appModel('base', 'BaseApp')->where(['enabled'=>'true'])->column('app_id'); 
        return $this->showTpl('',['data'=> json_encode($dbstruct_arr)]); 
    } 
    
    public function menuUpdate($app){ 
        $app_path=shopXianEnv('app_path'); 
        $res = include $app_path.$app.DIRECTORY_SEPARATOR.'desktop.php'; 
        $Update=new \app\base\command\Update(); 
        foreach($res as $k0=>$v0){ 
            $top_id= $Update->update($v0, 0); 
            if(isset($v0['menu'])){ 
                foreach($v0['menu'] as $k1=>$v1){ 
                    $top_id1= $Update->update($v1, $top_id); 
                    if(isset($v1['menu'])){ 
                        foreach($v1['menu'] as $k2=>$v2){ 
                            $Update->update($v2, $top_id1); 
                        } 
                    } 
                } 
            } 
        } 
        return $app.' menu维护完成'."\n"; 
    } 
    
    public function dbUpdate($app){ 
        $this->updatDbstruct($app); 
        return $app.' db维护完成'."\n"; 
    } 
    public function updatDbstruct($v){ 
        if(!file_exists(shopXianEnv('extend_path').'dbstruct/'.$v))return ; 
        $database= config('database.'); 
        $this->mysqli=new \mysqli($database['hostname'], $database['username'], $database['password'], $database['database'],$database['hostport']?$database['hostport']:'3306'); 
        $mysql=new mysql(); 
        $mysql->mysqli=$this->mysqli; 
        $dbstructure_path=scandir(shopXianEnv('extend_path').'dbstruct/'.$v); 
        if($dbstructure_path){ 
            foreach($dbstructure_path as $k1=>$v1){ 
                  $pathinfo=pathinfo($v1); 
                  $is_php=false; 
                  if(isset($pathinfo['extension'])&&$pathinfo['extension']=='php')$is_php=true; 
                  if($v1!='.'&&$v1!='..'&&$is_php){ 
                      
                      if(true){ 
                          if(!is_dir(shopXianEnv('extend_path').'model/'.$v))mkdir (shopXianEnv('extend_path').'model/'.$v); 
                            $model_file=explode('_', $v1); 
                            $data=  include shopXianEnv('extend_path').'dbstruct/'.$v.'/'.$v1; 
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
                          $data=  include shopXianEnv('extend_path').'dbstruct/'.$v.'/'.$v1; 
                          $table_name=$database['prefix'].basename($v1,'.php'); 
                          $result=$this->mysqli->query("SHOW FULL FIELDS FROM   {$table_name}");         
                          if($result==false){ 
                              $sql= $mysql->create_sql($data,$table_name); 
                          }else{ 
                              $sql= $mysql->alert_sql($data,$table_name); 
                          } 
                          if(!empty($sql)){ 
                              $status=$this->mysqli->query($sql); 
                              if($status==false){ 
                                  exit('Error SQL: '.$sql."\n".mysqli_error($this->mysqli)); 
                              } 
                          } 
                      }                                     
                  } 
            } 
        } 
    } 
 
     
    public function install($name){ 
        $row=appModel('base', 'BaseApp')->find($name); 
        $exist=true; 
        if($row==false)$exist=false; 
        $app_path=shopXianEnv('app_path'); 
        $app_config= include $app_path.$name.DIRECTORY_SEPARATOR.'app.php'; 
        
        if($row)appModel('base', 'BaseApp')->where(['app_id'=>$name])->update(['enabled'=>'true','app_name'=>$app_config['name'],'description'=>$app_config['description']]); 
        if($row==false)appModel('base', 'BaseApp')->isUpdate(false)->save(['app_id'=>$name,'enabled'=>'true','app_name'=>$app_config['name'],'description'=>$app_config['description']]); 
        if(file_exists($app_path.$name.DIRECTORY_SEPARATOR.'desktop.php')){ 
            $res = include $app_path.$name.DIRECTORY_SEPARATOR.'desktop.php'; 
            $Update=new \app\base\command\Update(); 
            foreach($res as $k0=>$v0){ 
                $top_id= $Update->update($v0, 0); 
                if(isset($v0['menu'])){ 
                    foreach($v0['menu'] as $k1=>$v1){ 
                        $top_id1= $Update->update($v1, $top_id); 
                        if(isset($v1['menu'])){ 
                            foreach($v1['menu'] as $k2=>$v2){ 
                                $Update->update($v2, $top_id1); 
                            } 
                        } 
                    } 
                } 
            } 
            $this->updatDbstruct($name); 
            
            if($exist==false){ 
                $sql_path=$app_path.'install'.DIRECTORY_SEPARATOR.'sql'.DIRECTORY_SEPARATOR.$name.'.txt'; 
                if(file_exists($sql_path)){ 
                    $handler = fopen($sql_path,'r'); 
                    while(!feof($handler)){ 
                       $value=fgets($handler,4096); 
                       $value= str_replace('%s','zs_',$value ); 
                       if($value)Db::execute($value); 
                   } 
                }                 
            } 
            Cache::clear(); 
        } 
        return $this->statusMsg(true,"安装成功");         
    } 
    public function unInstall($name){ 
        appModel('base', 'BaseApp')->isUpdate(true)->save(['app_id'=>$name,'enabled'=>'false']); 
        $Menu= appModel('desktop', 'DesktopMenu'); 
        $Menu->where(['app'=>$name])->update(['enabled'=>'0']); 
        Cache::clear(); 
        return $this->statusMsg(true,"卸载成功"); 
    } 
    public function appUpdate($app,$code=0){ 
        if($code==1){ 
            return $this->getAppCode($app); 
        } 
        $curl=new \lib\base\Curl('array'); 
        $url='http:/'.'/service.shopxian.com/api-getsysversions-app-'.$app; 
        $versions=$curl->post($url); 
        if($versions['data']){ 
            $appinfo= include shopXianEnv('app_path').$app.DIRECTORY_SEPARATOR.'app.php'; 
            if($versions['data']>$appinfo['version']){ 
                exit(json_encode(['code'=>'1','msg'=>'有更新的版本:'.$versions['data']])); 
            }else{ 
                exit(json_encode(['code'=>'0','msg'=>'现在是最新版本不需要更新'])); 
            } 
        }else{ 
            exit(json_encode(['code'=>'-1','msg'=>'更新服务器连接失败'])); 
        } 
    } 
    private function getAppCode($app){ 
        $url='http:/'.'/service.shopxian.com/api-downloadsysapp-app-'.$app; 
        $s = file_get_contents($url); 
        $f=@file_put_contents(shopXianEnv('runtime_path').$app.'.zip', $s); 
        if($f){ 
            
             $yzip=new Zip(shopXianEnv('runtime_path').$app.'.zip');
            $yzip->extract(shopXianEnv('runtime_path').$app); 
            
            $yzip->close(); 
            
            unlink(shopXianEnv('runtime_path').$app.'.zip'); 
            if($yzip==true){ 
                
                $this->copyUpdate($app); 
                 
            }else{ 
                exit(json_encode(['code'=>'0','msg'=>'更新文件解析失败'])); 
            } 
        }else{ 
            exit(json_encode(['code'=>'0','msg'=>'下载失败'])); 
        } 
    } 
    protected function copyUpdate($app){ 
        $app_dir=shopXianEnv('runtime_path').$app; 
        if($this->copyCode($app_dir,$app)){ 
            $this->unlink($app_dir); 
            $res=json_encode(['code'=>'1','msg'=>'更新成功']); 
            return exit($res); 
        } 
        return exit(json_encode(['code'=>'0','msg'=>'失败'])); 
    } 
    protected function copyCode($app_dir,$app){ 
        if(!file_exists($app_dir))exit ($app_dir.' app non-existent'); 
        $save_path= str_replace('runtime/'.$app.'/', '', $app_dir); 
        $sca=scandir($app_dir); 
        foreach ($sca as $key => $value) { 
            if($value!='.'&&$value!='..'&&$value!='.git'){ 
                $file=$app_dir.'/'.$value;        
                
                if(is_dir($file)){ 
                    
                    $save_file=$save_path.'/'.$value; 
                    if(!file_exists($save_file)){ 
                        $mkdir=str_replace(shopXianEnv('root_path'), '',$save_file); 
                        $this->mkdirs($mkdir);
                    } 
                    $this->copyCode($file,$app);
                }else{ 
                    $save_file_path=$save_path.'/'.$value; 
                    
                    $ok=copy($file, $save_file_path); 
                } 
            } 
        } 
        return true; 
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
   protected function mkdirs($path){ 
        $path=str_replace('\\', '/', $path); 
        $exarr=explode('/',$path); 
        $mkpath=shopXianEnv('root_path'); 
        foreach($exarr as $k=>$v){ 
            $mkpath.=$v.DIRECTORY_SEPARATOR; 
            if(!is_dir($mkpath)&&$v)mkdir ($mkpath, 0777); 
        } 
   } 
} 
