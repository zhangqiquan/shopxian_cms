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

            * 时间: 2018-03-11 18:25:10
            */
           class PHPExcel_Reader_Excel5_Color  {            public static function map($color, $palette, $version)      {          if ($color <= 0x07 || $color >= 0x40) {                           return PHPExcel_Reader_Excel5_Color_BuiltIn::lookup($color);          } elseif (isset($palette) && isset($palette[$color - 8])) {                           return $palette[$color - 8];          } else {                           if ($version == PHPExcel_Reader_Excel5::XLS_BIFF8) {                  return PHPExcel_Reader_Excel5_Color_BIFF8::lookup($color);              } else {                                   return PHPExcel_Reader_Excel5_Color_BIFF5::lookup($color);              }          }            return $color;      }  }