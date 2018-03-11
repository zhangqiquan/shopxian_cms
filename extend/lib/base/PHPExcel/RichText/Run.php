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
             class PHPExcel_RichText_Run extends PHPExcel_RichText_TextElement implements PHPExcel_RichText_ITextElement  {            private $font;              public function __construct($pText = '')      {                   $this->setText($pText);          $this->font = new PHPExcel_Style_Font();      }              public function getFont()      {          return $this->font;      }              public function setFont(PHPExcel_Style_Font $pFont = null)      {          $this->font = $pFont;          return $this;      }              public function getHashCode()      {          return md5(              $this->getText() .              $this->font->getHashCode() .              __CLASS__          );      }              public function __clone()      {          $vars = get_object_vars($this);          foreach ($vars as $key => $value) {              if (is_object($value)) {                  $this->$key = clone $value;              } else {                  $this->$key = $value;              }          }      }  }  