<?php 
 
namespace app\desktop\controller; 
use lib\base\BaseController; 
use lib\admin\User as Userlib; 
use lib\desktop\Menu; 
 
class AdminUser extends BaseController{ 
    use \lib\base\Finder; 
    public function column(){ 
        return $this->finder( 
                'desktop', 
                'desktop_user', 
                [],
                [ 
                    'title'=>'用户列表', 
                    'is_detail'=>false,
                    'detail_url'=> '', 
                    'finder_path'=> '', 
                    'actions'=>[
                        ['type'=>'href','url'=>url('add','',true,true),'val'=>'添加','iclass'=>'alert_iframe','width'=>'100%','height'=>'100%'], 
                    ]     
            ] ,'user_id',[],'user_id desc' 
        ); 
    } 
    public function add($id=''){ 
        $outfield=['deposit','shop_id','alipay_account','weibo_account','weixin_account','qq_account']; 
        $getfield= self::getDbstructField('desktop', 'desktop_user', $outfield);         
        $Role=appModel('desktop', 'DesktopRole'); 
        $Role_data=$Role->cache(2)->column('role_name','role_id'); 
        $Role_data['0']='超级管理员'; 
        $getfield['role_id']['value']=$Role_data; 
        
        if($id){ 
            $obj=appModel('desktop', 'DesktopUser'); 
            $data=$obj->get($id); 
            if($data){ 
                $data=$data->toArray (); 
            } 
            foreach($data as $k=>$v){ 
                if(isset($getfield[$k]))$getfield[$k]['default']=$v; 
            } 
        } 
        $getfield['pwd']['default']=''; 
        return $this->formBuilder('desktop', 'desktop_user',$outfield, url('toAdd','',true,true),$getfield); 
    } 
    public function toAdd($model = '', $data = '', $element_id = '', $url = ''){ 
        $post= input(); 
        $post['pwd']= password_encode(http_build_query(['uname'=>$post['uname'],'pwd'=>$post['pwd']])); 
        $obj=appModel('desktop', 'DesktopUser'); 
        $update=(isset($post['user_id'])&&$post['user_id']); 
        if($update==false&& appModel('desktop', 'DesktopUser')->where(['uname'=>$post['uname']])->count())exit ($post['uname'].'已经存在,请换一个'); 
        $ok=$obj->isUpdate($update)->save($post); 
        if($ok)return $this->statusMsg('true', "操作成功", url('column','',true,true)); 
        return $this->statusMsg(false, "操作失败", ''); 
    } 
     
    public function editMy($id=''){ 
        $obj=appModel('desktop', 'DesktopUser'); 
        $data=$obj->where([ 
            'user_id'=> session('user_id') 
        ])->find(); 
        if($data)$data=$data->toArray(); 
        $out=['deposit','shop_id','alipay_account','weibo_account','weixin_account','qq_account','user_type','role_id']; 
        $getfield=self::getDbstructField('desktop', 'desktop_user', $out); 
        if($data){ 
            foreach($data as $k=>$v){ 
                if(isset($getfield[$k]))$getfield[$k]['default']=$v; 
            } 
        } 
        $getfield['pwd']['default']=''; 
        return $this->formBuilder('desktop', 'desktop_user',$out, url('toEditMy','',true,true),$getfield); 
    } 
     
    public function toEditMy(){ 
        $obj=appModel('desktop', 'DesktopUser'); 
        $post= input(); 
        $post['pwd']= Userlib::signature([$post['uname'],$post['pwd']]); 
        $postp['user_id']= session('user_id'); 
        $ok=$obj->isUpdate(true)->save($post); 
        cookie('avatar', $post['avatar']); 
        if($ok==false)return $this->error ("操作失败"); 
        echo "<script>parent.layer.closeAll();parent.window.location.reload();</script>"; 
    } 
} 
