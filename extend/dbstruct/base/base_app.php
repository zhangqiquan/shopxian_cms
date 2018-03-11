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

            * 时间: 2018-03-11 18:25:09
            */
         return [      'Stru'=>[          'app_id'=>[              'type'=>'varchar',              'length'=>'60',             'comment'=>'应用id',              'label'=>'应用id',              'in_list' => true,              'default_in_list' => true,              'width'=>'80',              'search_allow' => true,              'input_type'=>'text',          ],          'app_name'=>[              'type'=>'varchar',              'length'=>'60',             'comment'=>'应用名称',              'label'=>'应用名称',              'width'=>'200',              'in_list' => true,              'default_in_list' => true,              'search_allow' => true,              'input_type'=>'text',          ],          'description'=>[              'type'=>'varchar',              'length'=>'500',             'comment'=>'应用描述',              'label'=>'应用描述',              'in_list' => true,              'width'=>'500',              'default_in_list' => true,              'search_allow' => true,              'input_type'=>'text',          ],          'enabled'=>[              'type'=>'enum',              'length'=>'5',             'default'=>'true',              'not_null'=>'true',              'comment'=>'状态',              'width'=>'120',              'value'=>array(                  'false'=>'未安装',                 'true'=>'已安装'             ),              'label'=>'状态',              'in_list' => true,              'default_in_list' => true,              'search_allow' => true,              'input_type'=>'radio',          ],      ],      'Charset'=>'utf8',      'Collate'=>'utf8_unicode_ci',      'Engine'=>'InnoDB',      'Annotation'=>'',      'primary'=>[              'app_id',      ],  ];  