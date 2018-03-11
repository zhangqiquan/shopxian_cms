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

            * 时间: 2018-03-11 18:25:11
            */
             class PHPExcel_Worksheet_Row  {            private $parent;              private $rowIndex = 0;              public function __construct(PHPExcel_Worksheet $parent = null, $rowIndex = 1)      {                   $this->parent   = $parent;          $this->rowIndex = $rowIndex;      }              public function __destruct()      {          unset($this->parent);      }              public function getRowIndex()      {          return $this->rowIndex;      }              public function getCellIterator($startColumn = 'A', $endColumn = null)      {          return new PHPExcel_Worksheet_RowCellIterator($this->parent, $this->rowIndex, $startColumn, $endColumn);      }  }  