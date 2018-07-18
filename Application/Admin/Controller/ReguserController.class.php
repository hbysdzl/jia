<?php

/*
* 网站会员管理控制器
*
*/

namespace Admin\Controller;
use Admin\Controller\BackController;

class ReguserController extends BackController{

	//会员管理列表
	public function index(){
		$this->assign(array('title'=>'会员管理列表','OneAuth'=>$this->OneAuth,'TowAuth'=>$this->TowAuth));
		$this->display();
	}
}