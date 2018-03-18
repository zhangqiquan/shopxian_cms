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

 * 时间: 2018-03-18 16:56:40
 */  
namespace app\desktop\controller; 
use lib\base\SiteController; 
use lib\desktop\User; 
use model\shops\Shop; 
use model\index\Members; 
use think\Session; 
use lib\desktop\Menu; 
use think\Debug; 
use think\Log; 
 
class AdminPassport extends SiteController{ 
    use \lib\base\Finder; 
    public function login(){ 
        return $this->showTpl(''); 
    } 
    public function tologin(){ 
            $post= input(); 
            unset($post['code'],$post['url']); 
            $admin=User::verify_pwd($post); 
            if($admin==false)return $this->error('账号或密码错误'); 
            if($admin['enabled']=='false')return $this->error('账号已禁用不能登陆'); 
            session('user_id',$admin['user_id']); 
            session('uname',$admin['uname']); 
            session('role_id',$admin['role_id']); 
            session("safety",sha1($_SERVER['HTTP_USER_AGENT']. getip())); 
            cookie('avatar', $admin['avatar']); 
            cookie('login_count', $admin['login_count']); 
            cookie('last_login_time', $admin['last_login_time']); 
            cookie('last_login_ip', $admin['last_login_ip']); 
            $url=input('url', ''); 
            
            cache("new_menus".$admin['user_id'],null); 
            Menu::getAdminMenu($admin['user_id'],true); 
            appModel('desktop', 'DesktopUser')->where(['user_id'=>$admin['user_id']])->update(['last_login_time'=> time(),'last_login_ip'=>getip(),'login_count'=>$admin['login_count']+1]); 
            if($url!='')return $this->redirect ($url); 
            return $this->redirect (url('desktop/Admin/index', '', true, true)); 
    } 
    public function register(){ 
        return $this->formBuilder('desktop', 'desktop_user',[], url('register_toadd','',true,true)); 
    } 
    public function register_toadd($uname,$pwd){ 
        $pwd= password_encode(http_build_query(['uname'=>$uname,'pwd'=>$pwd])); 
        echo appModel('desktop', 'DesktopUser')->save([ 
            'uname'=>$uname, 
            'pwd'=>$pwd, 
        ]); 
    } 
    public function exitLogin(){ 
        session(null); 
        $this->redirect('AdminPassport/login'); 
    } 
} 
