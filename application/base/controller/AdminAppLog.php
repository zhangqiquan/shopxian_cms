<?php 
 
namespace app\base\controller; 
use lib\base\BaseController; 
 
class AdminAppLog extends BaseController{ 
    use \lib\base\Finder;  
    public function index($status=0){ 
        $where=[]; 
        if($status)$where['type']=$status; 
        return $this->finder( 
                'base', 
                'base_log', 
                $where,
                [ 
                    'title'=>'日志列表', 
                    'is_detail'=>true,
                    'finder_app'=> 'base', 
                    'finder_name'=> 'base_log', 
                    'tag'=>[ 
                        'all'=>['type'=>'href','url'=>url('index','status=0',true,true),'title'=>'全部'], 
                        '1'=>['type'=>'href','url'=>url('index','status=1',true,true),'title'=>'严重错误',], 
                        '2'=>['type'=>'href','url'=>url('index','status=2',true,true),'title'=>'一般错误'], 
                        '3'=>['type'=>'href','url'=>url('index','status=3',true,true),'title'=>'警告错误'], 
                        '4'=>['type'=>'href','url'=>url('index','status=4',true,true),'title'=>'一般信息',], 
                        '5'=>['type'=>'href','url'=>url('index','status=5',true,true),'title'=>'调试信息',], 
                         
                    ], 
                    'actions'=>[ 
                        ['type'=>'submit','url'=>url('finderDel','model=BaseLog',true,true),'val'=>'批量删除','iclass'=>'delconfirm'], 
                        
                        ['type'=>'submit','url'=>url('clearAll','',true,true),'val'=>'清空','iclass'=>'delconfirm_row','width'=>'90%','height'=>'90%'], 
                ], 
            ] ,'log_id',[],'log_id desc' 
        ); 
    } 
    public function clearAll(){ 
        if(appModel('base', 'BaseLog')->where('type>0')->delete()){ 
            return $this->statusMsg(true,"清空成功"); 
        } 
        return $this->statusMsg(false,"清空失败"); 
    } 
} 
