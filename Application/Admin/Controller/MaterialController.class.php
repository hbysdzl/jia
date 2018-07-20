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
         $mstoreList=$Wdb->where($where)->limit($page_arr['0'],$page_arr[1])->order('id desc')->select();
         $this->assign('mstoreList',$mstoreList);
         $this->assign('page_str',$page_arr[2]);         
         $this->display();
    }

    /*
	**新增商店
    */
    public function add(){

    	 $this->assign(array('title'=>'新增商店','OneAuth'=>$this->OneAuth,'TowAuth'=>$this->TowAuth));
         $Mdb=D('Mstore');    
         if(IS_POST){
             if ($Mdb->create(I('post.'),1)) {
                 if ($Mdb->add()) {
                     $this->ajaxReturn(array('status'=>1,'ok'=>'恭喜您，新增成功！'));
                     die();
                 }
             }
             $this->ajaxReturn(array('status'=>0,'error'=>$Mdb->getError()));
         }   
         //取出建材分类、品牌，地区数据
         $res1=M('mtype')->field('id,name')->where(array('status'=>array('egt',0)))->select();//建材分类
         $res2=M('mbrand')->field('id,name')->where(array('status'=>array('egt',0)))->select();//建材品牌
         $res3=M('homezone')->field('id,zname')->where(array('status'=>array('egt',0)))->select();//建材分类
         $this->assign(array('res1'=>$res1,'res2'=>$res2,'res3'=>$res3));
    	 $this->display();
    }

    /***
    ***商店编辑
    ***/

    public function edit(){

        $this->assign(array('title'=>'编辑商店','OneAuth'=>$this->OneAuth,'TowAuth'=>$this->TowAuth));
        $Mdb=D('Mstore'); 
        if (IS_POST) {
            if ($Mdb->create(I('post.'),2)) {
               if ($Mdb->save()!==false) {
                   $this->ajaxReturn(array('status'=>1,'ok'=>'恭喜您，更新成功'));
                   die();
               }
            }
            $this->ajaxReturn(array('status'=>0,'error'=>$Mdb->getError()));
        }
        
        //获取编辑的数据       
        $id=I('get.id');
        
        if (!$id) {
            $this->error('参数错误');
        }
        $editData=$Mdb->find($id);
        $editData['f']=json_decode($editData['f'],true);
        $editData['b']=json_decode($editData['b'],true);
        $editData['z']=json_decode($editData['z'],true);
        $this->assign('editData',$editData);
        //取出建材分类、品牌，地区数据
        $res1=M('mtype')->field('id,name')->where(array('status'=>array('egt',0)))->select();//建材分类
        $res2=M('mbrand')->field('id,name')->where(array('status'=>array('egt',0)))->select();//建材品牌
        $res3=M('homezone')->field('id,zname')->where(array('status'=>array('egt',0)))->select();//建材分类
        $this->assign(array('res1'=>$res1,'res2'=>$res2,'res3'=>$res3));
        $this->display();
    }

 }