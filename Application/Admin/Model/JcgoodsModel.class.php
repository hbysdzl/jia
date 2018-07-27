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
			
	}
}
