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
 */       class PHPExcel_Writer_OpenDocument_Settings extends PHPExcel_Writer_OpenDocument_WriterPart  {            public function write(PHPExcel $pPHPExcel = null)      {          if (!$pPHPExcel) {              $pPHPExcel = $this->getParentWriter()->getPHPExcel();          }            $objWriter = null;          if ($this->getParentWriter()->getUseDiskCaching()) {              $objWriter = new PHPExcel_Shared_XMLWriter(PHPExcel_Shared_XMLWriter::STORAGE_DISK, $this->getParentWriter()->getDiskCachingDirectory());          } else {              $objWriter = new PHPExcel_Shared_XMLWriter(PHPExcel_Shared_XMLWriter::STORAGE_MEMORY);          }                     $objWriter->startDocument('1.0', 'UTF-8');                     $objWriter->startElement('office:document-settings');              $objWriter->writeAttribute('xmlns:office', 'urn:oasis:names:tc:opendocument:xmlns:office:1.0');              $objWriter->writeAttribute('xmlns:xlink', 'http:             $objWriter->writeAttribute('xmlns:config', 'urn:oasis:names:tc:opendocument:xmlns:config:1.0');              $objWriter->writeAttribute('xmlns:ooo', 'http:             $objWriter->writeAttribute('office:version', '1.2');                $objWriter->startElement('office:settings');                  $objWriter->startElement('config:config-item-set');                      $objWriter->writeAttribute('config:name', 'ooo:view-settings');                      $objWriter->startElement('config:config-item-map-indexed');                          $objWriter->writeAttribute('config:name', 'Views');                      $objWriter->endElement();                  $objWriter->endElement();                  $objWriter->startElement('config:config-item-set');                      $objWriter->writeAttribute('config:name', 'ooo:configuration-settings');                  $objWriter->endElement();              $objWriter->endElement();          $objWriter->endElement();            return $objWriter->getData();      }  }  