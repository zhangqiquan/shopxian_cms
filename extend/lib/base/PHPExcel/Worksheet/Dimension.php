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
 */       abstract class PHPExcel_Worksheet_Dimension  {            private $visible = true;              private $outlineLevel = 0;              private $collapsed = false;              private $xfIndex;              public function __construct($initialValue = null)      {                   $this->xfIndex = $initialValue;      }              public function getVisible()      {          return $this->visible;      }              public function setVisible($pValue = true)      {          $this->visible = $pValue;          return $this;      }              public function getOutlineLevel()      {          return $this->outlineLevel;      }              public function setOutlineLevel($pValue)      {          if ($pValue < 0 || $pValue > 7) {              throw new PHPExcel_Exception("Outline level must range between 0 and 7.");          }            $this->outlineLevel = $pValue;          return $this;      }              public function getCollapsed()      {          return $this->collapsed;      }              public function setCollapsed($pValue = true)      {          $this->collapsed = $pValue;          return $this;      }              public function getXfIndex()      {          return $this->xfIndex;      }              public function setXfIndex($pValue = 0)      {          $this->xfIndex = $pValue;          return $this;      }              public function __clone()      {          $vars = get_object_vars($this);          foreach ($vars as $key => $value) {              if (is_object($value)) {                  $this->$key = clone $value;              } else {                  $this->$key = $value;              }          }      }  }  