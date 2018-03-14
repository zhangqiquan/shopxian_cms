<?php 

namespace app\contents\lib\finder;


class contents_form extends \lib\base\BaseController{
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
        'detail_list'=>'数据列表',
    ];
    public function column_operation($row){
        $str='';
        $str.='<a class="layui-btn layui-btn-xs alert_iframe" lay-event="finder_edit"  data-title="编辑" data-url="'.url('finderAdd', 'id='.str_replace('-', '@', $row['id']).'&app_name=contents&db_name=contents_form&element_id=form_id', true, true).'" data-height="100%"  data-width="100%"   href="javascript:void(0);">编辑</a>';
        $str.='<a class="layui-btn layui-btn-danger layui-btn-xs delconfirm_row" lay-event="finder_del"  data-title="删除" data-url="'.url('finderDel', 'model=ContentsForm&id='.$row['id'], true, true).'" data-height="100%"  data-width="100%"  href="javascript:void(0);">删除</a>';
        return $str;
    }
    public function detail_list($id){
        $data=[];
        $row=appModel('contents', 'ContentsForm')->find($id);
        $data['fields']=json_decode($row->fields, true);
        return $this->showTpl('detail_list',$data);
    }
}
