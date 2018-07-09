<?php
//文章类别控制器

namespace Admin\Controller;
use Admin\Controller\BackController;

class CategoryController extends BackController{
    
    //分类列表
    public function cateList(){
        
         //搜索功能
         if(IS_POST){
             $cat_title=I('post.cat_title');
         }
        
         //获取所有分类数据
         $catModel=D('Category');
         $num=$catModel->count();
         $cat_arr=$catModel->getCate($cat_title);
         $this->assign('num',$num);
         $this->assign('cat_arr',$cat_arr);
        //设置标题
        $this->assign('title','文档类别管理');
        //根据用户权限显示菜单！
        $this->assign('OneAuth',$this->OneAuth);
        $this->assign('TowAuth',$this->TowAuth);
        $this->display();
    }
    
    //添加分类表单数据
    public function add(){
        
        //获取所有一级分类
        $one_cat=D('Category')->where('pid=0')->select();
        $this->assign('one_cat',$one_cat);
        //设置标题
        $this->assign('title','添加分类');
        //根据用户权限显示菜单！
        $this->assign('OneAuth',$this->OneAuth);
        $this->assign('TowAuth',$this->TowAuth);
        $this->display();
    }
    
    //ajax添加分类入库
    public function ajaxAdd(){
       
        if(IS_POST){
            $catModel=D('Category');
            if($data=$catModel->create(I('post.'),1)){
                if($catModel->add()){
                    echo json_encode(array('ok'=>1));
                    die();
                }
            }
            echo json_encode(array('ok'=>0,'error'=>$catModel->getError()));
        }
    }
    
    //修改分类表单数据
    public function edit($id){
        
          $catModel=D('Category');
          //获取顶级分类数据
          $one_cat=$catModel->where('pid=0')->select();
         //获取当前的分类数据
          $cat_arr=$catModel->find($id);
          
        
        $this->assign('one_cat',$one_cat); 
        $this->assign('cat_arr',$cat_arr);
        //设置标题
        $this->assign('title','修改分类');
        //根据用户权限显示菜单！
        $this->assign('OneAuth',$this->OneAuth);
        $this->assign('TowAuth',$this->TowAuth);
        $this->display();
    }
    
    //ajax修改更新入库
    public function ajaxEdit(){
        
        if(IS_POST){
            $catModel=D('Category');
            if($catModel->create(I('post.'),2)){
                if($catModel->save()!==false){//save方法的返回值是影响的记录数，如果返回false则表示更新出错，因此一定要用恒等来判断是否更新失败。
                    
                    echo json_encode(array('ok'=>1));
                    die();
                }
            }
            echo json_encode(array('ok'=>0,'error'=>$catModel->getError()));
        }
    }
    
    //ajax删除类别
    public function ajaxdel($id){
        
        $catModel=D('Category');
        if ($catModel->delete($id)){ //delete方法的返回值是删除的记录数，如果返回值是false则表示SQL出错，返回值如果为0表示没有删除任何数据。
            echo json_encode(array('ok'=>1));
            die();
        }
        echo json_encode(array('ok'=>0,'error'=>$catModel->getError()));
    }
}