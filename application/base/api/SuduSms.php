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
namespace app\base\api; 
use lib\base\Curl; 
error_reporting(0); 
 
class SuduSms { 
    protected $description='106接口网，乐清市速度网络有限公司'; 
     
     
    public function send($params=[]){ 
        if(is_numeric(session('sms_send_time'))&&(session('sms_send_time')+120> time()))exit (json_encode(['status'=>false,'msg'=>'请在120秒后再试','url'=>''])); 
        $sms_verify=session('sms_verify'); 
        
        $sudu_sms=config('sudu_sms'); 
        $get=[ 
            'username'=>'', 
            'orderId'=>'', 
            'consignee'=>'', 
            'msg'=>'' 
        ]; 
        $get= array_merge($get,input()); 
        $content= $this->getContent($sudu_sms['type'],$get['type'],$get); 
        $url='http:
        $Curl=new Curl(); 
        $return=$Curl->get($url, [], '', false, '', '5.5.5.5'); 
        if($return=100)exit (json_encode(['status'=>true,'msg'=>'发送成功','url'=>''])); 
        exit (json_encode(['status'=>false,'msg'=>'发送失败','url'=>''])); 
    } 
    public function getContent($config_type,$type,$get){ 
        $content=$config_type[$type]; 
        $code=rand(1000, 9999); 
        session('sms_code', $code); 
        session('sms_send_time', time()); 
        return str_replace(['{$code}','{$mobile}','{$username}','{$orderId}','{$date}','{$consignee}','{$msg}'], [ 
            $code,$get['mobile'],$get['username'],$get['orderId'], date('Y-m-d H:i:s'),$get['consignee'],$get['msg'] 
        ], $content); 
    } 
} 
