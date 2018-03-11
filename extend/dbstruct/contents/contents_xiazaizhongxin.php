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

            * 时间: 2018-03-11 18:25:13
            */
         return [      'Stru'=>[          'id'=>[              'type'=>'int',              'length'=>'11',              'default'=>null,              'label'=>'文章id',              'in_list' => true,              'input_type'=>'hidden',          ],         'banben'=>[                  'type'=>'varchar',                  'length'=>'100',                 'comment'=>'版本',                  'label'=>'版本',                  'in_list' => false,                                    'default'=>'',                  'input_type'=>'text',              ],         'dizhi'=>[                  'type'=>'varchar',                  'length'=>'255',                 'comment'=>'下载地址',                  'label'=>'下载地址',                  'in_list' => false,                                    'default'=>'',                  'input_type'=>'text',              ],     ],      'Charset'=>'utf8',      'Collate'=>'utf8_unicode_ci',      'Engine'=>'MyISAM',      'Annotation'=>'',      'primary'=>[              'id',      ],  ];