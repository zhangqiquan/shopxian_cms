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
return [ 
    [ 
        "id"=>"system", 
        "name"=>"系统设置", 
        "app"=>"system", 
        "controller"=>"system", 
        "method"=>"index", 
        "rank"=>"500", 
        "display"=>true, 
        "arg"=>"", 
        "menu"=>[ 
            [ 
                "name"=>"应用中心", 
                "app"=>"base", 
                "controller"=>"AdminApp", 
                "method"=>"index", 
                "rank"=>"20", 
                "display"=>true, 
                "arg"=>"" 
            ], 
            [ 
                "name"=>"应用安装", 
                "app"=>"base", 
                "controller"=>"AdminApp", 
                "method"=>"install", 
                "rank"=>"20", 
                "display"=>false, 
                "arg"=>"" 
            ], 
            [ 
                "name"=>"应用卸载", 
                "app"=>"base", 
                "controller"=>"AdminApp", 
                "method"=>"unInstall", 
                "rank"=>"20", 
                "display"=>false, 
                "arg"=>"" 
            ], 
            [ 
                "name"=>"应用维护", 
                "app"=>"base", 
                "controller"=>"AdminApp", 
                "method"=>"maintain", 
                "rank"=>"20", 
                "display"=>false, 
                "arg"=>"" 
            ], 
            [ 
                "name"=>"应用菜单维护", 
                "app"=>"base", 
                "controller"=>"AdminApp", 
                "method"=>"dbUpdate", 
                "rank"=>"20", 
                "display"=>false, 
                "arg"=>"" 
            ], 
            [ 
                "name"=>"应用表维护", 
                "app"=>"base", 
                "controller"=>"AdminApp", 
                "method"=>"menuUpdate", 
                "rank"=>"20", 
                "display"=>false, 
                "arg"=>"" 
            ], 
            [ 
                "name"=>"系统日志", 
                "app"=>"base", 
                "controller"=>"AdminAppLog", 
                "method"=>"index", 
                "rank"=>"20", 
                "display"=>true, 
                "arg"=>"" 
            ], 
            [ 
                "name"=>"系统日志批量删除", 
                "app"=>"base", 
                "controller"=>"AdminAppLog", 
                "method"=>"finderDel", 
                "rank"=>"20", 
                "display"=>false, 
                "arg"=>"" 
            ], 
            [ 
                "name"=>"数据备份/还原", 
                "app"=>"base", 
                "controller"=>"AdminBackup", 
                "method"=>"index", 
                "rank"=>"20", 
                "display"=>true, 
                "arg"=>"" 
            ], 
            [ 
                "name"=>"数据备份", 
                "app"=>"base", 
                "controller"=>"AdminBackup", 
                "method"=>"backup", 
                "rank"=>"20", 
                "display"=>false, 
                "arg"=>"" 
            ], 
            [ 
                "name"=>"数据还原", 
                "app"=>"base", 
                "controller"=>"AdminBackup", 
                "method"=>"recover", 
                "rank"=>"20", 
                "display"=>false, 
                "arg"=>"" 
            ], 
            [ 
                "name"=>"数据还原", 
                "app"=>"base", 
                "controller"=>"AdminBackup", 
                "method"=>"del", 
                "rank"=>"20", 
                "display"=>false, 
                "arg"=>"" 
            ], 
        ]  
    ] 
]; 
 
