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

            * 时间: 2018-03-11 16:08:51
            */
                                   class PHPExcel_Shared_OLE_PPS_File extends PHPExcel_Shared_OLE_PPS  {            public function __construct($name)      {          parent::__construct(null, $name, PHPExcel_Shared_OLE::OLE_PPS_TYPE_FILE, null, null, null, null, null, '', array());      }              public function init()      {          return true;      }              public function append($data)      {          $this->_data .= $data;      }              public function getStream()      {          $this->ole->getStream($this);      }  }  