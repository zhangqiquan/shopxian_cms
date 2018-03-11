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
         namespace common\taglib;  use think\template\TagLib;    class Model extends TagLib{            protected $tags   =  [                   'column'=>['where','app','model','rank','filed','assign','close'=>0],          'find'=>['where','app','model','rank','filed','assign','close'=>0],      ];      public function tagColumn($tag, $content){          if(!isset($tag['field']))$tag['field']='*';          if(!isset($tag['where']))$tag['where']='1';          return           "<?php 

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
        ".              "if(\$cache=cache('". md5(json_encode($tag).'column')."')){".                      "\$".$tag['assign']."=\$cache;"              ."}else{"                      . "\$".$tag['assign'].'=appModel("'.$tag['app'].'","'.$tag['model'].'")'."->where(\"".$tag['where']."\")->limit(".$tag['limit'].")->order(\"".$tag['rank']."\")->column(\"".$tag['field']."\"); "              ."cache('".md5(json_encode($tag).'column')."',\$".$tag['assign'].",10);"                    ."}"                . "?>";      }      public function tagFind($tag, $content){          if(!isset($tag['field']))$tag['field']='*';          if(!isset($tag['where']))$tag['where']='1';          return           "<?php 

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
        ".              "if(\$cache=cache('". md5(json_encode($tag).'find')."')){".                      "\$".$tag['assign']."=\$cache;"              ."}else{"                      . "\$".$tag['assign'].'=appModel("'.$tag['app'].'","'.$tag['model'].'")'."->where(\"".$tag['where']."\")->limit(".$tag['limit'].")->order(\"".$tag['rank']."\")->find(); "              ."cache('".md5(json_encode($tag).'find')."',\$".$tag['assign'].",10);"                    ."}"                . "?>";      }  }  