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
 
class Crontab extends Command{ 
    protected function configure() 
    { 
        
        $this 
            ->setName('crontab') 
            ->addOption('path', 'd', Option::VALUE_OPTIONAL, 'path to clear', null) 
            ->setDescription('启动定时任务'); 
    } 
    protected function execute(Input $input, Output $output) 
    { 
        $pid='-1'; 
        $body="运行中"; 
        if(function_exists('posix_getpid')){ 
            $pid=posix_getpid(); 
            $body="脚本执行进程id:".$pid."如需杀死进程 请执行 kill -s 9 ".$pid; 
        } 
        while (true) { 
            $run_txt= json_encode([ 
                date('Y-m-d H:i:s'), 
                $body 
            ], JSON_UNESCAPED_UNICODE); 
            file_put_contents(RUNTIME_PATH.'crontab.txt', $run_txt); 
            $tasks_list=config('crontab'); 
            foreach($tasks_list as $k=>$v){ 
                $obj=new $v; 
                if($obj->configure()){ 
                    $obj->exec(); 
                    unset($obj); 
                } 
            } 
            usleep(800000); 
        } 
    } 
} 
