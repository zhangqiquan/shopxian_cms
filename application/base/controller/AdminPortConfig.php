<?php 
 
namespace app\base\controller; 
use lib\base\BaseController; 
 
class AdminPortConfig extends BaseController{ 
    use \lib\base\Finder;  
     
    public function suduSms(){ 
        $data=config('sudu_sms'); 
        $lang=lang('config_lang')['sudu_sms']; 
        return $this->showTpl('config',['title'=>'速度网短信接口设置','data'=>$data,'lang'=>$lang,'action'=> url('suduSmsToAdd', '', true, true)]); 
    } 
     
    public function suduSmsToAdd(){ 
        $post= input(); 
        if($this->commonTo($post, 'sudu_sms'))return $this->success ("操作成功"); 
        return $this->error("操作失败"); 
    } 
 
     
    public function emailSms(){ 
        $data=config('email_sms'); 
        $lang=lang('config_lang')['email_sms']; 
        return $this->showTpl('config',['title'=>'邮件发送接口设置','data'=>$data,'lang'=>$lang,'action'=> url('emailSmsToAdd', '', true, true)]); 
    } 
     
    public function emailSmsToAdd(){ 
        $post= input(); 
        if($this->commonTo($post, 'email_sms'))return $this->success ("操作成功"); 
        return $this->error("操作失败"); 
    } 
    protected function commonTo($post,$key_name){ 
        $post= input(); 
        $data=config($key_name); 
        $data= array_merge($data, $post); 
        $save_path=shopXianEnv('app_path').request()->module().DIRECTORY_SEPARATOR.'extra'.DIRECTORY_SEPARATOR.$key_name.'.php'; 
        $save_data='<?php'."\n".'return ['."\n"; 
        $lang=lang('config_lang')[$key_name]; 
        foreach($data as $k=>$v){ 
            if(is_array($v)){ 
                if(isset($lang[$k])){ 
                    $save_data.='
                } 
                $save_data.="    '{$k}'=>["; 
                foreach ($v as $key => $value) { 
                    $save_data.="\n        '{$key}'=>'".$value."',"; 
                } 
                $save_data.="\n    ],\n"; 
            }else if(is_array($arr=json_decode($v, true))){ 
                if(isset($lang[$k])){ 
                    $save_data.='
                } 
                $save_data.="    '{$k}'=>["; 
                foreach ($arr as $key => $value) { 
                    $save_data.="'{$key}'=>'".$value."',"; 
                } 
                $save_data.="],\n"; 
            }else{ 
                $save_data.="    '{$k}'=>'".$v."',
                if(isset($lang[$k])){ 
                    $save_data.=$lang[$k]; 
                } 
                $save_data.="\n"; 
            } 
        } 
        $save_data.="];"; 
        return file_put_contents($save_path, $save_data); 
    } 
} 
