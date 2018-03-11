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

            * 时间: 2018-03-11 16:08:52
            */
             class PHPExcel_Writer_Excel2007_RelsVBA extends PHPExcel_Writer_Excel2007_WriterPart  {            public function writeVBARelationships(PHPExcel $pPHPExcel = null)      {                   $objWriter = null;          if ($this->getParentWriter()->getUseDiskCaching()) {              $objWriter = new PHPExcel_Shared_XMLWriter(PHPExcel_Shared_XMLWriter::STORAGE_DISK, $this->getParentWriter()->getDiskCachingDirectory());          } else {              $objWriter = new PHPExcel_Shared_XMLWriter(PHPExcel_Shared_XMLWriter::STORAGE_MEMORY);          }                     $objWriter->startDocument('1.0', 'UTF-8', 'yes');                     $objWriter->startElement('Relationships');          $objWriter->writeAttribute('xmlns', 'http:         $objWriter->startElement('Relationship');          $objWriter->writeAttribute('Id', 'rId1');          $objWriter->writeAttribute('Type', 'http:         $objWriter->writeAttribute('Target', 'vbaProjectSignature.bin');          $objWriter->endElement();          $objWriter->endElement();            return $objWriter->getData();        }  }  