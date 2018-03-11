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
                 class PHPExcel_Shared_PasswordHasher  {            public static function hashPassword($pPassword = '')      {          $password   = 0x0000;          $charPos    = 1;                           $chars = preg_split('         foreach ($chars as $char) {              $value            = ord($char) << $charPos++;                 $rotated_bits    = $value >> 15;                             $value            &= 0x7fff;                                 $password        ^= ($value | $rotated_bits);          }            $password ^= strlen($pPassword);          $password ^= 0xCE4B;            return(strtoupper(dechex($password)));      }  }  