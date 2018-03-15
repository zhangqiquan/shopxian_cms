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
 */       abstract class PHPExcel_Writer_Abstract implements PHPExcel_Writer_IWriter  {            protected $includeCharts = false;              protected $preCalculateFormulas = true;              protected $_useDiskCaching = false;              protected $_diskCachingDirectory    = './';              public function getIncludeCharts()      {          return $this->includeCharts;      }              public function setIncludeCharts($pValue = false)      {          $this->includeCharts = (boolean) $pValue;          return $this;      }              public function getPreCalculateFormulas()      {          return $this->preCalculateFormulas;      }              public function setPreCalculateFormulas($pValue = true)      {          $this->preCalculateFormulas = (boolean) $pValue;          return $this;      }              public function getUseDiskCaching()      {          return $this->_useDiskCaching;      }              public function setUseDiskCaching($pValue = false, $pDirectory = null)      {          $this->_useDiskCaching = $pValue;            if ($pDirectory !== null) {              if (is_dir($pDirectory)) {                  $this->_diskCachingDirectory = $pDirectory;              } else {                  throw new PHPExcel_Writer_Exception("Directory does not exist: $pDirectory");              }          }          return $this;      }              public function getDiskCachingDirectory()      {          return $this->_diskCachingDirectory;      }  }  