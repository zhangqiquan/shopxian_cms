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
 */       class PHPExcel_Worksheet_Column  {            private $parent;              private $columnIndex;              public function __construct(PHPExcel_Worksheet $parent = null, $columnIndex = 'A')      {                   $this->parent         = $parent;          $this->columnIndex = $columnIndex;      }              public function __destruct()      {          unset($this->parent);      }              public function getColumnIndex()      {          return $this->columnIndex;      }              public function getCellIterator($startRow = 1, $endRow = null)      {          return new PHPExcel_Worksheet_ColumnCellIterator($this->parent, $this->columnIndex, $startRow, $endRow);      }  }  