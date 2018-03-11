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

            * 时间: 2018-03-11 18:25:09
            */
         namespace lib\base;  use model\base\BaseAppConfig;    class AppConfig {            public static function set(string $name, string $app = '', string $value = ''){                 $appConfig= new BaseAppConfig();          $data=[              'code'=>$name,              'value'=>$value,              'app'=>$app          ];          $appConfig->isUpdate($appConfig->get($name))->save($data);          return $appConfig->code;      }            public static function get(string $name = '', string $app = ''){          $appConfig= new BaseAppConfig();          $where=[];          if($name)$where['code']=$name;          if($name)$where['app']=$app;          $config=$appConfig->where($where)->cache(10)->find();         $res='';          if(isset($config->value))$res=$config->value;          return $res;      }            public static function all(array $names = [], string $app = ''){          $appConfig= new BaseAppConfig();          $where=[];          if($names)$where[]=['code','in',$names];          if($names)$where[]=['app','=',$app];          $config=$appConfig->where($where)->cache(10)->column('value','code');         return $config;      }  }  