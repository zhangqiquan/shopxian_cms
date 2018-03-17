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
 */     if (!defined('DATE_W3C')) {      define('DATE_W3C', 'Y-m-d\TH:i:sP');  }    if (!defined('DEBUGMODE_ENABLED')) {      define('DEBUGMODE_ENABLED', false);  }      class PHPExcel_Shared_XMLWriter extends XMLWriter  {            const STORAGE_MEMORY    = 1;      const STORAGE_DISK      = 2;              private $tempFileName  = '';              public function __construct($pTemporaryStorage = self::STORAGE_MEMORY, $pTemporaryStorageFolder = null)      {                   if ($pTemporaryStorage == self::STORAGE_MEMORY) {              $this->openMemory();          } else {                           if ($pTemporaryStorageFolder === null) {                  $pTemporaryStorageFolder = PHPExcel_Shared_File::sys_get_temp_dir();              }              $this->tempFileName = @tempnam($pTemporaryStorageFolder, 'xml');                             if ($this->openUri($this->tempFileName) === false) {                                   $this->openMemory();              }          }                     if (DEBUGMODE_ENABLED) {              $this->setIndent(true);          }      }              public function __destruct()      {                   if ($this->tempFileName != '') {              @unlink($this->tempFileName);          }      }              public function getData()      {          if ($this->tempFileName == '') {              return $this->outputMemory(true);          } else {              $this->flush();              return file_get_contents($this->tempFileName);          }      }              public function writeRawData($text)      {          if (is_array($text)) {              $text = implode("\n", $text);          }            if (method_exists($this, 'writeRaw')) {              return $this->writeRaw(htmlspecialchars($text));          }            return $this->text($text);      }  }  