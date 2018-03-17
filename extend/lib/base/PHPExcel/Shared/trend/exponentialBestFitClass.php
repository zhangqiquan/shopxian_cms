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

 * 时间: 2018-03-17 23:28:45
 */     require_once(PHPEXCEL_ROOT . 'PHPExcel/Shared/trend/bestFitClass.php');      class PHPExcel_Exponential_Best_Fit extends PHPExcel_Best_Fit  {            protected $bestFitType        = 'exponential';              public function getValueOfYForX($xValue)      {          return $this->getIntersect() * pow($this->getSlope(), ($xValue - $this->xOffset));      }              public function getValueOfXForY($yValue)      {          return log(($yValue + $this->yOffset) / $this->getIntersect()) / log($this->getSlope());      }              public function getEquation($dp = 0)      {          $slope = $this->getSlope($dp);          $intersect = $this->getIntersect($dp);            return 'Y = ' . $intersect . ' * ' . $slope . '^X';      }              public function getSlope($dp = 0)      {          if ($dp != 0) {              return round(exp($this->_slope), $dp);          }          return exp($this->_slope);      }              public function getIntersect($dp = 0)      {          if ($dp != 0) {              return round(exp($this->intersect), $dp);          }          return exp($this->intersect);      }              private function exponentialRegression($yValues, $xValues, $const)      {          foreach ($yValues as &$value) {              if ($value < 0.0) {                  $value = 0 - log(abs($value));              } elseif ($value > 0.0) {                  $value = log($value);              }          }          unset($value);            $this->leastSquareFit($yValues, $xValues, $const);      }              public function __construct($yValues, $xValues = array(), $const = true)      {          if (parent::__construct($yValues, $xValues) !== false) {              $this->exponentialRegression($yValues, $xValues, $const);          }      }  }  