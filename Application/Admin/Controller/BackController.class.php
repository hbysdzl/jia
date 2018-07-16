<?php
//后台总控制器
namespace Admin\Controller;
use Think\Controller;
class BackController extends Controller{
		
    protected $OneAuth;
	protected $TowAuth;
    //验证用户是否处于登陆状态
    public function __construct(){
        
        $admin_id=session('admin_id');
        if (!$admin_id){
           //调回登陆页面
           $this->redirect('Login/login');
		}
      
	  //强制调用父类的构造方法
      parent::__construct();
	  
	  	  //对用户所属的角色进行验证，防止翻墙
	  $controller=strtolower(CONTROLLER_NAME);//获得当前控制器名并统一转换为小写
	  $all_controller=array('login','index');//不需验证的控制器
	  if(!in_array($controller,$all_controller)){
		  $now_ac=strtolower(CONTROLLER_NAME.'-'.ACTION_NAME);
		  $admin_role=M('admin')->field('role_id')->find($admin_id);//获得当前管理员
		  if($admin_role['role_id']!=0){
			 $role_ac=M('role')->field('role_auth_ac')->find($admin_role['role_id']);//获得当前角色所拥有的控制器和方法
			 $role_ac_str=strtolower($role_ac['role_auth_ac']);
			 if(stripos($role_ac_str,$now_ac)===false){
					$this->error('无访问权限！');
					die();
			 }

		  }
	  }
	  
	  //权限显示菜单列表
	  //获取管理员的基本信息
	  $usr=M('admin')->find(session('admin_id'));
	  $authModel=M('auth');
	  if($usr['role_id']==0){//超级管理员拥有所有权限
		 $this->OneAuth=$authModel->where('auth_level=0')->order('sorting')->select();
		 $this->TowAuth=$authModel->where('auth_level=1')->order('sorting')->select();
	  }else{
		//获取该管理员所属的角色
		$role=M('role')->find($usr['role_id']);
		$this->OneAuth=$authModel->where("auth_level=0 and auth_id in ({$role['role_auth_ids']})")->order('sorting')->select();
		$this->TowAuth=$authModel->where("auth_level=1 and auth_id in ({$role['role_auth_ids']})")->order('sorting')->select();
	  }
    

	}
	
	/*
	 * 最终方法 对数据表的一行或多行记录执行状态修改
	 * */
	final protected function editRow($model,$data,$where,$msg){
	   
	    $where=array_merge(array('id'=>array('in',$id)),(array)$where);//合并数组
	    $msg=array_merge(array('success'=>'操作成功！','error'=>'操作失败！','url'=>'','ajax'=>IS_AJAX),(array)$msg);
	    
	    if(M($model)->where($where)->save($data)!==false){
	       
	        $this->ajaxReturn(array('status'=>1));
	    }else {
	        
	        $this->ajaxReturn(array('status'=>0,'error'=>$msg['error']));
	    }
	}
	
	/*
	 * 禁用
	 * */
	protected function forbid($model,$where=array(),$msg=array('success'=>'状态禁用成功！','error'=>'状态禁用失败！')){
	    $data=array('status'=>0);
	    $this->editRow($model, $data, $where, $msg);
	}
	
	/*
	 * 启用
	 * */
	protected function resumew($model,$where=array(),$msg=array('success'=>'状态恢复成功！','error'=>'状态恢复失败！')){
	    $data=array('status'=>1);
	    $this->editRow($model, $data, $where, $msg);
	}
	
	/*
	 * 删除
	 * */
	protected function delete($model,$where=array(),$msg=array('success'=>'删除成功！','error'=>'删除失败！')){
	    $data=array('status'=>-1);
	    $this->editRow($model, $data, $where, $msg);
	}
	
	
	
}