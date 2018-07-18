<?php
/*
 * 服务人员管理模型
 * 
 * */

namespace Admin\Model;
use Think\Model;

class HomemanModel extends Model{
    
    /*
     * 自动验证
     * */    
    protected $_validate=array(
        array('name','require','请填写名称',1,'regex',3),
        array('exp','require','请填写资历经验',1,'regex',3),
        array('ser','require','请填写服务内容',1,'regex',3),
        array('tel','require','请填写联系电话',1,'regex',3),
        array('lev','require','请填写优先级',1,'regex',3),
    );
    
    /**
     * 新增之前的处理
     * */   
    protected function _before_insert(&$data, $options){
        //处理工种与地区为json格式保存
        $data['zarr']=json_encode(I('post.zone'));
        $data['hparr']=json_encode(I('post.pro'));
        $data['time']=time();
        
        //处理上传图片
        
        $res=UploadOne('photo','Homeman/');
        if($res['img']==0){
            $this->error="照片上传失败";
        }else{
            $data['photo']=$res['images'][0];
        }
    }

    /*
    新增之后的处理
    ***/
    protected function _after_insert(&$data,$options){
            //人员地区表入库
        $dModel=M('homezone');
        $fModel=M('homefilter');
        foreach (I('post.zone') as $k => $v) {
            //获取对应的地区名称
            $zname=$dModel->field('zname')->find($v);
            $fModel->add(
                array(
                    'manid'=>$data['id'],
                    'zid'=>$v,
                    'name'=>$zname['zname'],
                )
            );
        }
        //人员工种表入库
        $gModel=M('homepro');
        foreach (I('post.pro') as $k => $v) {
           //取出对应的工种名称
            $gname=$gModel->field('gname')->find($v);
            $fModel->add(array(
                    'manid'=>$data['id'],
                    'hpid'=>$v,
                    'name'=>$gname['gname'],
            ));
        }
    }

    /**
        修改之前的处理
    **/
    protected function _before_update(&$data,$options){

           //处理工种与地区为json格式保存
        $data['zarr']=json_encode(I('post.zone'));
        $data['hparr']=json_encode(I('post.pro'));
        
        //处理上传图片 
         $if=$_FILES['img'];
         if ($if==null) {
            //用户没有更新照片
            return true;      
        }else{
            $res=UploadOne('img','Homeman/');
             //需要将旧的图片从硬盘上删除
            $imgurl=$this->field('photo')->find($options['where']['id']);
            $imgurl=C('IMG_ROOTPATH').$imgurl['photo'];
            unlink($imgurl);
            $data['photo']=$res['images'][0];
        }       
              
    }

    /**
      修改之后的处理
    ***/
    protected function _after_update(&$data,$options){
                //人员地区表入库
        $dModel=M('homezone');
        $fModel=M('homefilter');
        //将原有的地区工种删除重入库
        $fModel->where('manid='.$data['id'])->delete();
        foreach (I('post.zone') as $k => $v) {
            //获取对应的地区名称
            $zname=$dModel->field('zname')->find($v);
            $fModel->add(
                array(
                    'manid'=>$data['id'],
                    'zid'=>$v,
                    'name'=>$zname['zname'],
                )
            );
        }
        //人员工种表入库
        $gModel=M('homepro');
        foreach (I('post.pro') as $k => $v) {
           //取出对应的工种名称
            $gname=$gModel->field('gname')->find($v);
            $fModel->add(array(
                    'manid'=>$data['id'],
                    'hpid'=>$v,
                    'name'=>$gname['gname'],
            ));
        }
    }    
}