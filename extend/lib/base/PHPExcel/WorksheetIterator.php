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
 */       class PHPExcel_WorksheetIterator implements Iterator  {            private $subject;              private $position = 0;              public function __construct(PHPExcel $subject = null)      {                   $this->subject = $subject;      }              public function __destruct()      {          unset($this->subject);      }              public function rewind()      {          $this->position = 0;      }              public function current()      {          return $this->subject->getSheet($this->position);      }              public function key()      {          return $this->position;      }              public function next()      {          ++$this->position;      }              public function valid()      {          return $this->position < $this->subject->getSheetCount();      }  }  