<?php
/*
 * 效果图管理模型
 * */

namespace Admin\Model;
use Think\Model;

class WcaseModel extends Model{
    
     //自动验证
    protected $_validate=array( 
            array('name','require','案例名称不得为空',1,'regex'), 
            array('room','require','居室不得为空',1,'regex'), 
            array('area','require','面积不得为空',1,'regex'),
            array('lev','require','请输入等级',1,'regex'),
            array('worker','require','请选择设计师',1,'regex'),
            );
    
    //添加之前的处理
    protected function _before_insert(&$data, $options){

        $data['time']=time();
        //处理设计师及ID
        $arr=explode('-',$data['worker']);
        $data['worker']=$arr[1];
        $data['workerid']=$arr[0];
    }
    
    //添加之后的处理
    protected  function _after_insert(&$data, $options){
        
        //批量上传图片到案例图片表
        if (hasImage('pics')){
            //将批量上传的数组改造为单个文件上传
            $pics=array();
            foreach ($_FILES['pics']['name'] as $k=>$v){
                $pics['name']=$v;
                $pics['type']=$_FILES['pics']['tmp_name'][$k];
                $pics['tmp_name']=$_FILES['pics']['tmp_name'][$k];
                $pics['error']=$_FILES['pics']['error'][$k];
                $pics['size']=$_FILES['pics']['size'][$k];
                $pic_arr[]=$pics;
            }
            //将处理好的二维数组赋给$_FILES;
            $_FILES=$pic_arr;
            //循环添加入库
            $caseImg=M('wcaseimg');
            foreach ($pic_arr as $k=>$v){
                $res=UploadOne($k,'draimg/');
                if ($res['img']==1){
                    $ga['caseid']=$data['id'];
                    $ga['workerid']=$data['workerid'];
                    $ga['img']=$res['images'][0];
                    $caseImg->add($ga);
                }
            }
        }
    }
    
    //修改之前的处理
    protected function _before_update(&$data, $options){ 
        //处理设计师及ID
        $arr=explode('-',$data['worker']);
        $data['worker']=$arr[1];
        $data['workerid']=$arr[0];
    }
    
    //修改之后的处理
    protected function _after_update(&$data, $options){
        //批量上传图片到效果图图片表
        if (hasImage('pics')){
            //将批量上传的数组改造为单个文件上传
            $pics=array();
            foreach ($_FILES['pics']['name'] as $k=>$v){
                $pics['name']=$v;
                $pics['type']=$_FILES['pics']['tmp_name'][$k];
                $pics['tmp_name']=$_FILES['pics']['tmp_name'][$k];
                $pics['error']=$_FILES['pics']['error'][$k];
                $pics['size']=$_FILES['pics']['size'][$k];
                $pic_arr[]=$pics;
            }
            //将处理好的二维数组赋给$_FILES;
            $_FILES=$pic_arr;
            //循环添加入库
            $caseImg=M('wcaseimg');
            foreach ($pic_arr as $k=>$v){
                $res=UploadOne($k,'draimg/');
                if ($res['img']==1){
                    $ga['caseid']=$data['id'];
                    $ga['workerid']=$data['workerid'];
                    $ga['img']=$res['images'][0];
                    $caseImg->add($ga);
                }
            }
        }
    }
    
    
  /*   * 删除之前的处理
     * 
     */
    protected function _before_delete($options){
        
        //删除图片表中对应的图片    
        $caseImg=M('wcaseimg');
        $resImg=$caseImg->field('img')->where('caseid='.$options['where']['id'])->select();
        
        foreach ($resImg as $v){
            deleteImage($v);//公共函数
        }
        $caseImg->where('caseid='.$options['where']['id'])->delete();
        
    }
    
    
}