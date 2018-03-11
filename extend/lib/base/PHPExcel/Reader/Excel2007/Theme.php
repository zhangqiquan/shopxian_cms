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
                 class PHPExcel_Reader_Excel2007_Theme  {            private $themeName;              private $colourSchemeName;              private $colourMapValues;                private $colourMap;                public function __construct($themeName, $colourSchemeName, $colourMap)      {                   $this->themeName        = $themeName;          $this->colourSchemeName = $colourSchemeName;          $this->colourMap        = $colourMap;      }              public function getThemeName()      {          return $this->themeName;      }              public function getColourSchemeName()      {          return $this->colourSchemeName;      }              public function getColourByIndex($index = 0)      {          if (isset($this->colourMap[$index])) {              return $this->colourMap[$index];          }          return null;      }              public function __clone()      {          $vars = get_object_vars($this);          foreach ($vars as $key => $value) {              if ((is_object($value)) && ($key != '_parent')) {                  $this->$key = clone $value;              } else {                  $this->$key = $value;              }          }      }  }  