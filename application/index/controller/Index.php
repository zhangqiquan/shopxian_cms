<?php 

namespace app\index\controller;

class Index {
    public function index(){
        $Index=new \app\contents\controller\Index();
        return $Index->index();
    }
}
