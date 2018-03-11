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
           namespace lib\base;    class ShopToken{      public static function shopId(){          if(isset($_REQUEST['token'])){              $tokenData=json_decode(token_decode($_REQUEST['token']),true);              if(isset($tokenData['user_id'])&&isset($tokenData['uname'])){                  session('shop_id',0);                  return 0;              }else if(isset ($tokenData['shop_id'])&&$tokenData['shop_id']&&$tokenData['member_id']&&$tokenData['member_name']){                  session('shop_id',$tokenData['shop_id']);                  session('member_id',$tokenData['member_id']);                  session('member_name',$tokenData['member_name']);                  return $tokenData['shop_id'];              }          } else if(session('shop_id')||session('shop_id')==0){              return session('shop_id');          }          exit('404');      }  }