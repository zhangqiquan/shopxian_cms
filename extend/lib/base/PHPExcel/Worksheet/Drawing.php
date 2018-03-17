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
 */       class PHPExcel_Worksheet_Drawing extends PHPExcel_Worksheet_BaseDrawing implements PHPExcel_IComparable  {            private $path;              public function __construct()      {                   $this->path = '';                     parent::__construct();      }              public function getFilename()      {          return basename($this->path);      }              public function getIndexedFilename()      {          $fileName = $this->getFilename();          $fileName = str_replace(' ', '_', $fileName);          return str_replace('.' . $this->getExtension(), '', $fileName) . $this->getImageIndex() . '.' . $this->getExtension();      }              public function getExtension()      {          $exploded = explode(".", basename($this->path));          return $exploded[count($exploded) - 1];      }              public function getPath()      {          return $this->path;      }              public function setPath($pValue = '', $pVerifyFile = true)      {          if ($pVerifyFile) {              if (file_exists($pValue)) {                  $this->path = $pValue;                    if ($this->width == 0 && $this->height == 0) {                                           list($this->width, $this->height) = getimagesize($pValue);                  }              } else {                  throw new PHPExcel_Exception("File $pValue not found!");              }          } else {              $this->path = $pValue;          }          return $this;      }              public function getHashCode()      {          return md5(              $this->path .              parent::getHashCode() .              __CLASS__          );      }              public function __clone()      {          $vars = get_object_vars($this);          foreach ($vars as $key => $value) {              if (is_object($value)) {                  $this->$key = clone $value;              } else {                  $this->$key = $value;              }          }      }  }  