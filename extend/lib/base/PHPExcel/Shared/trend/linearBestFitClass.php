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
           require_once(PHPEXCEL_ROOT . 'PHPExcel/Shared/trend/bestFitClass.php');      class PHPExcel_Linear_Best_Fit extends PHPExcel_Best_Fit  {            protected $bestFitType        = 'linear';              public function getValueOfYForX($xValue)      {          return $this->getIntersect() + $this->getSlope() * $xValue;      }              public function getValueOfXForY($yValue)      {          return ($yValue - $this->getIntersect()) / $this->getSlope();      }                public function getEquation($dp = 0)      {          $slope = $this->getSlope($dp);          $intersect = $this->getIntersect($dp);            return 'Y = ' . $intersect . ' + ' . $slope . ' * X';      }              private function linearRegression($yValues, $xValues, $const)      {          $this->leastSquareFit($yValues, $xValues, $const);      }              public function __construct($yValues, $xValues = array(), $const = true)      {          if (parent::__construct($yValues, $xValues) !== false) {              $this->linearRegression($yValues, $xValues, $const);          }      }  }  