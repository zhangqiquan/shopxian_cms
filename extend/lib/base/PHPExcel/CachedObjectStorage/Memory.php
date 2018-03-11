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
             class PHPExcel_CachedObjectStorage_Memory extends PHPExcel_CachedObjectStorage_CacheBase implements PHPExcel_CachedObjectStorage_ICache  {            protected function storeData()      {      }              public function addCacheData($pCoord, PHPExcel_Cell $cell)      {          $this->cellCache[$pCoord] = $cell;                     $this->currentObjectID = $pCoord;            return $cell;      }                public function getCacheData($pCoord)      {                   if (!isset($this->cellCache[$pCoord])) {              $this->currentObjectID = null;                           return null;          }                     $this->currentObjectID = $pCoord;                     return $this->cellCache[$pCoord];      }                public function copyCellCollection(PHPExcel_Worksheet $parent)      {          parent::copyCellCollection($parent);            $newCollection = array();          foreach ($this->cellCache as $k => &$cell) {              $newCollection[$k] = clone $cell;              $newCollection[$k]->attach($this);          }            $this->cellCache = $newCollection;      }              public function unsetWorksheetCells()      {                   foreach ($this->cellCache as $k => &$cell) {              $cell->detach();              $this->cellCache[$k] = null;          }          unset($cell);            $this->cellCache = array();                     $this->parent = null;      }  }  