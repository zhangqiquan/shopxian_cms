<?php 
 
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
