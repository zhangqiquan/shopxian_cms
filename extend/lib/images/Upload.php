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
         namespace lib\image;    class Upload {      use \traits\controller\Jump;            public static function image($user_id){          $path=dirname($_SERVER['SCRIPT_FILENAME']) . DIRECTORY_SEPARATOR;          $path1=DS.'uploads'.DIRECTORY_SEPARATOR.'member'.$user_id.DIRECTORY_SEPARATOR.date('Ymd').DS;          $path.=$path1;          $path2=uniqid().'.'.pathinfo($_FILES["file"]['name'])['extension'];          $path.=$path2;          $exarr=explode(DS,$path1);          $path1=DS.'uploads'.DIRECTORY_SEPARATOR.'member'.$user_id.DIRECTORY_SEPARATOR.date('Ymd').DIRECTORY_SEPARATOR.$path2;          $mkpath=dirname($_SERVER['SCRIPT_FILENAME']) . DIRECTORY_SEPARATOR;          foreach($exarr as $k=>$v){              if($k==0||$v==false) continue;              $mkpath.=$v.DS;              if(!is_dir($mkpath))mkdir ($mkpath, 0777);          }          if(move_uploaded_file($_FILES['file']['tmp_name'], $path)){              return $this->success('上传成功','' , ltrim(ltrim(str_replace(DS, '/', $path1),'/'),'/'));          }else{              return $this->error('上传失败','' , '');          }      }  }  