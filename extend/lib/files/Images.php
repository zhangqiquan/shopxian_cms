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
 */   namespace lib\files;  use lib\images\Img;    class Images {            public static function upload($file,$info_name,$shop_id,$water=''){          $dir='default';          if(isset($_COOKIE['dir']))$dir=$_COOKIE['dir'];                   $root_path=dirname($_SERVER['SCRIPT_FILENAME']) . DIRECTORY_SEPARATOR;          $move_path=$root_path . 'uploads'.DIRECTORY_SEPARATOR.'business'.DIRECTORY_SEPARATOR.'shop_'.$shop_id.DIRECTORY_SEPARATOR.'image'.DIRECTORY_SEPARATOR.$dir.DIRECTORY_SEPARATOR. date('Ym').DIRECTORY_SEPARATOR.'level0'.DS;          $info = $file->rule('uniqid')->move($move_path);          $save_path='';          if($info){              $img_type=$info->getExtension();             $save_path=$move_path.$info->getSaveName();              $Filename=$info->getFilename();              $imgcompress=config("shopxian.imgcompress");              foreach($imgcompress as $key=>$value){                  $img=new Img($save_path);                  $img->scale($value['width'], $value['height']);                  if($water)$img->water($water, 14);                  $new_save_path=str_replace(DS.'level0'.DS, DS.$key.DS, $save_path);                  $new_save_dir=dirname($new_save_path);                  if(is_dir($new_save_dir)==false)mkdir ($new_save_dir);                  if($img_type=='png'){                      $img->savePng($new_save_path, 100);                  }else if($img_type=='gif'){                                        }else{                      $img->saveJpeg($new_save_path, 100);                  }              }              $adj_path=str_replace('\\','/',str_replace($root_path, '', $save_path));              return $adj_path;                }          return false;      }  }  