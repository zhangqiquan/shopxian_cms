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
        
namespace app\contents\lib\finder; 
 
 
class contents_channel_type { 
    public $tags_rank = [ 
        '100'=>'column_operation', 
    ]; 
    public $tags = [ 
        'column_operation'=>'操作', 
    ]; 
    public $detail=[ 
         
    ]; 
    public function column_operation($row){ 
        $str='<a class="layui-btn layui-btn-xs alert_iframe" lay-event="finder_edit"  data-title="编辑" data-url="'.url('finderAdd', 'id='.str_replace('-', '@', $row['id']).'&app_name=contents&db_name=contents_channel_type&element_id=channeltype_id', true, true).'" data-height="100%"  data-width="100%"   href="javascript:void(0);">编辑</a>'; 
        return $str; 
    } 
}