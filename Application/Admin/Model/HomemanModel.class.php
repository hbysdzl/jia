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
}