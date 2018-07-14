<?php
/*
 * 家居服务人员/地区/工种分类管理控制器
 * 
 * */

namespace Admin\Controller;
use Admin\Controller\BackController;

class HomeserController extends BackController{
    
    /*
     * 服务人员列表
     * */
    public function index(){
        
        $this->assign(array('title'=>'家居服务人员列表','OneAuth'=>$this->OneAuth,'TowAuth'=>$this->TowAuth));
    }
}