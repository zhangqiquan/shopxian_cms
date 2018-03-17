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
 */     class PHPExcel_Reader_Excel5_Style_Border  {      protected static $map = array(          0x00 => PHPExcel_Style_Border::BORDER_NONE,          0x01 => PHPExcel_Style_Border::BORDER_THIN,          0x02 => PHPExcel_Style_Border::BORDER_MEDIUM,          0x03 => PHPExcel_Style_Border::BORDER_DASHED,          0x04 => PHPExcel_Style_Border::BORDER_DOTTED,          0x05 => PHPExcel_Style_Border::BORDER_THICK,          0x06 => PHPExcel_Style_Border::BORDER_DOUBLE,          0x07 => PHPExcel_Style_Border::BORDER_HAIR,          0x08 => PHPExcel_Style_Border::BORDER_MEDIUMDASHED,          0x09 => PHPExcel_Style_Border::BORDER_DASHDOT,          0x0A => PHPExcel_Style_Border::BORDER_MEDIUMDASHDOT,          0x0B => PHPExcel_Style_Border::BORDER_DASHDOTDOT,          0x0C => PHPExcel_Style_Border::BORDER_MEDIUMDASHDOTDOT,          0x0D => PHPExcel_Style_Border::BORDER_SLANTDASHDOT,      );              public static function lookup($index)      {          if (isset(self::$map[$index])) {              return self::$map[$index];          }          return PHPExcel_Style_Border::BORDER_NONE;      }  }