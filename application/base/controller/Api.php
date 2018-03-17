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

 * 时间: 2018-03-17 23:28:31
 */  
namespace app\base\controller; 
use think\Cache; 
 
class Api { 
    use \lib\base\Reflection; 
    
    public function index(){ 
        $start_time=microtime(true); 
        
        $api_request_restrict_time=config('app.api_request_restrict_time'); 
        $api_request_restrict_num=config('app.api_request_restrict_num'); 
        if($api_request_restrict_time&&$api_request_restrict_num){ 
            $ip=getip(); 
            Cache::inc('api_request_count'.$ip);
            $time=time(); 
            $start_time=cache('api_request_start_time'.$ip); 
            if($start_time==false)cache('api_request_start_time'.$ip, $time);
            
            if($start_time&&$start_time+$api_request_restrict_time*2< $time){ 
                cache('api_request_count'.$ip,0); 
                cache('api_request_start_time'.$ip, 0); 
                $start_time=0;
            } 
            if($start_time&&$start_time+$api_request_restrict_time< $time){ 
                
                if(cache('api_request_count'.$ip)>$api_request_restrict_num){ 
                    exit("超过接口请求限制,请过段时间再试!"); 
                }else{ 
                    cache('api_request_count'.$ip,0); 
                    cache('api_request_start_time'.$ip, 0); 
                } 
            } 
        } 
        $input= $this->getInput(); 
        $this->__Reflection($input['class'], $input['action']); 
        $data=$this->exec($this->getArg($input['input'])); 
        if(is_array($data)){ 
            $data= json_encode($data,JSON_UNESCAPED_UNICODE); 
        } 
        $url=''; 
        if(isset($_SERVER['SERVER_NAME']))$url.=$_SERVER['SERVER_NAME']; 
        if(isset($_SERVER["SERVER_PORT"]))$url.=':'.$_SERVER["SERVER_PORT"]; 
        if(isset($_SERVER["REQUEST_URI"]))$url.=$_SERVER["REQUEST_URI"]; 
        $runtime = number_format(microtime(true) - THINK_START_TIME, 10); 
        $reqs    = $runtime > 0 ? number_format(1 / $runtime, 2) : '∞'; 
        $mem     = number_format((memory_get_usage() - THINK_START_MEM) / 1024, 2); 
        $run_time=number_format($runtime, 6) . 's [ 吞吐率：' . $reqs . 'req/s ] 内存消耗：' . $mem . 'kb 文件加载：' . count(get_included_files()); 
        AppLog($url, requestData(), $data, 5, $_POST?'post':'get', $run_time); 
        echo $data; 
        die; 
    } 
     
    public function doc(){ 
        $input= $this->getInput(false); 
        $this->__Reflection($input['class'], $input['action']); 
        echo $this->getDoc($this->getArg($input['input'])); 
    } 
     
    protected function getInput($check=true){ 
        if($_SERVER['PATH_INFO']==false)exit(json_encode ([ 
            'code'=>'0', 
            'msg'=>'您的服务器环境不支持PATH_INFO' 
        ],JSON_UNESCAPED_UNICODE)); 
        $depr=config('pathinfo_depr'); 
        $info= array_values(array_filter(explode($depr, $_SERVER['PATH_INFO']))); 
        if($check){ 
            if($judge=$this->judge($info)){ 
                exit(json_encode ($judge,JSON_UNESCAPED_UNICODE)); 
            } 
        }         
        $action=$info[3]; 
        
        $class='\\app\\'. $info[1].'\\api\\'.$info[2]; 
        return [ 
            'class'=>$class, 
            'action'=>$action, 
            'input'=>$info, 
        ]; 
    } 
 
     
 
    
    protected function judge($info){ 
        if(count($info)<4){ 
            return [ 
                'code'=>'0', 
                'msg'=>'缺少访问方法' 
            ]; 
        } 
        $class=ucfirst($info[2]); 
        $apis=config('apis.'.$info[1].'_api_'.$class); 
        if($apis==false||isset($apis[$info[3]])==false)return [ 
                'code'=>'0', 
                'msg'=>'接口不存在' 
        ]; 
        switch ($apis[$info[3]]['call_type']) { 
           case 'post': 
                if(!request()->isPOST())return [ 
                    'code'=>'0', 
                    'msg'=>'请求类型错误' 
                ]; 
               break; 
           default: 
               break; 
        } 
        
        $path= shopXianEnv('app_path'). $info[1].'/api/'.$class.'.php'; 
        if(!file_exists($path))return [ 
            'code'=>'0', 
            'msg'=>'类文件不存在' 
        ]; 
        return false; 
    } 
    
    protected function getArg($info){ 
        $arg=[]; 
        for($i=4;$i<count($info);$i++){ 
            $arg[$info[$i]]= isset($info[$i+1])?$info[$i+1]:''; 
            $i+=1; 
        } 
        $arg= array_merge($arg, $_REQUEST); 
        return $arg; 
    }     
     
} 
