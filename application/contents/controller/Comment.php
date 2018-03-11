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

            * 时间: 2018-03-11 16:08:28
            */
       
namespace app\contents\controller;
use lib\images\Captcha as lib;

class Comment extends Base{
    public function index($id){
        $row=appModel('contents', 'Contents')->cache(3)->find($id);
        if($row==false||$row->getData('allowreply')!=1)return $this->_empty ();
        $where=['contents_id'=>$id];
        if(appConfig('cfg_contents_feedbackcheck')){
            $where['permission']='1';
        }
        $list=appModel('contents', 'ContentsComment')->where($where)->order('add_time desc')->cache(1)->paginate(5,false,['query'=>['id'=>$id]]);
        $list_data=$list->toArray();
        if($list_data['data']){
            foreach($list_data['data'] as $k=>$v){
                if($v['member_id']==false){
                    $list_data['data'][$k]['member_name']='匿名用户';
                    $list_data['data'][$k]['portrait']=request()->domain().'/static/images/a6.jpg';
                }else{
                    $list_data['data'][$k]['member_name']='待开发';
                    $list_data['data'][$k]['portrait']='匿名用户';
                }
            }
        }
        $tpl='comment';
        $this->assign('total', $list_data['total']);
        $this->assign('per_page', $list_data['per_page']);
        $this->assign('last_page', $list_data['last_page']);        
        $this->assign('id', $id);
        $this->assign('list', $list_data['data']);
        $page=$list->render();
        if($page==false){
            $page.="<ul class='page_msg'>暂无任何评论</ul>";
        }else{
            $page.="<ul class='page_msg'><li>共 {$list_data['last_page']}页{$list_data['total']}条</li></ul>";
        }        
        $this->assign('page', $page);
        exit($this->template('contents', $this->df_style, $tpl));
    }
    public function add($id,$body,$captcha){
        if(request()->isAjax()){
            $lib = new lib();
            if( !$lib->check($captcha,'contents'))
            {
                    return $this->error("验证码错误");
            }
            $obj=appModel('contents', 'ContentsComment');
            $feedback_time=30;
            if($cfg_contents_feedback_time=appConfig('cfg_contents_feedback_time'))$feedback_time=$cfg_contents_feedback_time;
            if($row=$obj->where(['comment_ip'=>getip(),'contents_id'=>$id])->field('add_time')->order('id desc')->cache(3)->find()){
                if($row->getData('add_time')+$feedback_time>= time()){
                    return $this->error("每个ip的间隔必须大于".$feedback_time.'秒');  
                }
            }
            if($obj->save([
                'contents_id'=>$id,
                'body'=>$body,
                'add_time'=> time(),
                'comment_ip'=> getip()
            ]))return $this->success("发表成功");
            
            return $this->error("发表失败"); 
        }
    }
    public function support($id){
        if(cookie('support_num'.$id)==1)return $this->error("已经操作过了");         
        if(appModel('contents', 'ContentsComment')->where(['id'=>$id])->setInc('support_num', 1)){
            cookie('support_num'.$id, 1);
            return $this->success("支持成功");
        }
        return $this->error("支持失败"); 
    }
    public function oppose($id){
        if(cookie('support_num'.$id)==1)return $this->error("已经操作过了");         
        if(appModel('contents', 'ContentsComment')->where(['id'=>$id])->setInc('oppose_num', 1)){
            cookie('support_num'.$id,1);
            return $this->success("反对成功");
        }
        return $this->error("反对失败"); 
    }
}
