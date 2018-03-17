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

 * 时间: 2018-03-17 23:28:43
 */       class PHPExcel_CalcEngine_Logger  {            private $writeDebugLog = false;              private $echoDebugLog = false;              private $debugLog = array();              private $cellStack;              public function __construct(PHPExcel_CalcEngine_CyclicReferenceStack $stack)      {          $this->cellStack = $stack;      }              public function setWriteDebugLog($pValue = false)      {          $this->writeDebugLog = $pValue;      }              public function getWriteDebugLog()      {          return $this->writeDebugLog;      }              public function setEchoDebugLog($pValue = false)      {          $this->echoDebugLog = $pValue;      }              public function getEchoDebugLog()      {          return $this->echoDebugLog;      }              public function writeDebugLog()      {                   if ($this->writeDebugLog) {              $message = implode(func_get_args());              $cellReference = implode(' -> ', $this->cellStack->showStack());              if ($this->echoDebugLog) {                  echo $cellReference,                      ($this->cellStack->count() > 0 ? ' => ' : ''),                      $message,                      PHP_EOL;              }              $this->debugLog[] = $cellReference .                  ($this->cellStack->count() > 0 ? ' => ' : '') .                  $message;          }      }              public function clearLog()      {          $this->debugLog = array();      }              public function getLog()      {          return $this->debugLog;      }  }  