<?php
/*
 * 效果图管理模型
 * */

namespace Admin\Model;
use Think\Model;

class DrawModel extends Model{
    
     //自动（动态）验证
    public $dra = array( 
            array('name','require','效果图名称不得为空',1,'regex'), 
            array('room','require','居室不得为空',1,'regex'), 
            array('area','require','面积不得为空',1,'regex'),   
            array('cost','require','造价不得为空',1,'regex'),
            array('worker','require','请选择设计师',1,'regex'),
            array('ffg','require','请选择风格',1,'regex'),
            array('fhx','require','请选择户型',1,'regex'),
            array('fmj','require','请选择面积',1,'regex'),
            array('fzj','require','请选择造价',1,'regex'),
            
            );
    
    //添加之前的处理
    protected function _before_insert(&$data, $options){
        
        $data['time']=time();
        
        //上传封面图片
        $pic=UploadOne('img_url','draimg/');
        if($pic['img']==1){
            $data['img_url']=$pic['images'][0];
        }
        //处理设计师及ID
        $arr=explode('-',$data['worker']);
        $data['worker']=$arr[1];
        $data['workerid']=$arr[0];
    }
    
    //添加之后的处理
    protected  function _after_insert(&$data, $options){
        
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
            $draImg=M('drawimg');
            foreach ($pic_arr as $k=>$v){
                $res=UploadOne($k,'draimg/');
                if ($res['img']==1){
                    $ga['drawid']=$data['id'];
                    $ga['workerid']=$data['workerid'];
                    $ga['img']=$res['images'][0];
                    $draImg->add($ga);
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
        //上传封面图片
        $pic=UploadOne('img_url','draimg/');
        if($pic['img']!=1){
            //没有更新封面
            return ;
        }
        $data['img_url']=$pic['images'][0];
        //将旧的从硬盘上删除
        $url=$this->field('img_url')->find($options['where']['id']);
        $imgurl='./Public/Upload/'.$url['img_url'];
        unlink($imgurl);
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
            $draImg=M('drawimg');
            foreach ($pic_arr as $k=>$v){
                $res=UploadOne($k,'draimg/');
                if ($res['img']==1){
                    $ga['drawid']=$data['id'];
                    $ga['workerid']=$data['workerid'];
                    $ga['img']=$res['images'][0];
                    $draImg->add($ga);
                }
            }
        }
    }
    
    /*
     * 删除之前的处理
     * */
    protected function _before_delete($options){
        
        //删除封面硬盘上图片
        $url=$this->field('img_url')->find($options['where']['id']);
        $imgurl='./Public/Upload/'.$url['img_url'];
        unlink($imgurl);
    }
    
}