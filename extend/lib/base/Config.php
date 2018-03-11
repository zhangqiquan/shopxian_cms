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

            * 时间: 2018-03-11 16:08:51
            */
         namespace lib\base;      class Config {      public function write($save_path,$data,$annotation=[]){          $save_data='<?php 

           /**
            * 秀仙系统 shopxian_release/3.0.0
            * ============================================================================
            * * 版权所有 2017-2018 上海秀仙网络科技有限公司，并保留所有权利。
            * 网站地址: http://www.shopxian.com；
            * ----------------------------------------------------------------------------
            * 本软件只能免费使用  不允许对程序代码以任何形式任何目的再发布或者出售。
            * ============================================================================
            * 作者: 张启全 

            * 时间: 2018-03-11 16:08:51
            */
       '."\n".'return ['."\n";          $lang=$annotation;          foreach($data as $k=>$v){              if(is_array($v)){                  if(isset($lang[$k])){                      $save_data.='                 }                  $save_data.="    '{$k}'=>[";                  foreach ($v as $key => $value) {                      $value= str_replace("'", "\'", $value);                      $save_data.="\n        '{$key}'=>'".$value."',";                  }                  $save_data.="\n    ],\n";              }else if(is_array($arr=json_decode($v, true))){                  if(isset($lang[$k])){                      $save_data.='                 }                  $save_data.="    '{$k}'=>[";                  foreach ($arr as $key => $value) {                      $value= str_replace("'", "\'", $value);                      $save_data.="'{$key}'=>'".$value."',";                  }                  $save_data.="],\n";              }else{                  $v=str_replace("'", "\'", $v);                  $save_data.="    '{$k}'=>'".$v."',                 if(isset($lang[$k])){                      $save_data.= isset($lang[$k])?$lang[$k]:'';                  }                  $save_data.="\n";              }          }          $save_data.="];";          return file_put_contents($save_path, $save_data);      }  }  