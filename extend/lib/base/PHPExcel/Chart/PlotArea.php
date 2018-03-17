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

 * 时间: 2018-03-17 23:28:43
 */       class PHPExcel_Chart_PlotArea  {            private $layout = null;              private $plotSeries = array();              public function __construct(PHPExcel_Chart_Layout $layout = null, $plotSeries = array())      {          $this->layout = $layout;          $this->plotSeries = $plotSeries;      }              public function getLayout()      {          return $this->layout;      }              public function getPlotGroupCount()      {          return count($this->plotSeries);      }              public function getPlotSeriesCount()      {          $seriesCount = 0;          foreach ($this->plotSeries as $plot) {              $seriesCount += $plot->getPlotSeriesCount();          }          return $seriesCount;      }              public function getPlotGroup()      {          return $this->plotSeries;      }              public function getPlotGroupByIndex($index)      {          return $this->plotSeries[$index];      }              public function setPlotSeries($plotSeries = array())      {          $this->plotSeries = $plotSeries;                    return $this;      }        public function refresh(PHPExcel_Worksheet $worksheet)      {          foreach ($this->plotSeries as $plotSeries) {              $plotSeries->refresh($worksheet);          }      }  }  