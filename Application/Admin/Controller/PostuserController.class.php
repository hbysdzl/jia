<?php
/*
 * 留言预预约管理控制器
 * 
 * */

namespace Admin\Controller;
use Admin\Controller\BackController;


class PostuserController extends BackController{
    
    //留言列表
    public function index(){
        
        $this->assign(array('title'=>'留言管理','OneAuth'=>$this->OneAuth,'TowAuth'=>$this->TowAuth));
        
        //获取留言信息
        $Wdb = M("postuser");
        $where['status']=array('egt',0);//没有被删除
        $where['wei']=0;//展示真实的数据
        //搜索功能
        if(IS_POST){
            $name=I('post.name');
            if (empty($name) || $name=='请输入名称') {
                $this->error('请输入搜索的名称');
            }
            $where['name']=array('LIKE','%'.$name.'%');
        }
        
        /**************************************设定分页****************/
        $Wdb_num=$Wdb->where($where)->count();
        $tatalPage=$Wdb_num;//总的记录数
        $page=12;//每页显示的数量
        //调用分页公用函数
        $pageArr=getPage($Wdb_num,$page);
        $list=$Wdb->where($where)->limit($pageArr[0],$pageArr[1])->order('time desc')->select();
        
        //按手机号去重操作
        $k='mobile';
        $list=$this->assoc_unique($list, $k);
        $this->assign('page_str',$pageArr[2]);
        $this->assign('list',$list);
        $this->display();
    }
    
    //二维数组去重！
    public function assoc_unique($arr, $key){
        $tmp_arr = array();
        foreach($arr as $k => $v){
            if(in_array($v[$key], $tmp_arr))//搜索$v[$key]是否在$tmp_arr数组中存在，若存在返回true
            { // www.jbxue.com
                unset($arr[$k]);
            }
            else {
                $tmp_arr[] = $v[$key];
            }
        }
        //sort($arr); //sort函数对数组进行排序
        return $arr;
    }
}