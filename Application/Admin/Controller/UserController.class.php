<?php
namespace Admin\Controller;
use Admin\Controller\BackController;

class UserController extends BackController{
    
    //管理员列表
    public function userlis(){
		
		//根据用户权限显示菜单！	
		$this->assign('title','管理员列表');
		$this->assign('OneAuth',$this->OneAuth);
		$this->assign('TowAuth',$this->TowAuth);
        
		$userModel=M('admin');
        $user=$userModel->alias('a')->join('left join jia_role as b on a.role_id=b.role_id')->select();
        $this->assign('user',$user);
        $this->display();
    }
    
    //新增
    public function addUser(){
        
        //获取所有的角色
         $role=M('role')->select();
         $this->assign('role',$role);
        //根据用户权限显示菜单！
         $this->assign('title','新增管理员');
		$this->assign('OneAuth',$this->OneAuth);
		$this->assign('TowAuth',$this->TowAuth);
        $this->display();
    }
    //ajax提交数据
    public function ajaxAdd(){
        $adminModel=D('Login');
        if(IS_POST){
            if($adminModel->field('username,password,passwords,is_use,is_del,is_edit,role_id')->validate($adminModel->rules)->create(I('post.'),1)){
                if($adminModel->add()){
                    echo json_encode(array('ok'=>1));
                    die();
                }
            }
            echo json_encode(array('ok'=>0,'error'=>$adminModel->getError()));
        }
    }
	
	public function edit($admin_id){
		
	    //获取所有的角色
	    $role=M('role')->select();
	    $this->assign('role',$role);
		//根据用户权限显示菜单！
	    $this->assign('title','修改管理员信息');
		$this->assign('OneAuth',$this->OneAuth);
		$this->assign('TowAuth',$this->TowAuth);
		$ad=M('admin')->find($admin_id);
		$this->assign('ad',$ad);
		$this->display();
		
	}
    
	//ajax修改管理员信息
    public function ajaxEdit(){
        $adminModel=D('Login');
        if(IS_POST){
            if($data=$adminModel->field('id,username,password,passwords,is_use,is_del,is_edit,role_id')->validate($adminModel->rules)->create(I('post.'),2)){
				$data['password']=md5(C('MD5_PSW').$data['password']);
                if($adminModel->save($data)){
                    echo json_encode(array('ok'=>1));
                    die();
                }
            }
            echo json_encode(array('ok'=>0,'error'=>$adminModel->getError()));
        }
    }
    //ajax删除管理员信息
    public function ajaxdel($admin_id){
		$id=$admin_id;
        $adminModel=D('Login'); 
        $rs=$adminModel->where(array('id'=>array('eq',$id)))->delete();
        if($rs){
			M('AdminRole')->where('admin_id='.$id)->delete();
            echo json_encode(array('ok'=>1));
        }else {
            echo json_encode(array('ok'=>0));
        }
    }
}