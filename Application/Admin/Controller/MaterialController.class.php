<?php 

/*
**家具建材管理控制器
*/
 
 namespace Admin\Controller;
 use Admin\Controller\BackController;

 class MaterialController extends BackController{

 	/*
	**商店管理列表
 	*/
 	 
    public function index(){
    	//根据用户权限显示菜单！
         $this->assign(array('title'=>'建材商店管理列表','OneAuth'=>$this->OneAuth,'TowAuth'=>$this->TowAuth));
         $Wdb=D('mstore');
         $where['status']=array('egt',0);//没有被删除
          
         //搜索功能
         if(IS_POST){
             $name=I('post.name');
             if (empty($name) || $name=='请输入名称') {
                 $this->error('请输入需要查找的名称');
             }
             $where['name']=array('LIKE','%'.$name.'%');
         }        
         /**************************************设定分页****************/
         $Wdb_num=$Wdb->where($where)->count();
         $tatalPage=$Wdb_num;//总的记录数
         $page=10;//每页显示的数量
         $page_arr=getPage($Wdb_num,$page);  //调用公共函数分页       
         $mstoreList=$Wdb->where($where)->limit($page_arr['0'],$page_arr[1])->select();
         $this->assign('mstoreList',$mstoreList);
         $this->assign('page_str',$page_arr[2]);         
         $this->display();
    }

    /*
	**新增商店
    */
    public function add(){

    	 $this->assign(array('title'=>'新增商店','OneAuth'=>$this->OneAuth,'TowAuth'=>$this->TowAuth));
    	 $this->display();
    }

 }