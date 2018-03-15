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
namespace app\contents\lib\finder; 
 
 
class contents { 
    public $tags_rank = [ 
        '100'=>'column_operation', 
    ]; 
    public $tags = [ 
        'column_operation'=>'操作', 
    ]; 
    public $tags_field = [ 
        'column_operation'=>[ 
            'fixed'=>'right', 
            'width'=>'120', 
            'style'=>'', 
            'align'=>'', 
        ], 
    ]; 
    public $detail=[ 
         
    ]; 
    public function column_operation($row){ 
        $str='<a class="layui-btn layui-btn-xs alert_iframe" lay-event="finder_edit"  data-title="编辑" data-url="'.url('add', 'id='.str_replace('-', '@', $row['id']), true, true).'" data-height="100%"  data-width="100%"   href="javascript:void(0);">编辑</a>  <a  class="layui-btn layui-btn-danger layui-btn-xs delconfirm_row" lay-event="finder_del"   data-title="删除" data-url="'.url('del', 'id='.str_replace('-', '@', $row['id']), true, true).'" data-height="100%"  data-width="100%"    href="javascript:void(0);">删除</a>'; 
        return $str; 
    } 
    public function channeltype_id($data){ 
        return '张启全'; 
    } 
    public function cat_id($data){ 
        $cat_id=$data['cat_id']; 
        if($cat_id){ 
            $cat=appModel('contents', 'ContentsCat')->cache(2)->find($cat_id); 
            if($cat)return $cat['cat_name']; 
        }         
        return $data['cat_id']; 
    } 
}