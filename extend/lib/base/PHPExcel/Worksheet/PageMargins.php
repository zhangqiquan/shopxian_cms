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
 */           class PHPExcel_Worksheet_PageMargins  {            private $left        = 0.7;              private $right        = 0.7;              private $top        = 0.75;              private $bottom    = 0.75;              private $header     = 0.3;              private $footer     = 0.3;              public function __construct()      {      }              public function getLeft()      {          return $this->left;      }              public function setLeft($pValue)      {          $this->left = $pValue;          return $this;      }              public function getRight()      {          return $this->right;      }              public function setRight($pValue)      {          $this->right = $pValue;          return $this;      }              public function getTop()      {          return $this->top;      }              public function setTop($pValue)      {          $this->top = $pValue;          return $this;      }              public function getBottom()      {          return $this->bottom;      }              public function setBottom($pValue)      {          $this->bottom = $pValue;          return $this;      }              public function getHeader()      {          return $this->header;      }              public function setHeader($pValue)      {          $this->header = $pValue;          return $this;      }              public function getFooter()      {          return $this->footer;      }              public function setFooter($pValue)      {          $this->footer = $pValue;          return $this;      }              public function __clone()      {          $vars = get_object_vars($this);          foreach ($vars as $key => $value) {              if (is_object($value)) {                  $this->$key = clone $value;              } else {                  $this->$key = $value;              }          }      }  }  