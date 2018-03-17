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
 */     PHPExcel_Autoloader::register();      if (ini_get('mbstring.func_overload') & 2) {      throw new PHPExcel_Exception('Multibyte function overloading in PHP must be disabled for string functions (2).');  }  PHPExcel_Shared_String::buildCharacterSets();      class PHPExcel_Autoloader  {            public static function register()      {          if (function_exists('__autoload')) {                           spl_autoload_register('__autoload');          }                   if (version_compare(PHP_VERSION, '5.3.0') >= 0) {              return spl_autoload_register(array('PHPExcel_Autoloader', 'load'), true, true);          } else {              return spl_autoload_register(array('PHPExcel_Autoloader', 'load'));          }      }              public static function load($pClassName)      {          if ((class_exists($pClassName, false)) || (strpos($pClassName, 'PHPExcel') !== 0)) {                           return false;          }            $pClassFilePath = PHPEXCEL_ROOT .              str_replace('_', DIRECTORY_SEPARATOR, $pClassName) .              '.php';            if ((file_exists($pClassFilePath) === false) || (is_readable($pClassFilePath) === false)) {                           return false;          }            require($pClassFilePath);      }  }  