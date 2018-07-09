<?php
namespace Admin\Controller;
use Admin\Controller\BackController;
use Think\Page;
//设计师，施工队，风格分类控制器

class PersonnelController extends BackController{
    
    //设计师列表
    public function index(){
         //获取设计师信息
         $Wdb=M('worker');
         $where['type']=0;//设计师
         $where['status']=array('egt',0);//没有被删除
         
         //设置启用状态
         if(IS_GET){
             $id=I('get.id');
             if($id){
                 //查出当前状态判断
                 $n=$Wdb->field('status')->find($id);
                 if($n['status']==1){
                     $Wdb->where('id='.$id)->setField('status',0);
                 }else {
                     $Wdb->where('id='.$id)->setField('status',1);
                 } 
             }
             
         }
         
         //搜索功能
         if(IS_POST){
             $name=I('post.name');
             if (empty($name) || $name=='请输入设计师名称') {
                 $this->error('请输入搜索设计师的名称');
             }
             $where['name']=array('LIKE','%'.$name.'%');
         }
         
         /**************************************设定分页****************/
         $Wdb_num=$Wdb->where($where)->count();
         $tatalPage=$Wdb_num;//总的记录数
         $page=10;//每页显示的数量
         $page_w=new Page($Wdb_num, $page);
         $listRow=$page_w->listRows;
         $firstRow=$page_w->firstRow;
         //设置分页样式
         $page_w->setConfig('prev','【上一页】');
         $page_w->setConfig('next','【下一页】');
         $page_w->setConfig('first','【首页】');
         $page_w->setConfig('last','【末页】');
         $page_w->rollPage=5;
         $page_w->lastSuffix =false;
         $page_w->setConfig('theme','%HEADER% . 当前为%NOW_PAGE%/%TOTAL_PAGE% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
            
         $page_str=$page_w->show();
         
         $wk_name=$Wdb->where($where)->limit($firstRow,$listRow)->select();
         $this->assign('wk_name',$wk_name);
         $this->assign('page_str',$page_str);
        //设置标题
        $this->assign('title','设计师管理列表');
        //根据用户权限显示菜单！
        $this->assign('OneAuth',$this->OneAuth);
        $this->assign('TowAuth',$this->TowAuth);
        $this->display();
    }
    
    //新增设计师
    public function add(){
        
        //设置标题
        $this->assign('title','新增设计师');
        //根据用户权限显示菜单！
        $this->assign('OneAuth',$this->OneAuth);
        $this->assign('TowAuth',$this->TowAuth);
        
        
        //获取风格，空间
        $space=M('worktype')->field('id,name')->where('fid=1')->select();
        $style=M('worktype')->field('id,name')->where('fid=2')->select();
        $this->assign('space',$space);
        $this->assign('style',$style);
        $this->display();
    }
    
    //ajax添加设计师入库
    public function ajaxAdd(){
        //调用公共函数入库
        ajaxadd('workModel','Worker','add'); 
    }
    
    //修改设计师信息
    public function edit($id){
        
        //设置标题
        $this->assign('title','编辑设计师');
        //根据用户权限显示菜单！
        $this->assign('OneAuth',$this->OneAuth);
        $this->assign('TowAuth',$this->TowAuth);
        
        //获取风格，空间
        $space=M('worktype')->field('id,name')->where('fid=1')->select();
        $style=M('worktype')->field('id,name')->where('fid=2')->select();
        $this->assign('space',$space);
        $this->assign('style',$style);
        
        //获取当前编辑数据
        $workModel=D('Worker');
        $res=$workModel->find($id);
        //将空间和风格转回数组
        $res['space']=json_decode($res['space'],true);
        $res['style']=json_decode($res['style'],true);
        $this->assign('res',$res);
        $this->display();
    }
    
    //ajax修改设计师信息入库
    public function ajaxEdit(){
        //调用公共函数入库
        ajaxadd('workModel','Worker','save');
    }
    
    //ajax删除设计师&工长
    public function ajaxdel($id){
        $workModel=D('Worker');
        if($workModel->delete($id)){
            echo json_encode(array('ok'=>1));
        }
        
    }
    
    //工长管理列表
    public function gzindex(){
       
            //获取工长信息
            $Gdb=M('worker');
            $where['type']=1;//工长
            $where['status']=array('egt',0);//没有被删除
             
            //设置启用状态
            if(IS_GET){
                $id=I('get.id');
                if($id){
                    //查出当前状态判断
                    $n=$Gdb->field('status')->find($id);
                    if($n['status']==1){
                        $Gdb->where('id='.$id)->setField('status',0);
                    }else {
                        $Gdb->where('id='.$id)->setField('status',1);
                    }
                }
                 
            }
             
            //搜索功能
            if(IS_POST){
                $name=I('post.name');
                if (empty($name) || $name=='请输入工长名称') {
                    $this->error('请输入搜索的工长名称');
                }
                $where['name']=array('LIKE','%'.$name.'%');
            }
             
            /**************************************设定分页****************/
            $Wdb_num=$Gdb->where($where)->count();
            $tatalPage=$Wdb_num;//总的记录数
            $page=10;//每页显示的数量
            $page_w=new Page($Wdb_num, $page);
            $listRow=$page_w->listRows;
            $firstRow=$page_w->firstRow;
            //设置分页样式
            $page_w->setConfig('prev','【上一页】');
            $page_w->setConfig('next','【下一页】');
            $page_w->setConfig('first','【首页】');
            $page_w->setConfig('last','【末页】');
            $page_w->rollPage=5;
            $page_w->lastSuffix =false;
            $page_w->setConfig('theme','%HEADER% . 当前为%NOW_PAGE%/%TOTAL_PAGE% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
        
            $page_str=$page_w->show();
             
            $wk_name=$Gdb->where($where)->limit($firstRow,$listRow)->select();
            $this->assign('wk_name',$wk_name);
            $this->assign('page_str',$page_str);
            //设置标题
            $this->assign('title','工长管理列表');
            //根据用户权限显示菜单！
            $this->assign('OneAuth',$this->OneAuth);
            $this->assign('TowAuth',$this->TowAuth);
            $this->display();
        
    }
    
    /*
     * 新增工长 
     * */
    public function gzadd(){
        
        
        //设置标题
        $this->assign('title','新增工长');
        //根据用户权限显示菜单！
        $this->assign('OneAuth',$this->OneAuth);
        $this->assign('TowAuth',$this->TowAuth);
        
        //获取风格，空间
        $space=M('worktype')->field('id,name')->where('fid=1')->select();
        $style=M('worktype')->field('id,name')->where('fid=2')->select();
        $this->assign('space',$space);
        $this->assign('style',$style);
        $this->display();
    }
    
    /*
     * ajax添加工长入库
     * */
    public function ajaxgzAdd(){
        
        //调用公共函数
       ajaxadd('workModel','Worker','add'); 
    }
    
    /*
     * 工长编辑
     * */
    public function gzedit($id){
    
        //设置标题
        $this->assign('title','编辑工长');
        //根据用户权限显示菜单！
        $this->assign('OneAuth',$this->OneAuth);
        $this->assign('TowAuth',$this->TowAuth);
    
        //获取风格，空间
        $space=M('worktype')->field('id,name')->where('fid=1')->select();
        $style=M('worktype')->field('id,name')->where('fid=2')->select();
        $this->assign('space',$space);
        $this->assign('style',$style);
    
        //获取当前编辑数据
        $workModel=D('Worker');
        $res=$workModel->find($id);
        //将空间和风格转回数组
        $res['space']=json_decode($res['space'],true);
        $res['style']=json_decode($res['style'],true);
        $this->assign('res',$res);
        $this->display();
    }
        
    /*
     * ajax编辑工长信息入库
     * */
    public function ajaxgzEdit(){
        //调用公共函数入库
        ajaxadd('workModel','Worker','save');
    }
    
    /*
     * 风格空间分类管理
     * */
    public function styleIndex(){
        
        //设置标题
        $this->assign('title','风格空间管理列表');
        //根据用户权限显示菜单！
        $this->assign('OneAuth',$this->OneAuth);
        $this->assign('TowAuth',$this->TowAuth);
        
        //获取分类信息
        $Tdb=M('worktype');
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

        $wk_name=$Tdb->where($where)->limit($pageArr[0],$pageArr[1])->order('id desc')->select();
        //获取父ID及名称
        foreach ($wk_name as $k=>$v){
            if ($v['fid']==0){
                $wk_name[$k]['fname']="顶级";
            }else{
                //取出它的父级名称
                $res=$Tdb->field('name')->find($v['fid']);
                $wk_name[$k]['fname']=$res['name'];
            }
        }
       
        $this->assign('wk_name',$wk_name);
        $this->assign('page_str',$pageArr[2]);
        $this->display();
    }
    
    /*
     * 风格空间的添加
     * */
    public function styleAdd(){
        
        
        $this->assign(array('title'=>'新增风格空间','OneAuth'=>$this->OneAuth,'TowAuth'=>$this->TowAuth));
        //获取顶级分类
        $topList=M('worktype')->where('fid=0')->select();
        $this->assign('topList',$topList);
        $this->display();
    }
    
    /*
     * ajax提交风格空间入库
     * */
    public function ajaxStyleAdd(){
        //调用公共函数
        ajaxadd('styleModel','worktype','add');
    }
    
    /*
     * 风格空间的修改
     * */
    public function styleEdit($id){
        $this->assign(array('title'=>'修改风格空间','OneAuth'=>$this->OneAuth,'TowAuth'=>$this->TowAuth));
        
        //获取顶级分类
        $model=M('worktype');
        $topList=$model->where('fid=0')->select();
        $this->assign('topList',$topList);
        
        //取出要修改的数据
        $editData=$model->find($id);
        
        $this->assign('editData',$editData);
        $this->display();
    }
     
    /*
     * ajax修改风格空间入库
     * */
    public function ajaxStyleEdit(){
        //调用公共函数
        ajaxadd('styleModel','worktype','save');
    }
    
    
    /*
     * ajax删除风格空间分类
     * */
    
    public function ajaxStyledel($id){
        $model=M('worktype');
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
                
            }
        }
        return implode(',',$arr);
    }
}