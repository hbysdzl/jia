<?php

/***
  **建材商店管理模型
**/

namespace Admin\Model;
use Think\Model;

class MstoreModel extends Model{

	
	//自动验证
	protected $_validate=array(
			array('name','require','请填写商店名称',1,'regex'),
			array('info','require','请填写主营方向',1,'regex'),
	);

	//添加之前的处理
	protected function _before_insert(&$data,$options){

			$data['f']=json_encode($data['f']);
			$data['b']=json_encode($data['b']);
			$data['z']=json_encode($data['z']);

			//处理图片上传
			$res1=UploadOne('photo','Mstore/');
			$res2=UploadOne('bpic','Mstore/');
			if($res1['img']==1){
				$data['photo']=$res1['images'][0];
			}
			if($res2['img']==1){
				$data['bpic']=$res2['images'][0];
			}

	}

	//添加之后的处理
	protected function _after_insert(&$data,$options){

			//保存建材分类数据到筛选表中
			$mdb=M('mtype');
			$fdb=M('mfilter');
			foreach (I('post.f') as $k => $v) {
				//获取对应的名称
				$name=$mdb->field('id,name')->find($v);
				$fdb->add(
					array(
						'storeid'=>$data['id'],
						'f'=>$v,
						'fname'=>$name['name']
					)
				);
			}

			//保存建材品牌数据到筛选表中
			$mdb=M('mbrand');
			$fdb=M('mfilter');
			foreach (I('post.b') as $k => $v) {
				//获取对应的名称
				$name=$mdb->field('id,name')->find($v);
				$fdb->add(
					array(
						'storeid'=>$data['id'],
						'b'=>$v,
						'fname'=>$name['name']
					)
				);
			}
			//保存地区数据到筛选表中
			$mdb=M('homezone');
			$fdb=M('mfilter');
			foreach (I('post.z') as $k => $v) {
				//获取对应的名称
				$name=$mdb->field('id,zname')->find($v);
				$fdb->add(
					array(
						'storeid'=>$data['id'],
						'z'=>$v,
						'fname'=>$name['zname']
					)
				);
			}
	}

	/***
	***更新之前的处理
	***/

	protected function _before_update(&$data,$options){
		$data['f']=json_encode($data['f']);
		$data['b']=json_encode($data['b']);
		$data['z']=json_encode($data['z']);

		//处理图片上传
		$res1=UploadOne('photo1','Mstore/');
		$res2=UploadOne('bpic2','Mstore/');
		if($res1['img']==1 && $res1['images'][0]!=''){
			//需将硬盘上的图片删除
			$imgUrl=$this->field('photo')->find($options['where']['id']);
			$imgUrl=C('IMG_ROOTPATH').$imgUrl['photo'];
			unlink($imgUrl);
			$data['photo']=$res1['images'][0];
		}
		if($res2['img']==1 && $res1['images'][0]!=''){
			//需将硬盘上的图片删除
			$imgUrl=$this->field('bpic')->find($options['where']['id']);
			$imgUrl=C('IMG_ROOTPATH').$imgUrl['bpic'];
			unlink($imgUrl);
			$data['bpic']=$res2['images'][0];
		}
	}

	/**
	***更新之后的处理
	**/
}