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
 */       class PHPExcel_Cell_DataType  {            const TYPE_STRING2  = 'str';      const TYPE_STRING   = 's';      const TYPE_FORMULA  = 'f';      const TYPE_NUMERIC  = 'n';      const TYPE_BOOL     = 'b';      const TYPE_NULL     = 'null';      const TYPE_INLINE   = 'inlineStr';      const TYPE_ERROR    = 'e';              private static $errorCodes = array(          '#NULL!'  => 0,          '#DIV/0!' => 1,          '#VALUE!' => 2,          '#REF!'   => 3,          '#NAME?'  => 4,          '#NUM!'   => 5,          '#N/A'    => 6      );              public static function getErrorCodes()      {          return self::$errorCodes;      }              public static function dataTypeForValue($pValue = null)      {          return PHPExcel_Cell_DefaultValueBinder::dataTypeForValue($pValue);      }              public static function checkString($pValue = null)      {          if ($pValue instanceof PHPExcel_RichText) {                           return $pValue;          }                     $pValue = PHPExcel_Shared_String::Substring($pValue, 0, 32767);                     $pValue = str_replace(array("\r\n", "\r"), "\n", $pValue);            return $pValue;      }              public static function checkErrorCode($pValue = null)      {          $pValue = (string) $pValue;            if (!array_key_exists($pValue, self::$errorCodes)) {              $pValue = '#NULL!';          }            return $pValue;      }  }  