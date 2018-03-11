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
        
namespace app\contents\command; 
use think\console\Command; 
use think\console\Input; 
use think\console\input\Option; 
use think\console\Output; 
use lib\base\Curl; 
 
class CmsCollect extends Command{ 
    protected function configure() 
    { 
        
        $this 
            ->setName('cms_collect') 
            ->addOption('cid', 'd', Option::VALUE_OPTIONAL, 'path to clear', null) 
                ->addOption('cat_id', '', Option::VALUE_OPTIONAL, 'path to clear', null) 
           
            ->setDescription('采集任务'); 
    } 
    protected function execute(Input $input, Output $output) 
    { 
        for($i=1;$i<=4;$i++){ 
            $url='http:
            $curl=new Curl(); 
            $this->curl=$curl; 
            $data=$curl->get($url); 
            $zhengze='/"listw">(.*?)<\/div>/is'; 
            preg_match($zhengze,  $data,$res); 
            $zhengze='/href="(.*?)"/is'; 
            preg_match_all($zhengze,  $res[1],$res); 
            foreach ($res[1] as $key => $value) { 
                $this->wenzhang('http:
                echo rand(0,9)."1\n"; 
            } 
        } 
    } 
    public function wenzhang($url){ 
        $data=$this->curl->get($url); 
        
        $zhengze='/<h2>(.*?)<\/h2>/is'; 
        preg_match($zhengze,  $data,$res); 
        $title=iconv('GB2312', 'UTF-8',$res[1]); 
        $zhengze='/<div class="arnr">(.*?)<div class="arfy">/is'; 
        preg_match($zhengze,  $data,$res); 
        $body=strip_tags($res[1],'<img>'); 
        $body=iconv('GB2312', 'UTF-8', $body); 
        $body=str_replace('本文地址:'.$url, '', $body); 
        
        $zhengze='/src="(.*?)"/is'; 
        preg_match_all($zhengze,  $body,$res); 
        $img=''; 
        if(isset($res[1])){ 
            foreach ($res[1] as $key => $value) { 
                $arr=explode('.', $value); 
                $hz=$arr[count($arr)-1]; 
                $file_name='D:\Users\wwwroot\cms.shopxian.cn6666\public\uploads\cmscollect\20180302\\'.time().$key.'.'.$hz; 
                file_put_contents($file_name, @file_get_contents('http:
                $file_name= str_replace('D:\Users\wwwroot\cms.shopxian.cn6666\public', '', $file_name); 
                $file_name= str_replace('\\', '/', $file_name); 
                $body= str_replace($value, $file_name, $body); 
                $img=$file_name; 
            } 
        } 
        $keywords=$title; 
        $description= strip_tags($body); 
        $obj=appModel('contents', 'Contents'); 
        $sdata=[ 
            'id'=>null, 
            'title'=>$title, 
            'images'=>$img, 
            'channeltype_id'=>1, 
            'templet'=>'article_article', 
            'author'=>'shopxian', 
            'source'=>'shopxian cms', 
            'cat_id'=>7, 
            'keywords'=>$title, 
            'description'=>$description, 
            'rank'=>50, 
            'add_time'=> time()- rand(1000, 9999), 
            'user_id'=>1, 
        ]; 
        $obj->isUpdate(false)->save($sdata); 
        $id= $obj->id; 
        appModel('contents', 'ContentsPutongwenzhang')->isUpdate(false)->save([ 
            'id'=>$id, 
            'body'=>$body, 
        ]); 
        appModel('contents', 'ContentsCount')->isUpdate(false)->save([ 
            'id'=>$id, 
            'cat_id'=>7, 
        ]); 
    } 
} 
