<?php 

namespace app\contents\lib\finder;


class contents_ad {
    public $tags_rank = [
        '100'=>'column_operation',
    ];
    public $tags_field = [
        'column_operation'=>[
            'fixed'=>'right',
            'width'=>'120',
            'style'=>'',
            'align'=>'',
        ],
    ];
    public $tags = [
        'column_operation'=>'操作',
    ];
    public $detail=[
    ];
    public function column_operation($row){
        $str='';
        $str.='<a class="layui-btn layui-btn-xs alert_iframe" lay-event="finder_edit"  data-title="编辑" data-url="'.url('finderAdd', 'id='.str_replace('-', '@', $row['id']).'&app_name=contents&db_name=contents_ad&element_id=id', true, true).'" data-height="100%"  data-width="100%"   href="javascript:void(0);">编辑</a>';
        $str.='<a class="layui-btn layui-btn-danger layui-btn-xs delconfirm_row" lay-event="finder_del"  data-title="删除" data-url="'.url('finderDel', 'model=ContentsAd&id='.$row['id'], true, true).'" data-height="100%"  data-width="100%"  href="javascript:void(0);">删除</a>';
        return $str;
    }
}
