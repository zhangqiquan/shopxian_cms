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
             class PHPExcel_CachedObjectStorage_MemoryGZip extends PHPExcel_CachedObjectStorage_CacheBase implements PHPExcel_CachedObjectStorage_ICache  {            protected function storeData()      {          if ($this->currentCellIsDirty && !empty($this->currentObjectID)) {              $this->currentObject->detach();                $this->cellCache[$this->currentObjectID] = gzdeflate(serialize($this->currentObject));              $this->currentCellIsDirty = false;          }          $this->currentObjectID = $this->currentObject = null;      }                public function addCacheData($pCoord, PHPExcel_Cell $cell)      {          if (($pCoord !== $this->currentObjectID) && ($this->currentObjectID !== null)) {              $this->storeData();          }            $this->currentObjectID = $pCoord;          $this->currentObject = $cell;          $this->currentCellIsDirty = true;            return $cell;      }                public function getCacheData($pCoord)      {          if ($pCoord === $this->currentObjectID) {              return $this->currentObject;          }          $this->storeData();                     if (!isset($this->cellCache[$pCoord])) {                           return null;          }                     $this->currentObjectID = $pCoord;          $this->currentObject = unserialize(gzinflate($this->cellCache[$pCoord]));                   $this->currentObject->attach($this);                     return $this->currentObject;      }                public function getCellList()      {          if ($this->currentObjectID !== null) {              $this->storeData();          }            return parent::getCellList();      }                public function unsetWorksheetCells()      {          if (!is_null($this->currentObject)) {              $this->currentObject->detach();              $this->currentObject = $this->currentObjectID = null;          }          $this->cellCache = array();                     $this->parent = null;      }  }  