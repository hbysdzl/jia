<?php
//文档分类模型

namespace Admin\Model;
use Think\Model;

class CategoryModel extends Model{
    
    //获取分类数据
    public function getCate($cat_title){
      if(isset($cat_title)){
          $result=$this->where(array('title'=>array('like','%'.$cat_title.'%')))->select();
      }else {
          $result=$this->select();
      }
     
      return $this->tree($result,$pid=0,$level=0);
    }
    
    //转换无限极分类
    protected function tree($arr,$pid=0,$level=0){
        static  $cat_arr=array();
        foreach ($arr as $k=>$v){
            if($v['pid']==$pid){
                $v['level']=$level;
                $cat_arr[]=$v;
                
                $this->tree($arr,$v['id'],$level+1);
            }
        }
        return $cat_arr;
    }
    
    //允许创建的字段
    protected $insertFields=array('pid','title','name','allow_publish','check','display','reply','sort','list_row','meta_title','keywords','description','template_index','template_lists','template_detail','template_edit','status');
    
    //允许修改提交的字段
    protected $updateFields=array('id','pid','title','name','allow_publish','check','display','reply','sort','list_row','meta_title','keywords','description','template_index','template_lists','template_detail','template_edit','status');
    
    //自动验证
    protected  $_validate=array(
            array('title','require','分类名称不能为空',1,'regex',3),
            array('title',' ','该分类名称已存在，请重新输入',1,'unique',3),
            array('name','require','分类标识不能为空',1,'regex',3),
            array('name',' ','该分类标识已存在，请重新输入',1,'unique',3),
            array('list_row','1,20','列表行数必须在1~20之间',1,'between',3),
            
    );
    
    //添加之前
    protected function _before_insert(&$data, $options){
           $model_arr=I('post.model');
           $type_arr=I('post.type');
           //将其转换为字符串插入数据库
           $data['model']=implode(',',$model_arr);
           $data['type']=implode(',',$type_arr);
           $data['create_time']=time();
    }
    
    //修改之前
    protected function _before_update(&$data, $options){
        $model_arr=I('post.model');
        $type_arr=I('post.type');
        //将其转换为字符串插入数据库
        $data['model']=implode(',',$model_arr);
        $data['type']=implode(',',$type_arr);
        $data['update_time']=time();
    }
    
}