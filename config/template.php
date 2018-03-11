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

            * 时间: 2018-03-11 16:08:28
            */
                         return [           'type'         => 'Think',           'view_path'    => '',           'view_suffix'  => 'html',           'view_depr'    => DIRECTORY_SEPARATOR,           'tpl_begin'    => '<{',           'tpl_end'      => '}>',           'taglib_begin' => '<{',           'taglib_end'   => '}>',      'strip_space'        => true,      'tpl_cache'          => false,      'cache_time'         => 0,      'default_filter' => '',          'tpl_replace_string'=>[          '__ROOT_PATH__'=>  request()->domain(),      ],      'taglib_pre_load'=>'common\taglib\Cms,common\taglib\Input,common\taglib\Zhanshop,common\taglib\Model'  ];  