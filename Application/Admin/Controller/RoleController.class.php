<?php
namespace Admin\Controller;
use Admin\Controller\BackController;
use think\Error;


class RoleController extends BackController{
	
	//角色列表
	public function role_list(){
		
		$RoleModel=M('role');
		$roleList=$RoleModel->select();
		
		//根据角色的权限id集合取出对应的权限
		$authModel=M('auth');
		foreach ($roleList as $k=>$v){
		     $roleList[$k]['chlia']=$authModel->field('auth_name')->where(array('auth_id'=>array('in',$v['role_auth_ids'])))->select();
		}
		
		$this->assign('roleList',$roleList);
		//根据用户权限显示菜单！
		$this->assign('title','角色管理');
		$this->assign('OneAuth',$this->OneAuth);
		$this->assign('TowAuth',$this->TowAuth);
        
		$this->display();
	}
	
	//	分配权限
	public function distribute($role_id){
	    
	    //获取当前角色目前所拥有的权限
	    $roleModel=M('role');
	    $Roles=$roleModel->find($role_id);
	    //将权限的集合转换为数组
	    $role_auth_arr=explode(',',$Roles['role_auth_ids']);
	    
	    $this->assign('role_auth_arr',$role_auth_arr);
	    //列出所有的权限
	    $authModel=M('auth');
	    $info_1=$authModel->where('auth_level=0')->select();
	    $info_2=$authModel->where('auth_level=1')->select();
	    
	    $this->assign('role_id',$Roles['role_id']);
	    $this->assign('info_1',$info_1);
	    $this->assign('info_2',$info_2);
	    //根据用户权限显示菜单！
	    $this->assign('title','分配权限');
	    $this->assign('OneAuth',$this->OneAuth);
	    $this->assign('TowAuth',$this->TowAuth);
	    $this->display();
		
	}
	
	//ajax分配角色权限入库
	public function ajaxDistributeAdd(){
	    if(IS_POST){
	        $auth_ids_arr=I('post.auth');
	        $role_id=I('post.role_id');
	        $RoleModel=D('Role');
	        if($RoleModel->addAuth($role_id,$auth_ids_arr)){
	            echo json_encode(array('ok'=>1));
	        }else{
	            echo json_encode(array('ok'=>0,'error'=>$RoleModel->getError()));
	        }
	    
	    } 
	    
	}
	
	//添加角色表单数据
	public function roleAdd(){
	    
	    //根据用户权限显示菜单！
	    $this->assign('title','添加角色');
	    $this->assign('OneAuth',$this->OneAuth);
	    $this->assign('TowAuth',$this->TowAuth);
	    $this->display();
	    
	}
	//ajax添加角色入库
	public function ajaxAdd(){
	    if(IS_POST){
	        $model=D('role');
	        if($model->field('role_name')->create(I('post.'),1)){
	            if($model->add()){
	                echo json_encode(array('ok'=>1));
	                die();
	            }
	        }
	        echo json_encode(array('ok'=>0,'error'=>$model->getError()));
	    }
	}
	
	//修改角色表单数据
	public function roleEdit($role_id){
	    
	    //取出当前角色名称
        $role=M('role')->find($role_id);
        
        $this->assign('role',$role);
	    //根据用户权限显示菜单！
        $this->assign('title','修改角色');
	    $this->assign('OneAuth',$this->OneAuth);
	    $this->assign('TowAuth',$this->TowAuth);
	    $this->display();
	}
	
	//ajax修改角色入库
	public function ajaxEdit(){
	    if(IS_POST){
	        $model=D('role');
	        if($model->field('role_id,role_name')->create(I('post.'),2)){
	            if($model->save()!==false){
	                echo json_encode(array('ok'=>1));
	                die();
	            }
	        }
	        echo json_encode(array('ok'=>0,'error'=>$model->getError()));
	        
	    }
	}
	
	//ajax删除角色
	public function ajaxdel($role_id){
	    $model=M('role');
	    if($model->delete($role_id)){
	        echo json_encode(array('ok'=>1));
	    }else{
	        echo json_encode(array('ok'=>0,'error'=>$model->getError()));
	    }
	}
}