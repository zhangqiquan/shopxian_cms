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
             class PHPExcel_CalcEngine_CyclicReferenceStack  {            private $stack = array();              public function count()      {          return count($this->stack);      }              public function push($value)      {          $this->stack[$value] = $value;      }              public function pop()      {          return array_pop($this->stack);      }              public function onStack($value)      {          return isset($this->stack[$value]);      }              public function clear()      {          $this->stack = array();      }              public function showStack()      {          return $this->stack;      }  }  