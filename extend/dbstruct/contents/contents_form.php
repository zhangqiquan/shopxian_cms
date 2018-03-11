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

            * 时间: 2018-03-11 16:08:53
            */
         return [      'Stru'=>[          'form_id'=>[              'type'=>'int',              'length'=>'10',              'default'=>null,              'unsigned'=>'true',              'not_null'=>'true',              'auto_increment'=>'true',              'comment'=>'自定义表单id',              'zerofill'=>'true',              'auto_increment'=>true,              'label'=>'自定义表单id',              'in_list' => true,              'input_type'=>'hidden',          ],          'name'=>[              'type'=>'varchar',              'length'=>'60',             'comment'=>'表单名称',              'label'=>'表单名称',              'in_list' => true,              'input_type'=>'text',          ],          'verify_code'=>[              'type'=>'enum',              'length'=>'2',              'default'=>'0',              'not_null'=>'true',              'comment'=>'是否启用验证码',              'value'=>array(                  0=>'不启用',                  1=>'启用',              ),              'label'=>'是否启用验证码',              'in_list' => true,              'input_type'=>'radio',          ],          'tempadd'=>[              'type'=>'varchar',              'length'=>'100',              'default'=>'guestbook',              'comment'=>'发布模版',              'label'=>'发布模版',              'in_list' => true,              'input_type'=>'test',          ],           'fields'=>[              'type'=>'text',              'length'=>'3000',              'comment'=>'字段列表json最大允许64个字段',              'label'=>'字段列表',              'in_list' => true,              'tag_val'=>'',              'input_type'=>'taglib',          ],       ],      'Charset'=>'utf8',      'Collate'=>'utf8_unicode_ci',      'Engine'=>'MyISAM',      'Annotation'=>'',      'primary'=>[              'form_id',      ],  ];  