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

		$Hdb=D('reguser');
        $where['status']=array('egt',0);//没有被删除
        //搜索功能
        if(IS_POST){
            $name=I('post.name');
            if (empty($name) || $name=='请输入名称') {
                $this->error('请输入搜索的名称');
            }
            $where['name']=array('LIKE','%'.$name.'%');
        }
        
        /**************************************设定分页****************/
        $Wdb_num=$Hdb->where($where)->count();
        $tatalPage=$Wdb_num;//总的记录数
        $page=10;//每页显示的数量
        //调用分页公用函数
        $pageArr=getPage($Wdb_num,$page);
        $userList= $Hdb->where($where)->limit($pageArr[0],$pageArr[1])->order('id desc')->select();
        
        $this->assign('userList',$userList);
        $this->assign('page_str',$pageArr[2]);
		$this->display();
	}

	/*
	*友情链接列表 
	*
	*/

	public function linkIndex(){
		$this->assign(array('title'=>'友情链接管理列表','OneAuth'=>$this->OneAuth,'TowAuth'=>$this->TowAuth));

		$Hdb=D('furl');
        $where['status']=array('egt',0);//没有被删除
        //搜索功能
        if(IS_POST){
            $name=I('post.linkname');
            if (empty($name) || $name=='请输入名称') {
                $this->error('请输入搜索的名称');
            }
            $where['linkname']=array('LIKE','%'.$name.'%');
        }
        
        /**************************************设定分页****************/
        $Wdb_num=$Hdb->where($where)->count();
        $tatalPage=$Wdb_num;//总的记录数
        $page=10;//每页显示的数量
        //调用分页公用函数
        $pageArr=getPage($Wdb_num,$page);
        $linkList= $Hdb->where($where)->limit($pageArr[0],$pageArr[1])->order('id desc')->select();
        
        $this->assign('linkList',$linkList);
        $this->assign('page_str',$pageArr[2]);
		$this->display();
	}

	/*
	  *新增链接
	*/
	public function linkAdd(){

		if(IS_POST) {
			$model=D('Furl');
			if ($model->create(I('post.'),1)) {
				$model->time=time();
				if ($model->add()) {
					$this->ajaxReturn(array('status'=>1,'ok'=>'恭喜您，添加成功！'));
					die();
				}
			}
			$this->ajaxReturn(array('status'=>0,'error'=>$model->getError()));
		}
		
		$this->assign(array('title'=>'新增友情链接','OneAuth'=>$this->OneAuth,'TowAuth'=>$this->TowAuth));
		$this->display();
	}

	/***
	*编辑链接
	**/
	public function linkEdit(){
		$model=D('Furl');

		if(IS_POST) {
			$model=D('Furl');
			if ($model->create(I('post.'),2)) {
				$model->time=time();
				if ($model->save()) {
					$this->ajaxReturn(array('status'=>1,'ok'=>'恭喜您，更新成功！'));
					die();
				}
			}
			$this->ajaxReturn(array('status'=>0,'error'=>$model->getError()));
		}
		
		$this->assign(array('title'=>'编辑友情链接','OneAuth'=>$this->OneAuth,'TowAuth'=>$this->TowAuth));
		$id=I('get.id');
		if(!$id){
			$this->error('参数错误！');
		}
		//取出编辑的数据
		$editData=$model->find($id);
		$this->assign('editData',$editData);
		$this->display();

	}

	/**
	*	状态操作
	**/
	public function setStatus($method=null){
		$id=I('get.id');
        $model=I('get.mo');
        if(!$id || !$model){
            $this->error('参数错误');
        }
        switch(strtolower($method)){  //将参数同意转换为小写
        
            case "forbid":
                $this->forbid($model,array('id'=>$id));
                break;
            case "resumew":
                $this->resumew($model,array('id'=>$id));
                break;
            case "delete":
                $this->delete($model,array('id'=>$id));
                break;
            default:
                $this->error('非法参数');
        }
	}
}