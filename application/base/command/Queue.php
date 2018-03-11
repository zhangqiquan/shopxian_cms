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
 
class Queue extends Command{ 
    protected function configure() 
    { 
        
        $this 
            ->setName('queue') 
            ->addOption('path', 'd', Option::VALUE_OPTIONAL, 'path to clear', null) 
            ->setDescription('启动队列'); 
    } 
    protected function execute(Input $input, Output $output) 
    { 
        while (true) { 
                $data=appModel('base', 'BaseQueue')->column('*'); 
                foreach ($data as $k => $v) { 
                    $obj=$v['worker']; 
                    $method=$v['method']; 
                    
                    $model=appModel('base', 'BaseQueue'); 
                    $model->where(['id'=>$v['id']])->update(['last_cosume_time'=>time()]); 
                    try { 
                        $ok=$obj::$method(json_decode($v['params'], true)); 
                        if($ok){ 
                            $model->destroy($v['id']); 
                        }else{ 
                            $model->where(['id'=>$v['id']])->update(['msg'=>'可能失败返回'.print_r($ok,1)]); 
                        } 
                    } catch (Exception $exc) { 
                        $model->where(['id'=>$v['id']])->update(['msg'=>$exc->getTraceAsString()]); 
                    } 
                } 
                sleep(1); 
        } 
    } 
} 
