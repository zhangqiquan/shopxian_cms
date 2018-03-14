<?php 
 
namespace app\contents\controller; 
 
class Index extends Base{     
    public function index(){ 
        $this->assign('outermost_cid', 0); 
        return $this->template('contents', $this->df_style, 'index',[],[],true); 
    } 
    public function wap(){ 
        $domain=request()->domain().explode('index.php', $_SERVER['SCRIPT_NAME'])[0]; 
        $css_dir=''; 
        $dir='template/'.$this->site_type.'/'; 
        $css_dir=$dir.'css'; 
        echo $domain.$css_dir; 
        print_r($_SERVER); 
        die; 
        return $this->showTpl(); 
    } 
} 
