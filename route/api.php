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

 * 时间: 2018-03-17 23:28:32
 */  use lib\base\Api; Route::get('api/captcha', function ($name) {     return response()         ->data(Api::run('\app\base\controller\Captcha','index'))         ->code(200)         ->contentType('text/plain'); }); Route::get('api/reporting', function () {     return response()         ->data(Api::run('\app\members\api\Reporting','index'))         ->code(200)         ->contentType('text/plain'); }); Route::get('api/downloadsysapp', function () {     return response()         ->data(Api::run('\app\system\api\downloadApp','index'))         ->code(200)         ->contentType('text/plain'); });