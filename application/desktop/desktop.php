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
                "name"=>"用户管理", 
                "app"=>"desktop", 
                "controller"=>"AdminUser", 
                "method"=>"index", 
                "rank"=>"1", 
                "display"=>true, 
                "arg"=>"", 
                "menu"=>[ 
                    [ 
                        "name"=>"用户列表", 
                        "app"=>"desktop", 
                        "controller"=>"AdminUser", 
                        "method"=>"column", 
                        "rank"=>"1", 
                        "display"=>true, 
                        "arg"=>"" 
                    ], 
                    [ 
                        "name"=>"用户编辑", 
                        "app"=>"desktop", 
                        "controller"=>"AdminUser", 
                        "method"=>"add", 
                        "rank"=>"1", 
                        "display"=>false, 
                        "arg"=>"" 
                    ], 
                    [ 
                        "name"=>"用户保存", 
                        "app"=>"desktop", 
                        "controller"=>"AdminUser", 
                        "method"=>"toAdd", 
                        "rank"=>"1", 
                        "display"=>false, 
                        "arg"=>"" 
                    ], 
                    [ 
                        "name"=>"用户删除", 
                        "app"=>"desktop", 
                        "controller"=>"AdminUser", 
                        "method"=>"finderDel", 
                        "rank"=>"1", 
                        "display"=>false, 
                        "arg"=>"" 
                    ], 
                    [ 
                        "name"=>"用户角色", 
                        "app"=>"desktop", 
                        "controller"=>"AdminRolea", 
                        "method"=>"index", 
                        "rank"=>"2", 
                        "display"=>true, 
                        "arg"=>"" 
                    ], 
                    [ 
                        "name"=>"角色编辑", 
                        "app"=>"desktop", 
                        "controller"=>"AdminRolea", 
                        "method"=>"add", 
                        "rank"=>"2", 
                        "display"=>false, 
                        "arg"=>"" 
                    ], 
                    [ 
                        "name"=>"角色保存", 
                        "app"=>"desktop", 
                        "controller"=>"AdminUser", 
                        "method"=>"toAdd", 
                        "rank"=>"2", 
                        "display"=>false, 
                        "arg"=>"" 
                    ], 
            ] 
        ] 
             
        ]  
    ] 
]; 
 
