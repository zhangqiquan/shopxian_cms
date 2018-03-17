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
 */       return [      'Stru'=>[          'dir_id'=>[              'type'=>'varchar',              'length'=>'255',             'comment'=>'目录id',              'label'=>'目录id',              'in_list' => true,              'input_type'=>'hidden',          ],          'file_type'=>[              'type'=>'enum',              'length'=>'10',             'comment'=>'文件类型(及目录头)',              'label'=>'文件类型(及目录头)',              'in_list' => true,              'value'=>array(                  'image'=>'图片',                  'video'=>'视频',                  'audio'=>'压缩文件',                  'other'=>'其他文件'              ),          ],          'dir'=>[              'type'=>'varchar',              'length'=>'255',             'comment'=>'路径',              'label'=>'路径',              'in_list' => true,              'input_type'=>'hidden',          ],          'dir_name'=>[              'type'=>'varchar',              'length'=>'255',             'comment'=>'目录名',              'label'=>'目录名',              'in_list' => true,              'is_row_search'=>true,              'is_more_search'=>true,              'input_type'=>'hidden',          ],          'shop_id'=>[              'type'=>'int',              'length'=>'10',             'unsigned'=>'true',              'default'=>'0',              'comment'=>'店铺id',              'label'=>'店铺id',              'in_list' => true,              'default_in_list' => true,              'search_allow' => true,              'input_type'=>'hidden',          ],      ],      'Charset'=>'utf8',      'Collate'=>'utf8_unicode_ci',      'Engine'=>'InnoDB',      'Annotation'=>'',      'primary'=>[          'dir_id',      ],       'index'=>[          'goods_shop_id'=>[             'index_type'=>'Normal',             'index_way'=>'BTREE',             'columns'=>[                 'shop_id'              ],          ],      ]  ];  