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
namespace app\desktop\lib\finder; 
 
 
class desktop_role { 
    public $tags = [ 
        'caozuo'=>'操作', 
    ]; 
    public $tags_rank = [ 
        '100'=>'caozuo', 
    ]; 
    public $tags_field = [ 
        'caozuo'=>[ 
            'fixed'=>'right', 
            'width'=>'120', 
            'style'=>'', 
            'align'=>'', 
        ], 
    ]; 
    public function caozuo($row){ 
        return '<a class="layui-btn layui-btn-xs alert_iframe" lay-event="finder_edit"  data-title="编辑" data-url="'.url('add', 'id='.$row['id'], true, true).'" data-height="100%"  data-width="100%" href="javascript:void(0);">编辑</a>'; 
    } 
} 
