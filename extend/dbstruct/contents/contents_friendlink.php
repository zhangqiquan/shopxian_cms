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
         return [      'Stru'=>[          'id'=>[              'type'=>'int',              'length'=>'10',              'default'=>null,              'unsigned'=>'true',              'not_null'=>'true',              'auto_increment'=>'true',              'comment'=>'友情链接id',              'zerofill'=>'true',              'auto_increment'=>true,              'label'=>'友情链接id',              'in_list' => true,              'input_type'=>'hidden',          ],          'title'=>[              'type'=>'varchar',              'length'=>'60',             'comment'=>'网站标题',              'label'=>'网站标题',              'in_list' => true,              'input_type'=>'text',          ],          'url'=>[              'type'=>'varchar',              'length'=>'255',             'comment'=>'链接地址',              'label'=>'链接地址',              'in_list' => true,              'input_type'=>'url',          ],          'logo'=>[              'type'=>'varchar',              'length'=>'255',             'comment'=>'logo',              'label'=>'logo',              'in_list' => true,              'input_type'=>'imageBrowser',          ],          'remark'=>[              'type'=>'varchar',              'length'=>'255',             'comment'=>'备注',              'label'=>'备注',              'in_list' => true,              'input_type'=>'text',          ],          'contacts'=>[              'type'=>'varchar',              'length'=>'255',             'comment'=>'站长联系方式',              'label'=>'站长联系方式',              'in_list' => true,              'input_type'=>'text',          ],          'site_type'=>[              'type'=>'varchar',              'length'=>'60',             'comment'=>'网站类型',              'label'=>'网站类型',              'in_list' => true,              'input_type'=>'text',          ],          'position'=>[              'type'=>'enum',              'length'=>'10',              'default'=>'home',              'not_null'=>'true',              'comment'=>'链接位置',              'value'=>array(                  'home'=>'首页',                  'nside_pages'=>'内页',                  'all'=>'全部',              ),              'label'=>'链接位置',              'in_list' => true,              'input_type'=>'radio',          ],           'permission'=>[              'type'=>'enum',              'length'=>'2',              'default'=>'1',              'not_null'=>'true',              'comment'=>'阅读权限',              'value'=>array(                  0=>'待审核',                  1=>'开放浏览',              ),              'label'=>'阅读权限',              'in_list' => true,              'width'=>'100',              'input_type'=>'radio',          ],          'rank'=>[              'type'=>'int',              'length'=>'10',             'unsigned'=>'true',              'not_null'=>'true',              'comment'=>'排序值',              'label'=>'排序值(越小越靠前)',              'in_list' => true,              'input_type'=>'number',          ],      ],      'Charset'=>'utf8',      'Collate'=>'utf8_unicode_ci',      'Engine'=>'MyISAM',      'Annotation'=>'',      'primary'=>[              'id',      ],  ];  