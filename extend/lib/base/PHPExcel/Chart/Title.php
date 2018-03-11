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

            * 时间: 2018-03-11 18:25:10
            */
             class PHPExcel_Chart_Title  {              private $caption = null;              private $layout = null;              public function __construct($caption = null, PHPExcel_Chart_Layout $layout = null)      {          $this->caption = $caption;          $this->layout = $layout;      }              public function getCaption()      {          return $this->caption;      }              public function setCaption($caption = null)      {          $this->caption = $caption;                    return $this;      }              public function getLayout()      {          return $this->layout;      }  }  