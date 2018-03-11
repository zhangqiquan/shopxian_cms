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

            * 时间: 2018-03-11 18:25:12
            */
         namespace lib\base;    class validation {            public static function isPhoneNum($num){          if(!preg_match("/^13[0-9]{1}[0-9]{8}$|15[0189]{1}[0-9]{8}$|17[0189]{1}[0-9]{8}$|189[0-9]{8}$/",$num)){              return false;          }else{              return true;          }      }            public static function isMail($num){          $pattern = "/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i";          if ( preg_match( $pattern, $num ) )          {              return true;          }  else {              return false;          }      }            public static function numLong($num,$len){          if(is_numeric($num)&&strlen($num)>$len ){              return true;          }else{              return false;          }      }            public function numlength($num,$len){          if(is_numeric($num)&&strlen($num)<$len ){              return true;          }else{              return false;          }      }            public static function isTel($num){          $zz='/^(\([0-9]{3,4}\)|[0-9]{3,4}-)?[0-9]{7,8}$/is';          preg_match($zz, $num, $matches);          if($matches==false){              return false;          }else{              return true;          }      }  }       