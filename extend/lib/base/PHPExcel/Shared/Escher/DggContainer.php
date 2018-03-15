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
 */       class PHPExcel_Shared_Escher_DggContainer  {            private $spIdMax;              private $cDgSaved;              private $cSpSaved;              private $bstoreContainer;              private $OPT = array();              private $IDCLs = array();              public function getSpIdMax()      {          return $this->spIdMax;      }              public function setSpIdMax($value)      {          $this->spIdMax = $value;      }              public function getCDgSaved()      {          return $this->cDgSaved;      }              public function setCDgSaved($value)      {          $this->cDgSaved = $value;      }              public function getCSpSaved()      {          return $this->cSpSaved;      }              public function setCSpSaved($value)      {          $this->cSpSaved = $value;      }              public function getBstoreContainer()      {          return $this->bstoreContainer;      }              public function setBstoreContainer($bstoreContainer)      {          $this->bstoreContainer = $bstoreContainer;      }              public function setOPT($property, $value)      {          $this->OPT[$property] = $value;      }              public function getOPT($property)      {          if (isset($this->OPT[$property])) {              return $this->OPT[$property];          }          return null;      }              public function getIDCLs()      {          return $this->IDCLs;      }              public function setIDCLs($pValue)      {          $this->IDCLs = $pValue;      }  }  