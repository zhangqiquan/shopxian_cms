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

 * 时间: 2018-03-17 23:28:45
 */       abstract class PHPExcel_Style_Supervisor  {            protected $isSupervisor;              protected $parent;              public function __construct($isSupervisor = false)      {                   $this->isSupervisor = $isSupervisor;      }              public function bindParent($parent, $parentPropertyName = null)      {          $this->parent = $parent;          return $this;      }              public function getIsSupervisor()      {          return $this->isSupervisor;      }              public function getActiveSheet()      {          return $this->parent->getActiveSheet();      }              public function getSelectedCells()      {          return $this->getActiveSheet()->getSelectedCells();      }              public function getActiveCell()      {          return $this->getActiveSheet()->getActiveCell();      }              public function __clone()      {          $vars = get_object_vars($this);          foreach ($vars as $key => $value) {              if ((is_object($value)) && ($key != 'parent')) {                  $this->$key = clone $value;              } else {                  $this->$key = $value;              }          }      }  }  