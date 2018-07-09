<?php
use Think\Page;
//文件上传公共函数
function UploadOne($imgname,$dirname,$thumb=array()){
    //上传LOGO
    if($_FILES[$imgname]['error']==0){
        //设置配置信息
        $config = array(
            'exts'          =>  array('jpg','png','gif'), //允许上传的文件后缀
            'autoSub'       =>  true, //自动子目录保存文件
            'subName'       =>  array('date', 'Y-m-d'), //子目录创建方式，[0]-函数名，[1]-参数，多个参数使用数组
            'rootPath'      =>     './Public/Upload/', //保存根路径
            'savePath'      =>  $dirname, //保存路径
            'saveName'      =>  array('uniqid', ''), //上传文件命名规则，[0]-函数名，[1]-参数，多个参数使用数组
            'saveExt'       =>  '', //文件保存后缀，空则使用原后缀
        );
        $upload=new Think\Upload($config);
        $info=$upload->uploadOne($_FILES[$imgname]);
        if(!info){
            //上传失败则获取错误信息
            return array('img'=>0,'error' => $upload->getError(),);
        }else {
            $ret['img']=1;
            $ret['images'][0]=$info['savepath'].$info['savename'];//原图地址
            //判断是否生成缩略图生成缩略图
            if($thumb){
                $images=new \Think\Image();//实例化
                foreach ($thumb as $k=>$v){
                    $images->open($upload->rootPath.$ret['images'][0]);//打开图片地址
                    $ret['images'][$k+1]=$info['savepath'].'sm_'.$k.'_'.$info['savename'];//拼凑缩略图文件名
                    $images->thumb($v[0], $v[1])->save($upload->rootPath.$ret['images'][$k+1]);//生成并保存

                }
            }
        }
    }
    return $ret;
}

//模板显示图片

function ShowImage($url,$width='',$height=''){
    $url='/Public/Upload/'.$url;
    if ($width){
        $width="width='$width'";
    }
    if ($height){
        $height="height='$height'";
    }
    echo "<img src='$url' $width $height>";
}

/*
 * 判断批量上传图片的表单中是否为空
 * */

function hasImage($imgName){
    foreach ($_FILES[$imgName]['error'] as $v){
        if($v==0){
            return true;
        }
        return false;
    }
}

//ajax添加数据入库公共函数
function ajaxadd($obj,$table,$ae){
    $obj=D($table);
    if ($obj->create(I('post.'),1)){
        if ($obj->$ae()>=0){
            echo json_encode(array('ok'=>1));
            die();
        }
    }
    echo json_encode(array('ok'=>0,'error'=>$obj->getError()));
}

//分页定制公共函数
function getPage($Wdb_num,$page){
    
    $page_w=new Page($Wdb_num, $page);
    //设置分页样式
    $page_w->setConfig('prev','【上一页】');
    $page_w->setConfig('next','【下一页】');
    $page_w->setConfig('first','【首页】');
    $page_w->setConfig('last','【末页】');
    $page_w->rollPage=5;
    $page_w->lastSuffix =false;
    $page_w->setConfig('theme','%HEADER% . 当前为%NOW_PAGE%/%TOTAL_PAGE% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
    
    $listRow=$page_w->listRows;
    $firstRow=$page_w->firstRow;
    $page_str=$page_w->show();
    
    return $page_arr=array($firstRow,$listRow,$page_str);
    
}