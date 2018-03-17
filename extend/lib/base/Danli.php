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

 * 时间: 2018-03-17 23:28:43
 */     namespace lib\base;  class Danli {      private static $_instace=NULL;      private function __construct() {          ;      }            public static function instace(){          if(is_null(self::$_instace)){              self::$_instace=new self;         }          return self::$_instace;      }      public function __clone() {          trigger_error('不允许克隆', E_USER_ERROR);      }        public function ceshi(){          echo "测试";      }  }  