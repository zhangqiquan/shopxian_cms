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
         if((isset($_SERVER['LOCAL_ADDR'])&&$_SERVER['LOCAL_ADDR']=='127.0.0.1')||(isset($_SERVER['SERVER_ADDR'])&&$_SERVER['SERVER_ADDR']=='127.0.0.1')){      config('app.app_debug',true);      config('app.app_trace',true);      config('template.strip_space',false);      config('template.cache_time',false);      config('exception_tmpl',Env::get('think_path') . 'tpl/think_exception.tpl');  }  $file_path=__DIR__.DIRECTORY_SEPARATOR.'database'.DIRECTORY_SEPARATOR.'127.0.0.1.php';  if(isset($_SERVER['HTTP_HOST'])&&file_exists(__DIR__.DIRECTORY_SEPARATOR.'database'.DIRECTORY_SEPARATOR.$_SERVER['HTTP_HOST'].'.php'))$file_path=__DIR__.DIRECTORY_SEPARATOR.'database'.DIRECTORY_SEPARATOR.$_SERVER['HTTP_HOST'].'.php';  return require_once $file_path;