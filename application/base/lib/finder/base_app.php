<?php 
 
namespace app\base\lib\finder; 
use lib\base\BaseController; 
 
class base_app extends BaseController{ 
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
        'detail_info'=>'应用信息', 
    ]; 
    public function column_operation($row){ 
        $str=''; 
        if($row['enabled']=='true'){ 
            if(!in_array($row['id'], config('shopxian.base_app')))$str='<a   class="layui-btn layui-btn-warm delconfirm_row" lay-event="finder_del"  data-title="卸载" data-url="'.url('unInstall', 'name='.$row['id'], true, true).'" data-height="100%"  data-width="100%" href="javascript:void(0);">卸载</a>'; 
        }else{ 
            $str='<a   class="layui-btn layui-btn-primary layui-btn-xs delconfirm_row" lay-event="finder_del"  data-title="安装" data-url="'.url('install', 'name='.$row['id'], true, true).'" data-height="100%"  data-width="100%" href="javascript:void(0);">安装</a>'; 
        } 
        return $str; 
    } 
    public function detail_info($id){ 
        $app=include shopXianEnv("app_path").$id.DIRECTORY_SEPARATOR.'app.php'; 
        $this->assign('id', $id); 
        return $this->showTpl('detail_info', $app); 
    } 
} 
