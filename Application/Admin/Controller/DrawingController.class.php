<?php
/*
 * 效果图管理控制器
 *
 * */

namespace Admin\Controller;
use Think\Controller;

class DrawingController extends BackController{

    /*
     * 效果图分类列表
     * */
    public function dindex(){
        $this->assign(array('title'=>'效果图分类管理','OneAuth'=>$this->OneAuth,'TowAuth'=>$this->TowAuth));
        //获取分类信息
        $Tdb=M('drawtype');
        $where['status']=array('egt',0);//没有被删除       
        $where['status']=array('egt',0);//没有被删除
        //设置启用状态
        if(IS_GET){
            $id=I('get.id');
            if($id){
                //查出当前状态判断
                $n=$Tdb->field('status')->find($id);
                if($n['status']==1){
                    $Tdb->where('id='.$id)->setField('status',0);
                }else {
                    $Tdb->where('id='.$id)->setField('status',1);
                }
            }
             
        }
         
     

        //搜索功能
        if(IS_POST){
            $name=I('post.name');
            if (empty($name) || $name=='请输入名称') {
                $this->error('请输入搜索的名称');
            }
            $where['name']=array('LIKE','%'.$name.'%');
        }

        /**************************************设定分页****************/
        $Wdb_num=$Tdb->where($where)->count();
        $tatalPage=$Wdb_num;//总的记录数
        $page=10;//每页显示的数量
        //调用分页公用函数
        $pageArr=getPage($Wdb_num,$page);
        $draw_name=$Tdb->where($where)->limit($pageArr[0],$pageArr[1])->order('id desc')->select();
        //获取父ID及名称
        foreach ($draw_name as $k=>$v){
            if ($v['fid']==0){
                $draw_name[$k]['fname']="顶级";
            }else{
                //取出它的父级名称
                $res=$Tdb->field('name')->find($v['fid']);
                $draw_name[$k]['fname']=$res['name'];
            }
        }

        $this->assign('draw_name',$draw_name);
        $this->assign('page_str',$pageArr[2]);
        $this->display();
    }

    /*
     * 新增效果图分类
     * */
    public function dadd(){
        $this->assign(array('title'=>'添加效果图分类','OneAuth'=>$this->OneAuth,'TowAuth'=>$this->TowAuth));

        //获取顶级分类
        $topList=M('drawtype')->where('fid=0')->select();
        $this->assign('topList',$topList);
        $this->display();

    }
    
    /*
     * ajax提交分类入库
     * */
    public function ajaxdAdd(){
        //调用公共函数
        ajaxadd('drawModel','drawtype','add');
    }

    /*
     * 效果图分类的修改
     * */
    public function dedit($id){
        $this->assign(array('title'=>'修改效果图分类','OneAuth'=>$this->OneAuth,'TowAuth'=>$this->TowAuth));

        //获取顶级分类
        $model=M('drawtype');
        $topList=$model->where('fid=0')->select();
        $this->assign('topList',$topList);

    
        //取出要修改的数据
        $editData=$model->find($id);
    
        $this->assign('editData',$editData);
        $this->display();
        //取出要修改的数据
        $editData=$model->find($id);

        $this->assign('editData',$editData);
        $this->display();
    }

    /*
     * ajax修改效果图分类入库
     * */
    public function ajaxdEdit(){
        //调用公共函数
        ajaxadd('drawModel','drawtype','save');
    }

    
    
    /*
     * ajax删除效果图分类
     * */

    public function ajaxDdel($id){
        $model=M('drawtype');
        if($model->delete($id)){
            //将其子分类删除
            $list=$model->field('id,fid')->select();
            $strId=$this->getChild($list, $id);
            if ($strId){
                $model->delete($strId);
            }
            echo json_encode(array('ok'=>1));
        }
    }

    /*
     * 递归获取当前分类的子分类
     * */
    private function getChild($data,$pid){
        static $arr=array();
        foreach ($data as $k=>$v){
            if ($v['fid']==$pid){
                $arr[]=$v[id];
                $this->getChild($data, $v['id']);
                $this->getChild($data, $v['id']);
            }
        }
        return implode(',',$arr);
    }

    /*
     * 效果图管理列表
     * */
    public function index(){
        $this->assign(array('title'=>'效果图管理列表','OneAuth'=>$this->OneAuth,'TowAuth'=>$this->TowAuth));


        //获取分类信息
        $Tdb=D('Draw');
        $where['status']=array('egt',0);//没有被删除
        $where['xuan']=0;//宣传的设计师作品不展示

        //搜索功能
        if(IS_POST){
            $name=I('post.name');
            if (empty($name) || $name=='请输入名称') {
                $this->error('请输入搜索的名称');
            }
            $where['name']=array('LIKE','%'.$name.'%');
        }

        /**************************************设定分页****************/
        $Wdb_num=$Tdb->where($where)->count();
        $tatalPage=$Wdb_num;//总的记录数
        $page=12;//每页显示的数量
        //调用分页公用函数

        $pageArr=getPage($Wdb_num,$page); 
        $pageArr=getPage($Wdb_num,$page);
        $listImg=$Tdb->where($where)->limit($pageArr[0],$pageArr[1])->order('id desc')->select();
        $this->assign('listImg',$listImg);
        $this->assign('page_str',$pageArr[2]);
        $this->display();
    }

    /*
     * 新增效果图
     * */
    public function add(){
        $this->assign(array('title'=>'新增效果图','OneAuth'=>$this->OneAuth,'TowAuth'=>$this->TowAuth));
        $drawModel=D('Draw');
        if(IS_POST){
           if($drawModel->validate($drawModel->dra)->create(I('post.'),1)){
               if($drawModel->add()){
                   $this->success('恭喜您！添加成功',U('index'));
                   die();
               }
           }
           $this->error($drawModel->getError());
           return;
        }
        //取出风格选项 4类
        $res1 = M("drawtype")->field('id,name')->where('fid=1')->select();
        $res2 = M("drawtype")->field('id,name')->where('fid=2')->select();
        $res3 = M("drawtype")->field('id,name')->where('fid=3')->select();
        $res4 = M("drawtype")->field('id,name')->where('fid=4')->select();
        $this->assign(array('res1'=>$res1,'res2'=>$res2,'res3'=>$res3,'res4'=>$res4));

        //获取设计师信息
        $work=D('Worker')->field('id,name')->where('type=0')->select();
        $this->assign('work',$work);
        $this->display();
    }
    
    /*
     * 效果图的修改
     * */
    
    public function edit($id){
        
        $this->assign(array('title'=>'效果图修改','OneAuth'=>$this->OneAuth,'TowAuth'=>$this->TowAuth));
        $draModel=D('Draw');
        if(IS_POST){
            if($draModel->validate($draModel->dra)->create(I('post.'),2)){
                if($draModel->save()!==false){
                    $this->success('恭喜您！修改成功',U('index'));
                    die();
                }
            }
            $this->error($draModel->getError());
            return;
        }
        
        //取出编辑的数据
        $res=$draModel->find($id);
        $this->assign('res',$res);
        //获取效果图图片表的数据
        $draimg=M('drawimg');
        $resImg=$draimg->field('id,img')->where('drawid='.$id)->select();
        $this->assign('resimg',$resImg);
        //获取设计师信息
        $work=D('Worker')->field('id,name')->where('type=0')->select();
        $this->assign('work',$work);
        //取出风格选项 4类
        $res1 = M("drawtype")->field('id,name')->where('fid=1')->select();
        $res2 = M("drawtype")->field('id,name')->where('fid=2')->select();
        $res3 = M("drawtype")->field('id,name')->where('fid=3')->select();
        $res4 = M("drawtype")->field('id,name')->where('fid=4')->select();
        $this->assign(array('res1'=>$res1,'res2'=>$res2,'res3'=>$res3,'res4'=>$res4));
        
        $this->display();
    }
    
    /*
     * ajax删除图片
     * */
    public function ajaxDelImg($id){
        $draimg=M('drawimg');
        
        //先删除硬盘上的
        $url=$draimg->field('img')->find($id);
        $imgurl='./Public/Upload/'.$url['img'];
        if (unlink($imgurl)){
            if($draimg->delete($id)){
                echo json_encode(array('ok'=>1));
            }
        }
        
    }
    
    /*
     * 状态修改
     * */
    public function changeStatus($method=null){
        
        $id=array_unique((array)I('id'));//将字符串转换为数组
        $id=is_array($id)? implode(',',$id):$id;
        
        if (empty($id)){
            $this->error('请选择要操作的记录');
        }
        
        switch (strtolower($method)){//将url参数转换为小写
            case 'forbidw':
                $this->forbid('draw',array('id'=>$id));
                break;
            case 'resumew':
                $this->resumew('draw',array('id'=>$id));
                break;
            case 'deletew':
                $this->delete('draw',array('id'=>$id));
                break;
            default:
                $this->error('参数非法');
        }
        
    }
    
    /*
     * ajax删除效果图
     * */
    public function ajaxDradel($id){
        
        $draModel=D('Draw');
        if($draModel->delete($id)){
            echo json_encode(array('ok'=>1));
        }else{
            echo json_encode(array('ok'=>0));
        }
    }

}