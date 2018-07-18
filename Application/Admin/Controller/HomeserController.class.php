<?php
/*
 * 家居服务人员/地区/工种分类管理控制器
 * 
 * */

namespace Admin\Controller;
use Admin\Controller\BackController;

class HomeserController extends BackController{
    
    /*
     * 服务人员列表
     * */
    public function index(){
        
        $this->assign(array('title'=>'家居服务人员列表','OneAuth'=>$this->OneAuth,'TowAuth'=>$this->TowAuth));
        
        $Hdb=D('homeman');
        $where['status']=array('egt',0);//没有被删除
        //搜索功能
        if(IS_POST){
            $name=I('post.name');
            if (empty($name) || $name=='请输入人员名称') {
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
        $HomList= $Hdb->where($where)->limit($pageArr[0],$pageArr[1])->order('id desc')->select();
        
        $this->assign('HomList',$HomList);
        $this->assign('page_str',$pageArr[2]);
        $this->display();
    }
    
    /*
     * 新增服务人员
     * */
    public function add(){
        $this->assign(array('title'=>'新增服务人员','OneAuth'=>$this->OneAuth,'TowAuth'=>$this->TowAuth));
        
        $model=D('Homeman');
        if(IS_POST){
            if($model->create(I('post.'),1)){
                if($model->add()){
                    $this->ajaxReturn(array('status'=>1,'ok'=>'恭喜你，新增成功！'));
                    die();
                }
            }
            $this->ajaxReturn(array('status'=>0,'error'=>$model->getError()));
            
        }
        //获取地区/工种分类
        $res1=M('homezone')->field('id,zname')->where(array('status'=>array('egt',0)))->select();
        $res2=M('homepro')->field('id,gname')->where(array('status'=>array('egt',0)))->select();
        $this->assign(array('res1'=>$res1,'res2'=>$res2));
        $this->display();
    }
    
    /*
     * 编辑服务人员
     * */
    public function edit(){
        $this->assign(array('title'=>'服务人员修改','OneAuth'=>$this->OneAuth,'TowAuth'=>$this->TowAuth));
        $model=D('Homeman');

        if(IS_POST) {
            if($data=$model->create(I('post.'),2)){
                if($model->save()!==false){
                    $this->ajaxReturn(array('status'=>1,'ok'=>'恭喜您，修改成功！'));
                    die();
                }
            }
            $this->ajaxReturn(array('status'=>0,'error'=>$model->getError()));
        }
        //获取地区/工种分类
        $res1=M('homezone')->field('id,zname')->where(array('status'=>array('egt',0)))->select();
        $res2=M('homepro')->field('id,gname')->where(array('status'=>array('egt',0)))->select();
        $this->assign(array('res1'=>$res1,'res2'=>$res2));
        
        //获取当前编辑的数据
        $id=I('get.id');
         if(!$id){
            $this->error('非法操作！');
        }
        $editData=$model->find($id);
        //处理json格式的元素为数组
        $editData['zarr']=json_decode($editData['zarr'],true);
        $editData['hparr']=json_decode($editData['hparr'],true);
        $this->assign('editData',$editData);
        $this->display();
    }
    
    /*
     * 地区管理列表
     * */
    public function zoneIndex(){
        
        $this->assign(array('title'=>'地区管理列表','OneAuth'=>$this->OneAuth,'TowAuth'=>$this->TowAuth));
        //获取分类信息
        $Hdb=D('homezone');
        $where['status']=array('egt',0);//没有被删除
        //搜索功能
        if(IS_POST){
            $name=I('post.zname');
            if (empty($name) || $name=='请输入名称') {
                $this->error('请输入搜索的名称');
            }
            $where['zname']=array('LIKE','%'.$name.'%');
        }
        
        /**************************************设定分页****************/
        $Wdb_num=$Hdb->where($where)->count();
        $tatalPage=$Wdb_num;//总的记录数
        $page=10;//每页显示的数量
        //调用分页公用函数
        $pageArr=getPage($Wdb_num,$page);
        $HomList= $Hdb->where($where)->limit($pageArr[0],$pageArr[1])->order('id desc')->select();
        //获取父ID及名称
        foreach ($HomList as $k=>$v){
            if ($v['fid']==0){
                $HomList[$k]['fname']="顶级";
            }else{
                //取出它的父级名称
                $res=$Hdb->field('zname')->find($v['fid']);
                $HomList[$k]['fname']=$res['zname'];
            }
        }
        
        $this->assign('HomList',$HomList);
        $this->assign('page_str',$pageArr[2]);
        $this->display();
    }
    
    /*
     * 添加地区
     * */
    public function zoneadd(){
        $Hdb=D('homezone');
        if(IS_POST){
            if($Hdb->create(I('post.'))){
                if($Hdb->add()){
                    $this->ajaxReturn(array('status'=>1));
                    die();
                }
            }
            $this->ajaxReturn(array('status'=>0,'error'=>$Hdb->getError()));
        }
        $this->assign(array('title'=>'新增地区','OneAuth'=>$this->OneAuth,'TowAuth'=>$this->TowAuth));
        //取出父级
        $fid=$Hdb->where('fid=0')->select();
        $this->assign('fid',$fid);
        $this->display();
    }
    
    /*
     * 编辑地区
     * 
     * */
    
    public function zoneedit(){
        $Hdb=D('homezone');
        
        if(IS_POST){
            if($Hdb->create(I('post.'),2)){
                if($Hdb->save()!==false){
                    $this->ajaxReturn(array('status'=>1));
                    die();
                }
            }
            $this->ajaxReturn(array('status'=>0,'error'=>$Hdb->getError()));
        }
        
        $this->assign(array('title'=>'编辑地区','OneAuth'=>$this->OneAuth,'TowAuth'=>$this->TowAuth));
        $id=I('get.id');
        if(!$id){
            $this->error('参数错误');
        }
        //取出当前修改的数据
        $dataEd=$Hdb->find($id);
        $this->assign('dataEd',$dataEd);
        //取出父级
        $fid=$Hdb->where('fid=0')->select();
        $this->assign('fid',$fid);
        $this->display();
    }
    
    /*
     * 状态修改
     * 
     * */
    public  function setStatus($method=null){
        
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
    
    /*
     * 工种管理列表
     * */
    public function homeProIndex(){
        
        $this->assign(array('title'=>'工种管理列表','OneAuth'=>$this->OneAuth,'TowAuth'=>$this->TowAuth));
        //获取分类信息
        $Hdb=D('homepro');
        $where['status']=array('egt',0);//没有被删除
        //搜索功能
        if(IS_POST){
            $name=I('post.gname');
            if (empty($name) || $name=='请输入名称') {
                $this->error('请输入搜索的名称');
            }
            $where['gname']=array('LIKE','%'.$name.'%');
        }
        
        /**************************************设定分页****************/
        $Wdb_num=$Hdb->where($where)->count();
        $tatalPage=$Wdb_num;//总的记录数
        $page=10;//每页显示的数量
        //调用分页公用函数
        $pageArr=getPage($Wdb_num,$page);
        $HomList= $Hdb->where($where)->limit($pageArr[0],$pageArr[1])->order('id desc')->select();
        //获取父ID及名称
        foreach ($HomList as $k=>$v){
            if ($v['fid']==0){
                $HomList[$k]['fname']="顶级";
            }else{
                //取出它的父级名称
                $res=$Hdb->field('gname')->find($v['fid']);
                $HomList[$k]['fname']=$res['gname'];
            }
        }
        
        $this->assign('HomList',$HomList);
        $this->assign('page_str',$pageArr[2]);
        $this->display();
    }
    
    /**
     * 新增工种
     * 
     * */
    public function homeproAdd(){
        $Hdb=D('homepro');
        if(IS_POST){
            if($Hdb->create(I('post.'),1)){
                if($Hdb->add()){
                    $this->ajaxReturn(array('status'=>1));
                    die();
                }
            }
            $this->ajaxReturn(array('status'=>0,'error'=>$Hdb->getError()));
        }
       
        $this->assign(array('title'=>'新增工种','OneAuth'=>$this->OneAuth,'TowAuth'=>$this->TowAuth));
        //取出父级
        $fid=$Hdb->where('fid=0')->select();
        $this->assign('fid',$fid);
        $this->display();
    }
    
    /*
     * 编辑工种
     * 
     * */
    public function homeproedit(){
        
        $Hdb=D('homepro');     
        if(IS_POST){
            if($Hdb->create(I('post.'),2)){
                if($Hdb->save()!==false){
                    $this->ajaxReturn(array('status'=>1));
                    die();
                }
            }
            $this->ajaxReturn(array('status'=>0,'error'=>$Hdb->getError()));
        }
        
        $this->assign(array('title'=>'编辑工种','OneAuth'=>$this->OneAuth,'TowAuth'=>$this->TowAuth));
        $id=I('get.id');
        if(!$id){
            $this->error('参数错误');
        }
        //取出当前修改的数据
        $dataEd=$Hdb->find($id);
        $this->assign('dataEd',$dataEd);
        //取出父级
        $fid=$Hdb->where('fid=0')->select();
        $this->assign('fid',$fid);
        $this->display();
    }    
}