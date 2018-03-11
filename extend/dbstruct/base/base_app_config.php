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
          return [      'Stru'=>[          'code'=>[              'type'=>'varchar',              'length'=>'60',             'comment'=>'code',              'label'=>'code(变量名)',              'not_null'=>'true',              'in_list' => true,              'width'=>'150',              'input_type'=>'text',          ],          'title'=>[              'type'=>'varchar',              'length'=>'60',             'comment'=>'标题',              'label'=>'标题',              'not_null'=>'true',              'width'=>'250',              'in_list' => true,              'input_type'=>'text',          ],          'value'=>[              'type'=>'varchar',              'length'=>'5000',             'comment'=>'value',              'label'=>'value(值)',              'default'=>'',              'width'=>'400',              'not_null'=>'true',              'in_list' => true,              'input_type'=>'text',          ],          'app'=>[              'type'=>'varchar',              'length'=>'60',             'comment'=>'所属app',              'label'=>'所属app',              'default'=>'',              'in_list' => true,              'value'=>[                  ''=>'全部',              ],              'input_type'=>'select',          ],          'description'=>[              'type'=>'varchar',              'length'=>'255',             'comment'=>'描述',              'label'=>'描述',              'default'=>'',              'width'=>'500',              'in_list' => true,              'value'=>[],              'input_type'=>'text',          ],      ],      'Charset'=>'utf8',      'Collate'=>'utf8_unicode_ci',      'Engine'=>'InnoDB',      'Annotation'=>'',      'primary'=>[              'code',      ],  ];  