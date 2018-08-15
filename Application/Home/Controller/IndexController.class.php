<?php
/*
***首页控制器
*/
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        
    	//初始化缓存配置
    	S(array('type'=>'memcache','host'=>'127.0.0.1','port'=>'11211','prefix'=>'Index'));

    	//关于家造网
    	$guanyu=S('guanyu');  //从缓存中读取
    	if ($guanyu===false) {
    		//从数据库中获取

    		$userModel=M('guanyu');
    		$guanyu=$userModel->order('addtime desc')->limit(3)->select();
    		//设置到缓存中
    		S('guanyu',$guanyu,3600);

    	}
    	
    	$this->assign('guanyu',$guanyu);

    	//装修攻略
    	$gllist=S('a8319fb7570c7458');
    	if ($gllist===false) {
    		//读取文章类别表获取类型ID
    		$where['status']=1;
    		$where['title']='装修攻略';
    		$cateModel=M('category');
    		$cate_id=$cateModel->field('id')->where($where)->find();
    		
    		//读取文章表
    		$doc['status']=1;
    		$doc['category_id']=$cate_id['id'];
    		$docModel=D('Document');
    		$gllist=$docModel->field('id,title,description,cover_id')->where($doc)->limit(4)->order('create_time desc')->select();

    		//读取文章图片表获取对应图片
    		$picModel=D('Picture');
    		foreach ($gllist as $k => &$v) { //循环时将每一条记录引用传递
    			$path=$picModel->field('path')->find($v['cover_id']);
    			$v['pic']=$path['path'];
    		}

    		//写入memcache中
    		S('a8319fb7570c7458',$gllist,3600);
    	}
    	$this->assign('gllist',$gllist);

    	//新闻中心
    	$newList=S('e7a63878b43ab602');
    	if ($newList===false) {
    		//读取文章类别表获得ID
    		$where['status']=1;
    		$where['title']='新闻';
    		$cateModel=M('category');
    		$cate_id=$cateModel->field('id')->where($where)->find();

    		//读取文章表
    		$docModel=D('Document');
    		$doc['status']=1;
    		$doc['category_id']=$cate_id['id'];
    		$newList=$docModel->field('id,title,description,cover_id,create_time')->where($doc)->limit(4)->order('create_time desc')->select();
    		//取出对应的图片
    		$picModel=D('Picture');
    		foreach ($newList as $k => &$v) {
    			$path=$picModel->field('path')->find($v['cover_id']);
    			$v['pic']=$path['path'];
    		}

    		//写入memcache缓存中
    		S('e7a63878b43ab602',$newList,3600);
    	}
    	$this->assign('newList',$newList);
        $this->display();
    }
}