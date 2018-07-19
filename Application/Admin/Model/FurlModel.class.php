<?PHP
/*
**	友情链接管理模型
*/
namespace Admin\Model;
use Think\Model;

class FurlModel extends Model{

		//自动验证
	protected  $_validate=array(
		array('linkname','require','链接名称不能为空',1,'regex'),
		array('linkname','','链接名称已存在',1,'unique',1),
		array('url','require','链接地址不能为空',1,'regex'),
		array('url','','链接地址已存在',1,'unique',1),
	);

	
}