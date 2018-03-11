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
             abstract class PHPExcel_Writer_Excel2007_WriterPart  {            private $parentWriter;              public function setParentWriter(PHPExcel_Writer_IWriter $pWriter = null)      {          $this->parentWriter = $pWriter;      }              public function getParentWriter()      {          if (!is_null($this->parentWriter)) {              return $this->parentWriter;          } else {              throw new PHPExcel_Writer_Exception("No parent PHPExcel_Writer_IWriter assigned.");          }      }              public function __construct(PHPExcel_Writer_IWriter $pWriter = null)      {          if (!is_null($pWriter)) {              $this->parentWriter = $pWriter;          }      }  }  