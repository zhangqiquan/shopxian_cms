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
             class PHPExcel_Calculation_Token_Stack  {            private $stack = array();              private $count = 0;              public function count()      {          return $this->count;      }              public function push($type, $value, $reference = null)      {          $this->stack[$this->count++] = array(              'type'      => $type,              'value'     => $value,              'reference' => $reference          );          if ($type == 'Function') {              $localeFunction = PHPExcel_Calculation::localeFunc($value);              if ($localeFunction != $value) {                  $this->stack[($this->count - 1)]['localeValue'] = $localeFunction;              }          }      }              public function pop()      {          if ($this->count > 0) {              return $this->stack[--$this->count];          }          return null;      }              public function last($n = 1)      {          if ($this->count - $n < 0) {              return null;          }          return $this->stack[$this->count - $n];      }              public function clear()      {          $this->stack = array();          $this->count = 0;      }  }  