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
 */       class PHPExcel_Cell_Hyperlink  {            private $url;              private $tooltip;              public function __construct($pUrl = '', $pTooltip = '')      {                   $this->url     = $pUrl;          $this->tooltip = $pTooltip;      }              public function getUrl()      {          return $this->url;      }              public function setUrl($value = '')      {          $this->url = $value;          return $this;      }              public function getTooltip()      {          return $this->tooltip;      }              public function setTooltip($value = '')      {          $this->tooltip = $value;          return $this;      }              public function isInternal()      {          return strpos($this->url, 'sheet:     }              public function getHashCode()      {          return md5(              $this->url .              $this->tooltip .              __CLASS__          );      }  }  