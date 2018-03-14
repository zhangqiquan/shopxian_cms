<?php 
 
namespace app\desktop\lib\finder; 
use lib\base\BaseController; 
 
class desktop_user extends BaseController{ 
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
        return '<a class="layui-btn layui-btn-xs alert_iframe" lay-event="finder_edit"  data-title="编辑会员" data-url="'.url('add', 'id='.$row['id'], true, true).'" data-height="80%"  data-width="80%" href="javascript:void(0);">编辑</a><a class="layui-btn layui-btn-danger layui-btn-xs delconfirm_row" lay-event="finder_del"  data-title="删除" data-url="'.url('finderDel', 'model=DesktopUser&id='.$row['id'], true, true).'" data-height="100%"  data-width="100%"  href="javascript:void(0);">删除</a>'; 
    } 
} 
