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
 */   return [      'Stru'=>[          'code'=>[              'type'=>'varchar',              'length'=>'60',             'comment'=>'变量名',              'not_null'=>'true',              'label'=>'变量名',              'in_list' => true,              'input_type'=>'text',          ],          'title'=>[              'type'=>'varchar',              'length'=>'60',             'comment'=>'标题',              'not_null'=>'true',              'label'=>'标题',              'in_list' => true,              'is_row_search'=>true,              'is_more_search'=>true,              'input_type'=>'text',          ],          'value'=>[              'type'=>'text',              'length'=>'10000',             'comment'=>'变量值',              'not_null'=>'true',              'label'=>'变量值',              'in_list' => true,              'is_row_search'=>true,              'is_more_search'=>true,              'input_type'=>'text',          ],          'lock'=>[              'type'=>'enum',              'length'=>'5',             'default'=>'1',              'not_null'=>'true',              'comment'=>'锁定状态',              'value'=>array(                  '0'=>'非锁定',                  '1'=>'锁定',              ),              'label'=>'锁定状态',              'in_list' => true,              'is_row_search'=>true,              'is_more_search'=>true,              'input_type'=>'radio',          ],          'rank'=>[              'type'=>'MEDIUMINT',              'length'=>'8',              'default'=>'50',              'unsigned'=>'true',              'not_null'=>'true',              'comment'=>'排序',              'label'=>'排序',              'in_list' => true,              'is_row_search'=>true,              'is_more_search'=>true,              'input_type'=>'text',          ],      ],      'Charset'=>'utf8',      'Collate'=>'utf8_unicode_ci',      'Engine'=>'InnoDB',      'Annotation'=>'',      'primary'=>[              'code',      ],  ];  