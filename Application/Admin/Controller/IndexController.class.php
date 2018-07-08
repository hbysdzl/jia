<?php
namespace Admin\Controller;
use Admin\Controller\BackController;

class IndexController extends BackController {
    
    public function index(){
         
        $this->assign('title','家造网管理平台');
		//根据用户权限显示菜单！	
		$this->assign('OneAuth',$this->OneAuth);
		$this->assign('TowAuth',$this->TowAuth);
            
		$this->display();
    }
    
    //退出登陆
    
    public function outLogin(){
        
        session('admin_id',null);
        session('admin_name',null);
        $this->redirect('Login/login');
    }
}