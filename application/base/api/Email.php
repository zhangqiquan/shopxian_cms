<?php 
 
namespace app\base\api; 
use lib\base\mail; 
error_reporting(0); 
 
class Email { 
     
    public function send($params=[]){ 
        if(is_numeric(session('sms_send_time'))&&(session('sms_send_time')+120> time()))exit (json_encode(['status'=>false,'msg'=>'请在120秒后再试','url'=>''])); 
        $sms_verify=session('sms_verify'); 
        $conf_sms=config('email_sms'); 
        $get=[ 
            'from'=>'', 
            'to'=>'', 
            'cc'=>'', 
            'bcc'=>'' 
        ]; 
        $get= array_merge($get,input()); 
        $mail = new mail(); 
        $mail->setServer($conf_sms['server'], $conf_sms['username'], $conf_sms['password'],$conf_sms['port']); 
        $mail->setFrom($conf_sms['from']); 
        $to_from=explode(',', $get['to']); 
        foreach($to_from as $v){ 
            $mail->setReceiver($v); 
        } 
         
        $cc_from=explode(',', $get['cc']); 
        foreach($cc_from as $v){ 
            $mail->setCc($v); 
        } 
         
        $bcc_from=explode(',', $get['bcc']); 
        foreach($bcc_from as $v){ 
            $mail->setBcc($v); 
        } 
        if(isset($get['type'])&&$get['type']=='code'){ 
            $code=rand(1000, 9999); 
            session('sms_code', $code); 
            $get['body']=str_repeat ('{$code}', $code,$get['body']); 
        } 
        $mail->setMailInfo($get['title'], $get['body']); 
        session('sms_send_time', time()); 
        echo $mail->sendMail(); 
    } 
} 
