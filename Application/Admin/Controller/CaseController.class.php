<?php
/*
 * 案例管理控制器
 * 
 * */

namespace Admin\Controller;
use Admin\Controller\BackController;

class CaseController extends BackController{
    
    /*
     * 案例管理列表
     * */
    public function index(){
        
        $this->assign(array('title'=>'案例管理列表','OneAuth'=>$this->OneAuth,'TowAuth'=>$this->TowAuth));
        
        //获取案例信息
        $caseModel=D('Wcase');
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
        $Wdb_num=$caseModel->where($where)->count();
        $tatalPage=$Wdb_num;//总的记录数
        $page=12;//每页显示的数量
        //调用分页公用函数
        $pageArr=getPage($Wdb_num,$page);
        $listImg=$caseModel->where($where)->limit($pageArr[0],$pageArr[1])->order('time desc')->select();
        $this->assign('listImg',$listImg);
        $this->assign('page_str',$pageArr[2]);
        $this->display();
    }
    
    /*
     * 新增案例
     * */
    public function add(){
        $this->assign(array('title'=>'新增案例','OneAuth'=>$this->OneAuth,'TowAuth'=>$this->TowAuth));
        $caseModel=D('Wcase');
        
        //ajax提交表单
        if(IS_POST){
            if($caseModel->create(I('post.'),1)){
                if($caseModel->add()){
                    $this->ajaxReturn(array('status'=>1,'msg'=>'添加成功'));
                    die();
                }
            }
            $this->ajaxReturn(array('status'=>0,'msg'=>$caseModel->getError()));
            return;
        }
        
        //获取设计师信息
        $work=D('Worker')->field('id,name')->where('type=0')->select();
        $this->assign('work',$work);
        $this->display();
    }
    
    /*
     * 案例编辑
     * */
    
    public function edit($id){
    
        $this->assign(array('title'=>'案例编辑','OneAuth'=>$this->OneAuth,'TowAuth'=>$this->TowAuth));
        $caseModel=D('Wcase');
        
        //ajax提交更新案例数据
        if(IS_POST){
            if($caseModel->create(I('post.'),2)){
                if($caseModel->save()!==false){
                    $this->ajaxReturn(array('status'=>1,'msg'=>'添加成功'));
                    die();
                }
            }
            $this->ajaxReturn(array('status'=>0,'msg'=>$caseModel->getError()));
            return;
        }
    
        //取出编辑的数据
        $res=$caseModel->find($id);
        $this->assign('res',$res);
        //获取案例图片表的数据
        $caseImg=M('wcaseimg');
        $resImg=$caseImg->field('id,img')->where('caseid='.$id)->select();
        $this->assign('resimg',$resImg);
        //获取设计师信息
        $work=D('Worker')->field('id,name')->where('type=0')->select();
        $this->assign('work',$work);
        $this->display();
    }
    
    /*
     * ajax删除图片
     * */
    public function ajaxDelImg($id){
        $caseImg=M('wcaseimg');
    
        //先删除硬盘上的
        $url=$caseImg->field('img')->find($id);
        $imgurl='./Public/Upload/'.$url['img'];
        if (unlink($imgurl)){
            if($caseImg->delete($id)){
                $this->ajaxReturn(array('status'=>1));
                die();
            }
        }
        $this->ajaxReturn(array('status'=>0));
    
    }
    
    /*
     * ajax删除案例
     * */
    public function ajaxCasedel($id){
    
        $caseModel=D('Wcase');
        if($caseModel->delete($id)){
            $this->ajaxReturn(array('status'=>'1'));
        }else{
            $this->ajaxReturn(array('status'=>'0','msg'=>'删除失败'));
        }
    }
}