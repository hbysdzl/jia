<?php
/*
**建材商活动模型
*
*/

namespace Admin\Model;
use Think\Model;

class JcgoodsModel extends Model{

     
    //自动验证规则
	protected $_validate=array(
		array('name','require','请填写活动名称',1,'regex'),
		array('hdnum','require','请填写活动期数',1,'regex'),
		array('time','require','请填写活动有效期',1,'regex'),
		array('oprice','require','请填写原价格',1,'regex'),
		array('nprice','require','请填写现实优惠价',1,'regex'),
	);

	//添加之前的处理
	protected function _before_insert(&$data,$options){
			//处理图片上传
			$brandImg=UploadOne('brandimg','shop/');
			if ($brandImg['images'][0]!='') {
				$data['brandimg']=$brandImg['images'][0];
			}

			$listImg=UploadOne('listimg','shop/');
			if ($listImg['images'][0]!='') {
				$data['listimg']=$listImg['images'][0];
			}

			$pimg=UploadOne('pimg','shop/');
			if ($pimg['images'][0]!='') {
				$data['pimg']=$pimg['images'][0];
			}
	}

	//添加之后的处理
	protected function _after_insert(&$data,$options){
			//处理活动商品图片表
		$pics=$_FILES['pics'];
		$arrlist=array();
		foreach ($pics['name'] as $k => $v) {
			$arr['name']=$v;
			$arr['type']=$pics['type'][$k];
			$arr['tmp_name']=$pics['tmp_name'][$k];
			$arr['error']=$pics['error'][$k];
			$arr['size']=$pics['size'][$k];
			$arrlist[]=$arr;
		}
		$_FILES=$arrlist;
		$jcimgModel=M('jcimg');
		//循环插入
		foreach ($arrlist as $k => $v) {
			$img=UploadOne($k,'shop/');
			if ($img['images'][0]!='') {
				
				$jcimgModel->add(array(
				'gid'=>$data['id'],
				'img'=>$img['images'][0],
				));
			}
			
		}
	}

	//修改之前的处理
	protected function _before_update(&$data,$options){
			//处理上传logo图片
			$brandImg=UploadOne('brandimg','shop/');
			if ($brandImg['images'][0]!='') {
				//将旧图片从硬盘上删除
				$url=$this->field('brandimg')->find($options['where']['id']);
				$imgUrl=C('IMG_ROOTPATH').$url['brandimg'];
				unlink($imgUrl);
				$data['brandimg']=$brandImg['images'][0];
			}else{
				//将空的删除掉
				unset($data['brandimg']);
			}

			$listImg=UploadOne('listimg','shop/');
			if ($listImg['images'][0]!='') {
				//将旧图片从硬盘上删除
				$url=$this->field('listimg')->find($options['where']['id']);
				$imgUrl=C('IMG_ROOTPATH').$url['listimg'];
				unlink($imgUrl);
				$data['listimg']=$listImg['images'][0];
			}else{
				unset($data['listimg']);
			}

			$pimg=UploadOne('pimg','shop/');
			if ($pimg['images'][0]!='') {
				//将旧图片从硬盘上删除
				$url=$this->field('pimg')->find($options['where']['id']);
				$imgUrl=C('IMG_ROOTPATH').$url['pimg'];
				unlink($imgUrl);
				$data['pimg']=$pimg['images'][0];
			}else{
				unset($data['pimg']);
			}

	}


	/*
	*更新后的处理
	*/
	protected function _after_update(&$data,$options){

			//更新活动图片表
		   $pics=$_FILES['pics'];
		   
		   if ($pics!==null) {
		   		$arrlist=array();
				foreach ($pics['name'] as $k => $v) {
					$arr['name']=$v;
					$arr['type']=$pics['type'][$k];
					$arr['tmp_name']=$pics['tmp_name'][$k];
					$arr['error']=$pics['error'][$k];
					$arr['size']=$pics['size'][$k];
					$arrlist[]=$arr;
				}
				$_FILES=$arrlist;
				$jcimgModel=M('jcimg');
				//循环插入
				foreach ($arrlist as $k => $v) {
					$img=UploadOne($k,'shop/');
					$jcimgModel->add(array(
						'gid'=>$data['id'],
						'img'=>$img['images'][0],
						));
				
				}
		   }	   
	}

}
