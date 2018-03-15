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
namespace app\index\controller; 
error_reporting(0); 
 
class Index { 
    public function index(){ 
        $q="CREATE TABLE `zs_base_app12155143` (`app_id` varchar(60) COMMENT '应用id' ,`app_name` varchar(60) COMMENT '应用名称' ,`description` varchar(500) COMMENT '应用描述' ,`enabled` enum('false','true') NOT NULL DEFAULT 'true' COMMENT '状态' ,PRIMARY KEY (`app_id`))ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT=''"; 
        $aaaa=\think\Db::query($q); 
        var_dump($aaaa); 
        $q="CREATE TABLE `zs_base_app455525514` (`app_id` varchar(60) COMMENT '应用id' ,`app_name` varchar(60) COMMENT '应用名称' ,`description` varchar(500) COMMENT '应用描述' ,`enabled` enum('false','true') NOT NULL DEFAULT 'true' COMMENT '状态' ,PRIMARY KEY (`app_id`))ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT=''"; 
        $aaaa=\think\Db::execute($q); 
        var_dump($aaaa); 
        die; 
        $Index=new \app\contents\controller\Index(); 
        return $Index->index(); 
    } 
} 
