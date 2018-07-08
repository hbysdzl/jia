<?php
//权限管理控制器
namespace Admin\Controller;
use Admin\Controller\BackController;
use Think\Page;
class AuthorityController extends BackController{
    
    //权限列表
    public function authList(){
          
        //设置标题
        $this->assign('title','权限列表');
         $authModel=M('auth');
        /**********************************设定分页***********/
        
         $total=$authModel->count();//获取总的记录数
        
         $pageModel=new Page($total,10);
         $pageModel->lastSuffix = false;
         $pageModel->rollPage=4;
         $pageModel->setConfig('prev','【上一页】');
         $pageModel->setConfig('next','【下一页】');
         $pageModel->setConfig('first','【首页】');
         $pageModel->setConfig('last','【末页】');
         
         $pageModel->setConfig('theme','%HEADER%，当前是%NOW_PAGE%/%TOTAL_PAGE% %FIRST% %UP_PAGE% %LINK_PAGE%  %DOWN_PAGE% %END%');
        
         $page=$pageModel->show();
         
         $auth=$authModel->limit($pageModel->firstRow,$pageModel->listRows)->order('sorting')->select();
         
         $this->assign('page',$page);
         $this->assign('auth',$auth);
        //根据用户权限显示菜单！
        $this->assign('OneAuth',$this->OneAuth);
        $this->assign('TowAuth',$this->TowAuth);
        $this->display();
    }
	
	//修改权限表单数据
	public function authEdit($auth_id){
		
		$authModel=M('auth');
		//获取一级权限
		$auth_1=$authModel->where('auth_level=0')->select();
		//获取当前的权限信息
		$auth_edit=$authModel->find($auth_id);
		$this->assign('auth_edit',$auth_edit);
		$this->assign('auth_1',$auth_1);
		$this->assign('OneAuth',$this->OneAuth);
        $this->assign('TowAuth',$this->TowAuth);
		$this->display();
	}
	//ajax接收更新数据入库
	public function ajaxUpdate(){
		if(IS_POST){
			$model=M('auth');
			if($data=$model->create(I('post.'),2)){
				if($data['auth_pid']==0){
					$data['auth_c']='';
					$data['auth_a']='';
					$data['auth_path']=$data['auth_id'];
					$data['auth_level']=0;
				}else{
					$data['auth_path']=$data['auth_pid'].'-'.$data['auth_id'];
					$data['auth_level']=1;
				}
				
				if($model->save($data)!==false){
					echo json_encode(array('ok'=>1));
					die();
				}
			}
			echo json_encode(array('ok'=>0,'error'=>$model->getError()));
		}
		
	}
	
	//添加权限表单数据
	public function authAdd(){
	    
	    //设置标题
	    $this->assign('title','添加权限');
	    
	    $authModel=M('auth');
	    //获取一级权限
	    $auth_1=$authModel->where('auth_level=0')->select();
	    
	    $this->assign('auth_1',$auth_1);
	    //根据用户权限显示菜单！
	    $this->assign('OneAuth',$this->OneAuth);
	    $this->assign('TowAuth',$this->TowAuth);
	    $this->display();
	}
	
	//ajax添加数据入库
	public  function ajaxAdd(){
	    
	    $model=M('auth');
	    if($data=$model->create(I('post.'),1)){
	        if($info=$model->add()){
	            if($data['auth_pid']==0){
	                $data['auth_c']='';
	                $data['auth_a']='';
	                $data['auth_path']=$info;
	                $data['auth_level']=0;
	            }else{
	                $data['auth_path']=$data['auth_pid'].'-'.$info;
	                $data['auth_level']=1;
	            }
	            $data['auth_id']=$info;
	            if($model->save($data)!==false){
	               echo json_encode(array('ok'=>1));
				   die();
	            }
	        }
	    }
	    echo json_encode(array('ok'=>0,'error'=>$model->getError()));
	}
	
	//ajax删除权限
	
	public function ajaxdel($auth_id){
	    $model=M('auth');
	    if($model->delete($auth_id)){
	        echo json_encode(array('ok'=>1));
	    }else{
	        echo json_encode(array('ok'=>0));
	    }
	}
}