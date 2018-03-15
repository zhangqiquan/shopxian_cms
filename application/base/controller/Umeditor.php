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
namespace app\base\controller; 
use lib\base\SiteController; 
 
error_reporting(0); 
class Umeditor extends SiteController{ 
    public function index(){ 
            if($this->user_id==false&&$this->member_id==false)exit ("没有权限"); 
            
            $config = array( 
                "savePath" => "uploads/" ,             
                "maxSize" => 2048 ,                   
                "allowFiles" => array( ".gif" , ".png" , ".jpg" , ".jpeg" , ".bmp" )  
            ); 
            
            $Path = "uploads/".'member'.session('member_id').'/'; 
            
            $config[ "savePath" ] = $Path; 
            $up = new Uploader( "upfile" , $config ); 
            $type = $_REQUEST['type']; 
            $callback=$_GET['callback']; 
 
            $info = $up->getFileInfo(); 
             
            if($callback) { 
                echo '<script>'.$callback.'('.json_encode($info).')</script>'; 
            } else { 
                echo json_encode($info); 
            }die; 
    } 
} 
 
class Uploader 
{ 
    private $fileField;            
    private $file;                 
    private $config;               
    private $oriName;              
    private $fileName;             
    private $fullName;             
    private $fileSize;             
    private $fileType;             
    private $stateInfo;            
    private $stateMap = array(    
        "SUCCESS" ,                
        "文件大小超出 upload_max_filesize 限制" , 
        "文件大小超出 MAX_FILE_SIZE 限制" , 
        "文件未被完整上传" , 
        "没有文件被上传" , 
        "上传文件为空" , 
        "POST" => "文件大小超出 post_max_size 限制" , 
        "SIZE" => "文件大小超出网站限制" , 
        "TYPE" => "不允许的文件类型" , 
        "DIR" => "目录创建失败" , 
        "IO" => "输入输出错误" , 
        "UNKNOWN" => "未知错误" , 
        "MOVE" => "文件保存时出错", 
        "DIR_ERROR" => "创建目录失败" 
    ); 
 
     
    public function __construct( $fileField , $config , $base64 = false ) 
    { 
        $this->fileField = $fileField; 
        $this->config = $config; 
        $this->stateInfo = $this->stateMap[ 0 ]; 
        $this->upFile( $base64 ); 
    } 
 
     
    private function upFile( $base64 ) 
    { 
        
        if ( "base64" == $base64 ) { 
            $content = $_POST[ $this->fileField ]; 
            $this->base64ToImage( $content ); 
            return; 
        } 
 
        
        $file = $this->file = $_FILES[ $this->fileField ]; 
        if ( !$file ) { 
            $this->stateInfo = $this->getStateInfo( 'POST' ); 
            return; 
        } 
        if ( $this->file[ 'error' ] ) { 
            $this->stateInfo = $this->getStateInfo( $file[ 'error' ] ); 
            return; 
        } 
        if ( !is_uploaded_file( $file[ 'tmp_name' ] ) ) { 
            $this->stateInfo = $this->getStateInfo( "UNKNOWN" ); 
            return; 
        } 
 
        $this->oriName = $file[ 'name' ]; 
        $this->fileSize = $file[ 'size' ]; 
        $this->fileType = $this->getFileExt(); 
 
        if ( !$this->checkSize() ) { 
            $this->stateInfo = $this->getStateInfo( "SIZE" ); 
            return; 
        } 
        if ( !$this->checkType() ) { 
            $this->stateInfo = $this->getStateInfo( "TYPE" ); 
            return; 
        } 
 
        $folder = $this->getFolder(); 
 
        if ( $folder === false ) { 
            $this->stateInfo = $this->getStateInfo( "DIR_ERROR" ); 
            return; 
        } 
 
        $this->fullName = $folder . '/' . $this->getName(); 
 
        if ( $this->stateInfo == $this->stateMap[ 0 ] ) { 
            if ( !move_uploaded_file( $file[ "tmp_name" ] , $this->fullName ) ) { 
                $this->stateInfo = $this->getStateInfo( "MOVE" ); 
            } 
        } 
    } 
 
     
     
    private function base64ToImage( $base64Data ) 
    { 
        $img = base64_decode( $base64Data ); 
        $this->fileName = time() . rand( 1 , 10000 ) . ".png"; 
        $this->fullName = $this->getFolder() . '/' . $this->fileName; 
        if ( !file_put_contents( $this->fullName , $img ) ) { 
            $this->stateInfo = $this->getStateInfo( "IO" ); 
            return; 
        } 
        $this->oriName = ""; 
        $this->fileSize = strlen( $img ); 
        $this->fileType = ".png"; 
    } 
 
     
    public function getFileInfo() 
    { 
        return array( 
            "originalName" => $this->oriName , 
            "name" => $this->fileName , 
            "url" => $this->fullName , 
            "size" => $this->fileSize , 
            "type" => $this->fileType , 
            "state" => $this->stateInfo 
        ); 
    } 
 
     
    private function getStateInfo( $errCode ) 
    { 
        return !$this->stateMap[ $errCode ] ? $this->stateMap[ "UNKNOWN" ] : $this->stateMap[ $errCode ]; 
    } 
 
     
    private function getName() 
    { 
        return $this->fileName = time() . rand( 1 , 10000 ) . $this->getFileExt(); 
    } 
 
     
    private function checkType() 
    { 
        return in_array( $this->getFileExt() , $this->config[ "allowFiles" ] ); 
    } 
 
     
    private function  checkSize() 
    { 
        return $this->fileSize <= ( $this->config[ "maxSize" ] * 1024 ); 
    } 
 
     
    private function getFileExt() 
    { 
        return strtolower( strrchr( $this->file[ "name" ] , '.' ) ); 
    } 
 
     
    private function getFolder() 
    { 
        $pathStr = $this->config[ "savePath" ]; 
        if ( strrchr( $pathStr , "/" ) != "/" ) { 
            $pathStr .= "/"; 
        } 
        $pathStr .= date( "Ymd" ); 
        if ( !file_exists( $pathStr ) ) { 
            if ( !mkdir( $pathStr , 0777 , true ) ) { 
                return false; 
            } 
        } 
        return $pathStr; 
    } 
} 
