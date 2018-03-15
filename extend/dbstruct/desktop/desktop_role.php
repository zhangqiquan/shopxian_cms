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
 */   return [      'Stru'=>[          'role_id'=>[              'type'=>'int',              'length'=>'11',              'default'=>null,              'unsigned'=>'true',              'not_null'=>'true',               'auto_increment'=>'true',              'comment'=>'角色id',              'zerofill'=>'true',              'auto_increment'=>true,              'label'=>'角色id',              'in_list' => true,              'input_type'=>'hidden',          ],          'shop_id'=>[              'type'=>'int',              'length'=>'10',              'default'=>'0',              'unsigned'=>'true',              'not_null'=>'true',               'comment'=>'店铺id',              'zerofill'=>'true',              'label'=>'店铺id',              'in_list' => false,              'input_type'=>'hidden',          ],          'role_name'=>[              'type'=>'varchar',              'length'=>'60',             'comment'=>'角色名',              'label'=>'角色名',              'in_list' => true,              'input_type'=>'text',          ],          'role_menu'=>[              'type'=>'text',              'length'=>'10000',             'comment'=>'角色菜单json',              'label'=>'角色菜单json',              'in_list' => false,              'input_type'=>'text',          ],      ],      'Charset'=>'utf8',      'Collate'=>'utf8_unicode_ci',      'Engine'=>'InnoDB',      'Annotation'=>'',      'primary'=>[              'role_id'      ],  ];  