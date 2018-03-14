<?php 
 
namespace app\base\controller; 
 
class Error 
{ 
    public function _empty($name) 
    {         
        $site_type='site'; 
        $controller=request()->controller(); 
        $info='方法不存在:'.request()->module().'\\'.$controller.'\\'.$name.'()'; 
        if(isset($_SERVER['REQUEST_URI'])){ 
            $request= substr($_SERVER['REQUEST_URI'], 1, strlen($_SERVER['REQUEST_URI'])); 
            $request=explode(config('pathinfo_depr'), $request); 
            $info=$request[0].'模块不存在  '; 
            $info.=$request[0]; 
            $info.='\\'.$controller; 
            $info.='\\'.$name.'()'; 
        } 
        return view(shopXianEnv('extend_path').'view/base/'.$site_type.'/_empty.html',['icon'=>'&#xe61c;','title'=>'404 Not Found 页面不存在Error','info'=>$info],404); 
    } 
} 
