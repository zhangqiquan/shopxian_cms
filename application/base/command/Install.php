<?php 
 
namespace app\base\command; 
use think\config; 
use think\facade\Cache; 
use think\console\Command; 
use think\console\Input; 
use think\console\input\Option; 
use think\console\Output; 
use lib\base\mysql; 
use think\Db; 
 
class Install  extends Command{ 
    protected function configure() 
    { 
        
        $this 
            ->setName('install') 
            ->addOption('host', '数据库地址', Option::VALUE_OPTIONAL, '系统安装使用的mysql数据库地址', null) 
            ->addOption('username', '用户名', Option::VALUE_OPTIONAL, '系统安装使用的mysql用户名', null) 
            ->addOption('passwd', '密码', Option::VALUE_OPTIONAL, '系统安装使用的mysql密码', null) 
            ->addOption('dbname', '库名', Option::VALUE_OPTIONAL, '系统安装使用的mysql库名', null) 
            ->addOption('port', '端口', Option::VALUE_OPTIONAL, '系统安装使用的mysql端口号', 3306) 
            ->setDescription('安装shopxian系统'); 
    } 
    protected function execute(Input $input, Output $output) 
    { 
        $app_path= shopXianEnv('app_path'); 
        if(file_exists($app_path.'install.txt')){ 
            exit("项目已经安装,删除".$app_path.'install.txt可重装'); 
        } 
        if(!Cache::clear())exit("缓存清理失败 请手动清理");         
        $host = $input->getOption('host'); 
        if($host==false)exit ("host Can't be empty\n correct format:".$this->correctFormat()); 
        $username = $input->getOption('username'); 
        if($username==false)exit ("username Can't be empty\n correct format:".$this->correctFormat()); 
        $passwd = $input->getOption('passwd'); 
        if($passwd==false)exit ("passwd Can't be empty\n correct format:".$this->correctFormat()); 
        $dbname = $input->getOption('dbname'); 
        if($dbname==false)exit ("dbname Can't be empty\n correct format:".$this->correctFormat()); 
        $port = $input->getOption('port'); 
        if($port==false)$port=3306; 
        $mysql=new mysql(); 
        $config_path=shopXianEnv('config_path'); 
        $database= include_once $config_path.'database'.DIRECTORY_SEPARATOR.'127.0.0.1.php'; 
        $this->mysqli=new \mysqli($host, $username, $passwd, '',$port); 
        $mysql->mysqli=$this->mysqli; 
        if(mysqli_connect_errno()) 
         { 
            echo __FILE__.'==='.__LINE__; 
            return $output->writeln(mysqli_connect_error()); 
         } 
         $this->mysqli->query("create database if not exists `{$dbname}` "); 
         $is_null=$this->mysqli->query("SELECT count( * ) as count FROM information_schema.tables WHERE TABLE_SCHEMA = '{$dbname}'"); 
         $is_null=mysqli_fetch_assoc($is_null); 
         if($is_null['count']>0){ 
             return $output->writeln("error ! There must be no tables in the {$dbname} database."); 
         } 
         
         $this->writeConf([ 
             'dbhost'=>$host, 
             'dbname'=>$dbname, 
             'dbuser'=>$username, 
             'dbpw'=>$passwd, 
             'dbport'=>$port, 
             'dbprefix'=>'zs_', 
         ]); 
          
         $Update=new Update(); 
         $Update->commonExecute($input, $output);
         $base_app=config('shopxian.base_app'); 
         foreach($base_app as $v){ 
            $sql_path=$app_path.'install'.DIRECTORY_SEPARATOR.'sql'.DIRECTORY_SEPARATOR.$v.'.txt'; 
            if(file_exists($sql_path)){ 
                $handler = fopen($sql_path,'r'); 
                while(!feof($handler)){ 
                   $value=fgets($handler,4096); 
                   $value= str_replace('%s','zs_',$value ); 
                   if($value)Db::execute($value); 
               } 
            }  
         } 
        file_put_contents(shopXianEnv('app_path').'install.txt', 1); 
        return $output->writeln("\n\n installation is complete ! Backstage address: http:\/\/Your domain name/index.php/shopadmin User_name: admin Password: admin123"); 
    } 
    private function correctFormat(){ 
        return 'php think install --host 127.0.0.1 --username root --passwd 123456 --dbname shopxian --port 3306'; 
    } 
    public function writeConf($post){ 
        config([ 
            'hostname'      =>  $post['dbhost'], 
            'database'    =>  $post['dbname'], 
            'username'    =>  $post['dbuser'], 
            'password'    =>  $post['dbpw'], 
            'hostport'    =>  $post['dbport'], 
            'prefix'    =>  $post['dbprefix'], 
        ],'database'); 
        $db_config="<?php \nreturn [\n"; 
        foreach(config('database.') as $k=>$v){ 
            if(is_array($v)){ 
                $db_config.="\t'".$k."'=>["; 
                foreach ($v as $key => $value) { 
                    $db_config.="\t'".$k."'=>'".$v."',\n"; 
                } 
                $db_config.="],\n"; 
            }else{ 
                $db_config.="\t'".$k."'=>'".$v."',\n"; 
            } 
        } 
        $db_config.="];"; 
        $config_path=shopXianEnv('config_path'); 
        return file_put_contents($config_path.'database'.DIRECTORY_SEPARATOR.'127.0.0.1.php', $db_config); 
    } 
} 
