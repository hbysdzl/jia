<?php

/***
***多层控制器
*/

namespace Home\Widget;
use Think\Controller;

class FootlinkWidget extends Controller{

	//友情链接列表
	public function linkList(){

		$urldb=M('furl');
		$where['status']=1;
		$urllist=$urldb->where($where)->order('id')->select();
		$this->assign('urllist',$urllist);
		$this->display('Footlink/linkList');
	}
}