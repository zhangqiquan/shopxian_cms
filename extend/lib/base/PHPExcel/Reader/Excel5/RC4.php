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
             class PHPExcel_Reader_Excel5_RC4  {           protected $s = array();      protected $i = 0;      protected $j = 0;              public function __construct($key)      {          $len = strlen($key);            for ($this->i = 0; $this->i < 256; $this->i++) {              $this->s[$this->i] = $this->i;          }            $this->j = 0;          for ($this->i = 0; $this->i < 256; $this->i++) {              $this->j = ($this->j + $this->s[$this->i] + ord($key[$this->i % $len])) % 256;              $t = $this->s[$this->i];              $this->s[$this->i] = $this->s[$this->j];              $this->s[$this->j] = $t;          }          $this->i = $this->j = 0;      }              public function RC4($data)      {          $len = strlen($data);          for ($c = 0; $c < $len; $c++) {              $this->i = ($this->i + 1) % 256;              $this->j = ($this->j + $this->s[$this->i]) % 256;              $t = $this->s[$this->i];              $this->s[$this->i] = $this->s[$this->j];              $this->s[$this->j] = $t;                $t = ($this->s[$this->i] + $this->s[$this->j]) % 256;                $data[$c] = chr(ord($data[$c]) ^ $this->s[$t]);          }          return $data;      }  }  