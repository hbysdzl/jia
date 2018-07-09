<?php
/*
 * 工长设计师管理模型
 * */
namespace Admin\Model;
use Think\Model;
use Upload;

class WorkerModel extends Model{
    
   //添加表单自动验证
   protected $_validate=array(
       array('name','require','请输入名称',1,'regex',3),
   );
   
   //添加之前
      protected function _before_insert(&$data, $options){
       
       //将空间和风格处理为json格式存储  
       $data['space']=json_encode($data['space']);
       $data['style']=json_encode($data['style']);
       $data['time']=time();
       
       //处理图片上传
       $pic=UploadOne('photo','Worker/');
       if($pic['img']==1){
           $data['photo']=$pic['images'][0];
       }
       
   }
   
   //添加之后
   protected function _after_insert(&$data, $options){
       
       //保存设计师的空间和风格数据
       $workerfModel=M('workerfilter');
       $p_arr=json_decode($data['space'],true);//转回数组格式
       $s_arr=json_decode($data['style'],true);//转回数组格式
       foreach ($p_arr as $k=>$v){
           //获取空间名称
            $name=M('worktype')->field('name')->find($v);
            $sp['workerid']=$data['id'];
            $sp['kj']=$v;
            $sp['stylename']=$name['name'];
            $workerfModel->add($sp);
       }
       
       foreach ($s_arr as $k=>$v){
           //获取空间名称
           $name=M('worktype')->field('name')->find($v);
           $st['workerid']=$data['id'];
           $st['fg']=$v;
           $st['stylename']=$name['name'];
           $workerfModel->add($st);
       }
   }
   
   //修改之前
   protected function _before_update(&$data, $options){
            
            //将空间和风格处理为json格式存储
            $data['space']=json_encode($data['space']);
            $data['style']=json_encode($data['style']);
            //处理封面图片
            $pic=UploadOne('photo','Worker/');
            if (empty($pic)){
                //没有更新图片
                return;
            }else{
                //取出旧图片进行删除
                $imgurl=$this->find($options['where']['id']);
                $old_img='./Public/Upload/'.$imgurl['photo'];
                
                unlink($old_img);
                //添加新图片
                $data['photo']=$pic['images'][0];
            }
            
   }
   
   //修改之后
   protected function _after_update(&$data, $options){
          
       /****************更新设计师空间和风格数据************/
       //将原有的删除，重新添加
       $workerfModel=M('workerfilter');
       $workerfModel->where('workerid='.$data['id'])->delete();       
     
       $p_arr=json_decode($data['space'],true);//转回数组格式
       $s_arr=json_decode($data['style'],true);//转回数组格式
       foreach ($p_arr as $k=>$v){
           //获取空间名称
           $name=M('worktype')->field('name')->find($v);
           $sp['workerid']=$data['id'];
           $sp['kj']=$v;
           $sp['stylename']=$name['name'];
           $workerfModel->add($sp);
       }
        
       foreach ($s_arr as $k=>$v){
           //获取空间名称
           $name=M('worktype')->field('name')->find($v);
           $st['workerid']=$data['id'];
           $st['fg']=$v;
           $st['stylename']=$name['name'];
           $workerfModel->add($st);
       }
   }
   
   //删除之前
   protected function _before_delete($options){
       
       //将硬盘上的图片删除并删除设计师的空间风格数据
       $imgurl=$this->field('photo')->find($options['where']['id']);
       $old_img='./Public/Upload/'.$imgurl['photo'];
       unlink($old_img);
       
       $workerfModel=M('workerfilter');
       $workerfModel->where('workerid='.$options['where']['id'])->delete();
   }
  
}