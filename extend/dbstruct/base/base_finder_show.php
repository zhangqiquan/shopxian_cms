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
         return [      'Stru'=>[          'show_id'=>[              'type'=>'varchar',              'length'=>'60',             'comment'=>'显示配置',              'label'=>'日记id',              'in_list' => true,              'default_in_list' => true,              'search_allow' => true,              'input_type'=>'text',          ],          'finder_data'=>[              'type'=>'text',              'length'=>'5000',             'comment'=>'配置的json',              'label'=>'配置的json',              'in_list' => true,              'default_in_list' => true,              'search_allow' => true,              'input_type'=>'textarea',          ],      ],      'Charset'=>'utf8',      'Collate'=>'utf8_unicode_ci',      'Engine'=>'InnoDB',      'Annotation'=>'',      'primary'=>[              'show_id',      ],  ];  