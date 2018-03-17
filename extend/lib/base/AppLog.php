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

 * 时间: 2018-03-17 23:28:43
 */   namespace lib\base;  use think\Log;  define('FATAL', 1); define('ERROR', 2); define('WARN', 3); define('INFO', 4); define('DEBUG', 5);   class AppLog {            public static function write($url,$request_data,$response_data, $type = INFO,$request_type='get',$run_time=0,$request_route='')      {          if(config('shopxian.applog_level')>=$type){              try {                  $ip= getip();                  $log_id= orderId();                  if(strlen($url)>500)$url= substr ($url, 0, 500);                  $request_data=is_array($request_data)?json_encode($request_data, JSON_UNESCAPED_UNICODE):$request_data;                  $response_data= is_array($response_data)?json_encode($response_data, JSON_UNESCAPED_UNICODE):$response_data;                  appModel('base', 'BaseLog')->save([                      'log_id'=> $log_id,                      'type'=>$type,                     'url'=>$url,                      'request_type'=>$request_type,                      'request_data'=>$request_data,                     'response_data'=>$response_data,                      'ctime'=> date('Y-m-d H:i:s'),                      'run_time'=>$run_time,                      'request_route'=>$request_route,                      'ip'=>$ip                  ],false);                  return 1;              } catch (\Exception  $exc) {                  Log::record('appLog发生致命错误,代码'.$exc->getCode().','.$exc->getFile().',行号'.$exc->getLine().','.$exc->getMessage(),'error');                  exit("日志写入错误".$exc->getMessage());              }                     }          return 0;      }  }  