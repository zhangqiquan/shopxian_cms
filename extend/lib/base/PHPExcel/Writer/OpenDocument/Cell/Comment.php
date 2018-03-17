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
 */           class PHPExcel_Writer_OpenDocument_Cell_Comment  {      public static function write(PHPExcel_Shared_XMLWriter $objWriter, PHPExcel_Cell $cell)      {          $comments = $cell->getWorksheet()->getComments();          if (!isset($comments[$cell->getCoordinate()])) {              return;          }          $comment = $comments[$cell->getCoordinate()];            $objWriter->startElement('office:annotation');                                        $objWriter->writeAttribute('svg:width', $comment->getWidth());              $objWriter->writeAttribute('svg:height', $comment->getHeight());              $objWriter->writeAttribute('svg:x', $comment->getMarginLeft());              $objWriter->writeAttribute('svg:y', $comment->getMarginTop());                                            $objWriter->writeElement('dc:creator', $comment->getAuthor());                                                    $objWriter->writeElement('text:p', $comment->getText()->getPlainText());                               $objWriter->endElement();      }  }  