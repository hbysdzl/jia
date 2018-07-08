<?php
//文档模型
namespace Admin\Model;
use Think\Model;
use Upload;

class DocumentModel extends Model{
    
   //添加表单自动验证
   protected $_validate=array(
       array('title','require','文章标题不能为空',1,'regex',3),
       array('description','require','文章描述不能为空',1,'regex',3),
       array('type','1,2,3','请选择文章类型',1,'in',3),
   );
   
   //添加之前
      protected function _before_insert(&$data, $options){
       
       $data['uid']=session('admin_id');
       $data['create_time']=time();
       
       //处理图片上传
       $pic=UploadOne('img','Document/');
       $cover_id=M('DocumentCimg')->add(array('imgurl'=>$pic['images'][0]));
       $data['cover_id']=$cover_id;
   }
   
   //添加之后
   protected function _after_insert(&$data, $options){
       
       //处理文章内容
       $doc=I('post.document');
       M('DocumentArticle')->add(array(
                                'id'=>$data['id'],
                                'content'=>$doc
                            ));
   }
   
   //修改之前
   protected function _before_update(&$data, $options){
            $data['uid']=session('admin_id');
            $data['update_time']=time();
            //处理封面图片
            $pic=UploadOne('img','Document/');
            if (empty($pic)){
                //没有更新图片
                return;
            }else{
                //取出旧图片进行删除
                $documentModel=M('DocumentCimg');
                $imgurl=$documentModel->find($data['cover_id']);
                $old_img=C('IMG_PATH').$imgurl['imgurl'];
                unlink($old_img);
                $documentModel->delete($data['cover_id']);
                //添加新图片
                $cover_id=$documentModel->add(array('imgurl'=>$pic['images'][0]));
                $data['cover_id']=$cover_id;
            }
            
   }
   //修改之后
   protected function _after_update(&$data, $options){
          
       /****************处理文章内容************/
       //将原有的删除，重新添加
       $model=M('DocumentArticle');
       $model->where('id='.$data['id'])->delete();       
       $doc=I('post.document');
       M('DocumentArticle')->add(array(
           'id'=>$data['id'],
           'content'=>$doc
       ));
   }
   
   
   protected function _after_delete(&$data, $options){
       
   }
}