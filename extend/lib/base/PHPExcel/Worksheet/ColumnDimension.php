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
 */       class PHPExcel_Worksheet_ColumnDimension extends PHPExcel_Worksheet_Dimension  {            private $columnIndex;              private $width = -1;              private $autoSize = false;              public function __construct($pIndex = 'A')      {                   $this->columnIndex = $pIndex;                     parent::__construct(0);      }              public function getColumnIndex()      {          return $this->columnIndex;      }              public function setColumnIndex($pValue)      {          $this->columnIndex = $pValue;          return $this;      }              public function getWidth()      {          return $this->width;      }              public function setWidth($pValue = -1)      {          $this->width = $pValue;          return $this;      }              public function getAutoSize()      {          return $this->autoSize;      }              public function setAutoSize($pValue = false)      {          $this->autoSize = $pValue;          return $this;      }  }  