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
 */       class PHPExcel_Shared_Escher_DggContainer_BstoreContainer_BSE  {      const BLIPTYPE_ERROR    = 0x00;      const BLIPTYPE_UNKNOWN  = 0x01;      const BLIPTYPE_EMF      = 0x02;      const BLIPTYPE_WMF      = 0x03;      const BLIPTYPE_PICT     = 0x04;      const BLIPTYPE_JPEG     = 0x05;      const BLIPTYPE_PNG      = 0x06;      const BLIPTYPE_DIB      = 0x07;      const BLIPTYPE_TIFF     = 0x11;      const BLIPTYPE_CMYKJPEG = 0x12;              private $parent;              private $blip;              private $blipType;              public function setParent($parent)      {          $this->parent = $parent;      }              public function getBlip()      {          return $this->blip;      }              public function setBlip($blip)      {          $this->blip = $blip;          $blip->setParent($this);      }              public function getBlipType()      {          return $this->blipType;      }              public function setBlipType($blipType)      {          $this->blipType = $blipType;      }  }  