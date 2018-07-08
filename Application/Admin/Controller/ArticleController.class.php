<?php
//后台文档控制器
namespace Admin\Controller;
use Admin\Controller\BackController;
use Think\Page;
class ArticleController extends  BackController{
    
    //我的文档总列表
    public function myDocumentLst(){
       
         //获取数据类列表
        $documentModel=M('document');
        /**********************************设定分页***********/
        $total=$documentModel->count();//获取总的记录数
        
        $pageModel=new Page($total,10);
        $pageModel->lastSuffix = false;
        $pageModel->rollPage=8;
        $pageModel->setConfig('prev','【上一页】');
        $pageModel->setConfig('next','【下一页】');
        $pageModel->setConfig('first','【首页】');
        $pageModel->setConfig('last','【末页】');
        $pageModel->setConfig('theme','%HEADER%，当前是%NOW_PAGE%/%TOTAL_PAGE% %FIRST% %UP_PAGE% %LINK_PAGE%  %DOWN_PAGE% %END%');
        $page=$pageModel->show();
        
        $document_arr=$documentModel->alias('a')->field('a.*,b.title as act_title')->join('LEFT JOIN jia_category as b on a.category_id=b.id')->limit($pageModel->firstRow,$pageModel->listRows)->order('a.create_time desc')->select();
        //搜索功能
        if(IS_POST){
            $data=I('post.document');
            $document_arr=$documentModel->alias('a')->field('a.*,b.title as act_title')->join('LEFT JOIN jia_category as b on a.category_id=b.id')->where(array('a.title'=>array('like','%'.$data.'%')))->order('a.create_time desc')->select();
        }    
       
    
        $this->assign('num',$total);
        $this->assign('document_arr',$document_arr);
        $this->assign('page',$page);
        //设置标题
        $this->assign('title','我的文档');
        //根据用户权限显示菜单！
        $this->assign('OneAuth',$this->OneAuth);
        $this->assign('TowAuth',$this->TowAuth);
        $this->display();
    }
    
    //ajax删除文档
    public function ajaxdelDoceument($id){
        $model=M('document');
        //将图片删除
        $imgurl_id=$model->field('cover_id')->find($id);
		$documentImg=M('DocumentCimg');
		$imgurl=$documentImg->field('imgurl')->find($imgurl_id['cover_id']);//获取图片路径
		
		//先从硬盘将图片删除
		if(unlink('./Public/Upload/'.$imgurl['imgurl'])){
			$documentImg->where('id='.$imgurl_id['cover_id'])->delete();
		}
       
        
        if($model->delete($id)!==false){
            //将文章内容删除
            M('DocumentArticle')->where('id='.$id)->delete();
            echo json_encode(array('ok'=>1));
        }else{
            echo json_encode(array('ok'=>0));
        }
    }
    
    //我的文档类别首页
    public function index($cat_id){
		
		//根据不同的文档显示对应的标题
		$auth_a='index/cat_id/'.$cat_id;
		$title_name=M('auth')->field('auth_name')->where(array('auth_a'=>array('eq',$auth_a)))->find();
        
		
        //设置标题
        $this->assign('title',$title_name['auth_name']);
        
        $model=M('document'); 
        /**********************************设定分页***********/
        //总的记录数
        $Lst=$model->where(array('category_id'=>array('eq',$cat_id)))->select();
        $num=count($Lst);
        
        $pageModel=new Page($num,10);
        $pageModel->lastSuffix = false;
        $pageModel->rollPage=6;
        $pageModel->setConfig('prev','【上一页】');
        $pageModel->setConfig('next','【下一页】');
        $pageModel->setConfig('first','【首页】');
        $pageModel->setConfig('last','【末页】');
        $pageModel->setConfig('theme','%HEADER%，当前是%NOW_PAGE%/%TOTAL_PAGE% %FIRST% %UP_PAGE% %LINK_PAGE%  %DOWN_PAGE% %END%');
        $page=$pageModel->show();
        
        $indexLst=$model->where(array('category_id'=>array('eq',$cat_id)))->limit($pageModel->firstRow,$pageModel->listRows)->order('create_time desc')->select();
        //搜索功能
        if(IS_POST){
            $data=I('post.document');
            $indexLst=$model->where(array('title'=>array('like','%'.$data.'%'),'category_id'=>array('eq',$cat_id)))->order('create_time desc')->select();
        }
        $this->assign('cat_id',$cat_id);
        $this->assign('page',$page);
        $this->assign('num',$num);
        $this->assign('indexLst',$indexLst);
        //根据用户权限显示菜单！
        $this->assign('OneAuth',$this->OneAuth);
        $this->assign('TowAuth',$this->TowAuth);
        $this->display();
    }
    
    //添加指定类别文档表单数据
    public function add($cat_id){
		
		//根据不同的文档显示对应的标题
		$auth_a='index/cat_id/'.$cat_id;
		$title_name=M('auth')->field('auth_name')->where(array('auth_a'=>array('eq',$auth_a)))->find();
        //设置标题
        $this->assign('title','新增文档--'.$title_name['auth_name']);
        
        $this->assign('cat_id',$cat_id);
        //根据用户权限显示菜单！
        $this->assign('OneAuth',$this->OneAuth);
        $this->assign('TowAuth',$this->TowAuth);
        $this->display();
    }
    
    //ajax添加指定文档
    public function ajaxAdd(){
        $docModel=D('Document');
        if($docModel->create(I('post.'),1)){
            if($docModel->add()){
                echo json_encode(array('ok'=>1));
                die();
            }
                
         }
        echo json_encode(array('ok'=>0,'error'=>$docModel->getError()));
    }
    
    
    //修改指定类别的文档表单数据
    public function edit(){
        $cat_id=I('get.cat_id');
        $id=I('get.id');
		
		//根据不同的文档显示对应的标题
		$auth_a='index/cat_id/'.$cat_id;
		$title_name=M('auth')->field('auth_name')->where(array('auth_a'=>array('eq',$auth_a)))->find();
        //设置标题
        $this->assign('title','新增文档--'.$title_name['auth_name']);
        
        //获取需要修改的文档内容
        $doc=D('Document')->find($id);
        //获得封面图片路劲
        $docImg=M('DocumentCimg')->field('imgurl')->find($doc['cover_id']);
        //获得文章内容
        $docContent=M('DocumentArticle')->field('content')->find($doc['id']);
        
        $this->assign('doc',$doc);
        $this->assign('docImg',$docImg);
        $this->assign('docContent',$docContent);
        $this->assign('cat_id',$cat_id);
        //根据用户权限显示菜单！
        $this->assign('OneAuth',$this->OneAuth);
        $this->assign('TowAuth',$this->TowAuth);
        $this->display();
    }
    
    //ajax更新数据
    public function ajaxEdit(){ 
        $docModel=D('Document');
        if($docModel->create(I('post.'),2)){
            
            if($docModel->save()!==false){
                echo json_encode(array('ok'=>1));
                die();
            }        
        }
        echo json_encode(array('ok'=>0,'error'=>$docModel->getError()));
    }
}