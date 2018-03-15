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

 * 时间: 2018-03-15 19:07:22
 */   namespace lib\base;    class sql_expand  extends \think\controller{      public function __construct($config = array()) {          parent::__construct($config);      }            public function table_sql($table_name){          $table_name=C('prefix').$table_name;          $sql="SHOW CREATE TABLE  $table_name";          $return=M($table_name)->query($sql);          return $return;               }            public function table_Stru($table_name){          $table_name=C('prefix').$table_name;          $sql="SHOW FULL FIELDS FROM  $table_name";          $return=M($table_name)->query($sql);          return $return;      }  }  