<?php 
 
namespace app\api\controller; 
 
 
date_default_timezone_set("Asia/chongqing"); 

header("Content-Type: text/html; charset=utf-8"); 
class Upload { 
    public function index(){ 
        $CONFIG = json_decode(preg_replace("/\/\*[\s\S]+?\*\
        $action = input('action'); 
 
        switch ($action) { 
            case 'config': 
                $result =  json_encode($CONFIG); 
                break; 
 
             
            case 'uploadimage': 
             
            case 'uploadscrawl': 
             
            case 'uploadvideo': 
             
            case 'uploadfile': 
                vendor("baiduEditor.action_upload"); 
                $obj=new \action_upload(); 
                $result=$obj->index(); 
                break; 
 
             
            case 'listimage': 
                vendor("baiduEditor.action_list"); 
                $obj=new \action_list(); 
                $result=$obj->index(); 
                break; 
             
            case 'listfile': 
                vendor("baiduEditor.action_list"); 
                $obj=new \action_list(); 
                $result=$obj->index(); 
                break; 
 
             
            case 'catchimage': 
                $result = vendor("baiduEditor.action_crawler"); 
                $obj=new \action_crawler(); 
                $result=$obj->index(); 
                break; 
 
            default: 
                $result = json_encode(array( 
                    'state'=> '请求地址出错' 
                )); 
                break; 
        } 
 
         
        if (isset($_GET["callback"])) { 
            if (preg_match("/^[\w_]+$/", input("callback"))) { 
                echo htmlspecialchars(input("callback")) . '(' . $result . ')'; 
            } else { 
                echo json_encode(array( 
                    'state'=> 'callback参数不合法' 
                )); 
            } 
        } else { 
            echo $result; 
        } 
        die; 
    } 
} 
