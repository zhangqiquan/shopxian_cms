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

            * 时间: 2018-03-11 18:24:39
            */
        
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
