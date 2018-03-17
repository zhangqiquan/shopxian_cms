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
namespace app\contents\controller; 
use lib\base\BaseController; 
 
class AdminSetting extends BaseController{ 
    use \lib\base\Finder;  
    public function site(){ 
        $in_field=['cfg_contents_logo'=>'cms站点logo','cfg_contents_basehost'=>'cms站点根网址','cfg_contents_indexname'=>'cms主页链接名','cfg_contents_webname'=>'cms网站名称','cfg_contents_df_style'=>'cms模板风格','cfg_contents_powerby'=>'cms网站版权信息','cfg_contents_keywords'=>'cms站点默认关键字','cfg_contents_description'=>'cms站点描述','cfg_contents_beian'=>'cms网站备案号']; 
        if(request()->isPost()){ 
            $post= input('post.'); 
            unset($post[0]);             
            $codes=appModel('base', 'BaseAppConfig')->where('code','in', array_keys($in_field))->column('value','code'); 
            foreach ($post as $key => $value) { 
                if(isset($in_field[$key])){ 
                    $data=[ 
                        'code'=>$key, 
                        'title'=>$in_field[$key], 
                        'value'=>$value, 
                    ]; 
                    appModel('base', 'BaseAppConfig')->isUpdate(isset($codes[$key]))->save($data); 
                } 
            } 
            return $this->statusMsg(true, 100); 
        } 
        $list=[]; 
        $codes=appModel('base', 'BaseAppConfig')->where('code','in', array_keys($in_field))->column('value','code'); 
        $list['cfg_contents_logo']=[ 
            'type'=>'varchar', 
            'length'=>'100', 
            'label'=>'站点logo', 
            'not_null'=>'true',        
            'default'=>isset($codes['cfg_contents_logo'])?$codes['cfg_contents_logo']:'', 
            'input_type'=>'image', 
        ]; 
        $list['cfg_contents_indexname']=[ 
            'type'=>'varchar', 
            'length'=>'100', 
            'label'=>'主页链接名', 
            'not_null'=>'true',             
            'default'=> isset($codes['cfg_contents_indexname'])?$codes['cfg_contents_indexname']:'', 
            'input_type'=>'text', 
        ]; 
        $list['cfg_contents_webname']=[ 
            'type'=>'varchar', 
            'length'=>'100', 
            'label'=>'网站名称', 
            'not_null'=>'true',             
            'default'=> isset($codes['cfg_contents_webname'])?$codes['cfg_contents_webname']:'我的网站-shopxian', 
            'input_type'=>'text', 
        ]; 
        $list['cfg_contents_df_style']=[ 
            'type'=>'varchar', 
            'length'=>'100', 
            'label'=>'模板风格', 
            'not_null'=>'true',             
            'default'=> isset($codes['cfg_contents_df_style'])?$codes['cfg_contents_df_style']:'default', 
            'input_type'=>'text', 
        ]; 
        $list['cfg_contents_keywords']=[ 
            'type'=>'varchar', 
            'length'=>'5000', 
            'label'=>'站点默认关键字', 
            'not_null'=>'true', 
            'default'=> isset($codes['cfg_contents_keywords'])?$codes['cfg_contents_keywords']:'', 
            'input_type'=>'textarea', 
        ]; 
        $list['cfg_contents_description']=[ 
            'type'=>'varchar', 
            'length'=>'255', 
            'label'=>'站点描述', 
            'not_null'=>'true', 
            'default'=> isset($codes['cfg_contents_description'])?$codes['cfg_contents_description']:'', 
            'input_type'=>'textarea', 
        ]; 
        $list['cfg_contents_powerby']=[ 
            'type'=>'varchar', 
            'length'=>'255', 
            'label'=>'网站版权信息', 
            'not_null'=>'true',             
            'default'=> isset($codes['cfg_contents_powerby'])?$codes['cfg_contents_powerby']:'', 
            'input_type'=>'text', 
        ]; 
        $list['cfg_contents_beian']=[ 
            'type'=>'varchar', 
            'length'=>'255', 
            'label'=>'网站备案号', 
            'not_null'=>'true', 
            'default'=> isset($codes['cfg_contents_beian'])?$codes['cfg_contents_beian']:'', 
            'input_type'=>'text', 
        ]; 
        $submit_url= url(''); 
        $tpl='form_builder'; 
        $this->assign('list', $list); 
        $this->assign('submit_url', $submit_url); 
        $this->assign('body', ''); 
        return $this->fetch(shopXianEnv('extend_path').'view/base/'.$this->site_type.'/'.$tpl.'.html'); 
    } 
    public function interactive(){ 
        $in_field=['cfg_contents_feedbackcheck'=>'评论及留言(是/否)需审核','cfg_contents_feedback_time'=>'两次评论至少间隔时间(秒钟)','cfg_contents_feedback_authcode'=>'评论加验证码','cfg_contents_feedback_guest'=>'是否允许匿名评论']; 
        $list=[]; 
        $codes=appModel('base', 'BaseAppConfig')->where('code','in', array_keys($in_field))->column('value','code'); 
        if(request()->isPost()){ 
            $post= input('post.'); 
            unset($post[0]);             
            $codes=appModel('base', 'BaseAppConfig')->where('code','in', array_keys($in_field))->column('value','code'); 
            foreach ($post as $key => $value) { 
                if(isset($in_field[$key])){ 
                    $data=[ 
                        'code'=>$key, 
                        'title'=>$in_field[$key], 
                        'value'=>$value, 
                    ]; 
                    appModel('base', 'BaseAppConfig')->isUpdate(isset($codes[$key]))->save($data); 
                } 
            } 
            return $this->statusMsg(true, 100); 
        } 
        $list['cfg_contents_feedbackcheck']=[ 
            'type'=>'varchar', 
            'length'=>'100', 
            'label'=>'评论及留言(是/否)需审核', 
            'value'=>array( 
                '0'=>'否', 
                '1'=>'是', 
            ), 
            'not_null'=>'true',             
            'default'=> isset($codes['cfg_contents_feedbackcheck'])?$codes['cfg_contents_feedbackcheck']:'0', 
            'input_type'=>'radio', 
        ]; 
        $list['cfg_contents_feedback_time']=[ 
            'type'=>'int', 
            'length'=>'100', 
            'label'=>'两次评论至少间隔时间(秒钟)', 
            'not_null'=>'true',             
            'default'=> isset($codes['cfg_contents_feedback_time'])?$codes['cfg_contents_feedback_time']:'30', 
            'input_type'=>'number', 
        ]; 
        $list['cfg_contents_feedback_authcode']=[ 
            'type'=>'varchar', 
            'length'=>'100', 
            'label'=>'评论加验证码', 
            'value'=>array( 
                '0'=>'否', 
                '1'=>'是', 
            ), 
            'not_null'=>'true',             
            'default'=> isset($codes['cfg_contents_feedback_authcode'])?$codes['cfg_contents_feedback_authcode']:'1', 
            'input_type'=>'radio', 
        ]; 
        $list['cfg_contents_feedback_guest']=[ 
            'type'=>'varchar', 
            'length'=>'100', 
            'label'=>'是否允许匿名评论', 
            'not_null'=>'true',             
            'value'=>array( 
                '0'=>'否', 
                '1'=>'是', 
            ), 
            'default'=> isset($codes['cfg_contents_feedback_guest'])?$codes['cfg_contents_feedback_guest']:'1', 
            'input_type'=>'radio', 
        ]; 
        $submit_url= url(''); 
        $tpl='form_builder'; 
        $this->assign('list', $list); 
        $this->assign('submit_url', $submit_url); 
        $this->assign('body', ''); 
        return $this->fetch(shopXianEnv('extend_path').'view/base/'.$this->site_type.'/'.$tpl.'.html'); 
    } 
} 
