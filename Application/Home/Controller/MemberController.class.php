<?php

/*
***前台会员管理注册，登录控制器
***
*/
namespace Home\Controller;
use Think\Controller;

class MemberController extends Controller{

		//会员注册
		public function registr(){

			if(IS_POST){

			}else{
				$this->display();
			}
		}
}