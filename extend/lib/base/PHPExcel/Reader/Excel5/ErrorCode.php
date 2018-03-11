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
           class PHPExcel_Reader_Excel5_ErrorCode  {      protected static $map = array(          0x00 => '#NULL!',          0x07 => '#DIV/0!',          0x0F => '#VALUE!',          0x17 => '#REF!',          0x1D => '#NAME?',          0x24 => '#NUM!',          0x2A => '#N/A',      );              public static function lookup($code)      {          if (isset(self::$map[$code])) {              return self::$map[$code];          }          return false;      }  }