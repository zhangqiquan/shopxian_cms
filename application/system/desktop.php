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
                "name"=>"缓存管理", 
                "app"=>"system", 
                "controller"=>"AdminCache", 
                "method"=>"cache", 
                "rank"=>"1", 
                "display"=>true, 
                "arg"=>"" 
            ], 
            [ 
                "name"=>"缓存清理操作", 
                "app"=>"system", 
                "controller"=>"AdminCache", 
                "method"=>"cacheDataDel", 
                "rank"=>"1", 
                "display"=>false, 
                "arg"=>"" 
            ], 
            [ 
                "name"=>"日志清理操作", 
                "app"=>"system", 
                "controller"=>"AdminCache", 
                "method"=>"cacheLogDel", 
                "rank"=>"1", 
                "display"=>false, 
                "arg"=>"" 
            ], 
            [ 
                "name"=>"模版清理操作", 
                "app"=>"system", 
                "controller"=>"AdminCache", 
                "method"=>"cacheDataDel", 
                "rank"=>"1", 
                "display"=>false, 
                "arg"=>"" 
            ], 
            [ 
                "name"=>"静态清理操作", 
                "app"=>"system", 
                "controller"=>"AdminCache", 
                "method"=>"cacheStaticDel", 
                "rank"=>"1", 
                "display"=>false, 
                "arg"=>"" 
            ], 
            [ 
                "name"=>"全局参数", 
                "app"=>"base", 
                "controller"=>"AdminAppConfig", 
                "method"=>"get", 
                "rank"=>"20", 
                "display"=>true, 
                "arg"=>"" 
            ], 
            [ 
                "name"=>"全局参数编辑", 
                "app"=>"base", 
                "controller"=>"AdminAppConfig", 
                "method"=>"finderAdd", 
                "rank"=>"20", 
                "display"=>false, 
                "arg"=>"" 
            ], 
            [ 
                "name"=>"全局参数保存", 
                "app"=>"base", 
                "controller"=>"AdminAppConfig", 
                "method"=>"autoToAdd", 
                "rank"=>"20", 
                "display"=>false, 
                "arg"=>"" 
            ] 
        ]  
    ] 
]; 
 
