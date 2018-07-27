<?php 

/*
**家具建材管理控制器
*/
 
 namespace Admin\Controller;
 use Admin\Controller\BackController;

 class MaterialController extends BackController{

 	/*
	**商店管理列表
 	*/
 	 
    public function index(){
    	//根据用户权限显示菜单！
         $this->assign(array('title'=>'建材商店管理列表','OneAuth'=>$this->OneAuth,'TowAuth'=>$this->TowAuth));
         $Wdb=D('mstore');
         $where['status']=array('egt',0);//没有被删除
          
         //搜索功能
         if(IS_POST){
             $name=I('post.name');
             if (empty($name) || $name=='请输入名称') {
                 $this->error('请输入需要查找的名称');
             }
             $where['name']=array('LIKE','%'.$name.'%');
         }        
         /**************************************设定分页****************/
         $Wdb_num=$Wdb->where($where)->count();
         $tatalPage=$Wdb_num;//总的记录数
         $page=10;//每页显示的数量
         $page_arr=getPage($Wdb_num,$page);  //调用公共函数分页       
         $mstoreList=$Wdb->where($where)->limit($page_arr['0'],$page_arr[1])->order('id desc')->select();
         $this->assign('mstoreList',$mstoreList);
         $this->assign('page_str',$page_arr[2]);         
         $this->display();
    }

    /*
	**新增商店
    */
    public function add(){

    	 $this->assign(array('title'=>'新增商店','OneAuth'=>$this->OneAuth,'TowAuth'=>$this->TowAuth));
         $Mdb=D('Mstore');    
         if(IS_POST){
             if ($Mdb->create(I('post.'),1)) {
                 if ($Mdb->add()) {
                     $this->ajaxReturn(array('status'=>1,'ok'=>'恭喜您，新增成功！'));
                     die();
                 }
             }
             $this->ajaxReturn(array('status'=>0,'error'=>$Mdb->getError()));
         }   
         //取出建材分类、品牌，地区数据
         $res1=M('mtype')->field('id,name')->where(array('status'=>array('egt',0)))->select();//建材分类
         $res2=M('mbrand')->field('id,name')->where(array('status'=>array('egt',0)))->select();//建材品牌
         $res3=M('homezone')->field('id,zname')->where(array('status'=>array('egt',0)))->select();//建材分类
         $this->assign(array('res1'=>$res1,'res2'=>$res2,'res3'=>$res3));
    	 $this->display();
    }

    /***
    ***商店编辑
    ***/

    public function edit(){

        $this->assign(array('title'=>'编辑商店','OneAuth'=>$this->OneAuth,'TowAuth'=>$this->TowAuth));
        $Mdb=D('Mstore'); 
        if (IS_POST) {
            if ($Mdb->create(I('post.'),2)) {
               if ($Mdb->save()!==false) {
                   $this->ajaxReturn(array('status'=>1,'ok'=>'恭喜您，更新成功'));
                   die();
               }
            }
            $this->ajaxReturn(array('status'=>0,'error'=>$Mdb->getError()));
        }
        
        //获取编辑的数据       
        $id=I('get.id');
        
        if (!$id) {
            $this->error('参数错误');
        }
        $editData=$Mdb->find($id);
        $editData['f']=json_decode($editData['f'],true);
        $editData['b']=json_decode($editData['b'],true);
        $editData['z']=json_decode($editData['z'],true);
        $this->assign('editData',$editData);
        //取出建材分类、品牌，地区数据
        $res1=M('mtype')->field('id,name')->where(array('status'=>array('egt',0)))->select();//建材分类
        $res2=M('mbrand')->field('id,name')->where(array('status'=>array('egt',0)))->select();//建材品牌
        $res3=M('homezone')->field('id,zname')->where(array('status'=>array('egt',0)))->select();//建材分类
        $this->assign(array('res1'=>$res1,'res2'=>$res2,'res3'=>$res3));
        $this->display();
    }

    /*
    ***建材商相册管理列表
    */
    public function picIndex(){

        $this->assign(array('title'=>'商家相册管理','OneAuth'=>$this->OneAuth,'TowAuth'=>$this->TowAuth));
        $Wdb=D('mstorepic');
        $where['status']=array('egt',0);//没有被删除
          
        //搜索功能
        if(IS_POST){
             $name=I('post.picname');
             if (empty($name) || $name=='请输入相册名称') {
                 $this->error('请输入需要查找的相册名称');
             }
             $where['picname']=array('LIKE','%'.$name.'%');
        }        
        /**************************************设定分页****************/
        $Wdb_num=$Wdb->where($where)->count();
        $tatalPage=$Wdb_num;//总的记录数
        $page=10;//每页显示的数量
        $page_arr=getPage($Wdb_num,$page);  //调用公共函数分页       
        $picmstoreList=$Wdb->where($where)->limit($page_arr['0'],$page_arr[1])->order('id desc')->select();
        $this->assign('picmstoreList',$picmstoreList);
        $this->assign('page_str',$page_arr[2]);  
        $this->display();
    }

    /***
    ****新增相册
    ***/
    public function picAdd(){
        $this->assign(array('title'=>'新增相册','OneAuth'=>$this->OneAuth,'TowAuth'=>$this->TowAuth));
        $picModel=M('mstorepic');
        if(IS_POST){
            if ($picModel->create(I('post.'),1)) {
                $str=explode('-', $picModel->storename);
                $picModel->storeid=$str[0];
                $picModel->storename=$str[1];
                if ($id=$picModel->add()) {
                    //处理商家相册数据入库
                   $pics=$_FILES['pics'];
                   $arr=array();
                   foreach ($pics['name'] as $k => $v) {
                        $arr['name']=$v;
                        $arr['type']=$pics['type'][$k];
                        $arr['tmp_name']=$pics['tmp_name'][$k];
                        $arr['error']=$pics['error'][$k];
                        $arr['size']=$pics['error'][$k];
                        $img[]=$arr;
                   }
                   $_FILES=$img;
                   $imgModel=M('mstoreimg');
                   foreach ($img as $k => $v) {
                       $res=UploadOne($k,'shop/');
                       $imgModel->add(array(
                            'storeid'=>$str[0],
                            'picid'=>$id,
                            'img'=>$res['images'][0]
                       ));
                   }
                    
                    $this->ajaxReturn(array('status'=>1,'ok'=>'恭喜您，新增成功！'));
                    die();
                }
            }
            $this->ajaxReturn(array('status'=>0,'error'=>$picModel->getError()));
        }
        //取出商家名称及ID信息
        $Mdb=D('Mstore');
        $ms=$Mdb->field('id,name')->where(array('status'=>array('egt',0)))->select();
        $this->assign('ms',$ms);
        $this->display();
    }

    /***
    ***相册编辑
    ***/
    public function PicEdit(){
        $this->assign(array('title'=>'编辑相册','OneAuth'=>$this->OneAuth,'TowAuth'=>$this->TowAuth));
        $picModel=M('mstorepic');
        $imgModel=M('mstoreimg');
        
        if (IS_POST) {
           if ($picModel->create(I('post'),2)) {
                $picArr=explode('-', $picModel->storename);
                $picModel->storeid=$picArr[0];
                $picModel->storename=$picArr[1];
                if ($picModel->save()!==false) {
                    //处理相册图片表
                    $arr=array();
                    $imgs=$_FILES['pics'];
                    if ($imgs!=null) {
                        foreach ($imgs['name'] as $k => $v) {
                            $arr['name']=$v;
                            $arr['type']=$imgs['type'][$k];
                            $arr['tmp_name']=$imgs['tmp_name'][$k];
                            $arr['error']=$imgs['error'][$k];
                            $arr['size']=$imgs['size'][$k];

                            $pic_arr[]=$arr;
                        }
                        $_FILES=$pic_arr;
                        foreach ($pic_arr as $k => $v) {
                            $res=UploadOne($k,'shop/');
                            $imgModel->add(array(
                                    'storeid'=>$picArr[0],
                                    'picid'=>I('post.id'),
                                    'img'=>$res['images'][0]
                            ));
                        }
                    }
                   $this->ajaxReturn(array('status'=>1,'ok'=>'恭喜您！更新成功！')); 
                }
            } 
            $this->ajaxReturn(array('status'=>0,'error'=>$picModel->getError()));
        }
        
        $id=I('get.id');
            if (!id) {
                $this->error('参数错误');
            }
        //取出编辑的数据
        $editData=$picModel->find($id);
        $this->assign('editData',$editData);

        //取出编辑的图片数据
        $resImg=$imgModel->where(array('storeid'=>array('eq',$editData['storeid']),'picid'=>array('eq',$id)))->select();
        $this->assign('resImg',$resImg);
        //取出商家名称及ID信息
        $Mdb=D('Mstore');
        $ms=$Mdb->field('id,name')->where(array('status'=>array('egt',0)))->select();
        $this->assign('ms',$ms);
        $this->display();
    }

    /*
    ***ajax删除相册图片
    */
    
    public function ajaxDelImg(){
            $id=I('id');
            $imgModel=M('mstoreimg');
            $imgurl=$imgModel->field('img')->find($id);
            $imgurl=C('IMG_ROOTPATH').$imgurl['img'];
            if(unlink($imgurl)){
                if($imgModel->delete($id)){
                    $this->ajaxReturn(array('ok'=>1));
                    die();
                }
            }
            $this->ajaxReturn(array('ok'=>0,'error'=>'删除失败！'));
    }
    
    
    /*
     ***建材品牌管理
    */
    public function brandIndex(){
         $this->assign(array('title'=>'建材品牌管理列表','OneAuth'=>$this->OneAuth,'TowAuth'=>$this->TowAuth));

         //获取数据列表
         $mdModel=D('mbrand');
         //搜索功能
         if (IS_POST) {
            $sear=I('post.name');
             if (empty($sear) || $sear=='请输入品牌名称') {
                 $this->error('请输入品牌名称');
             }

         }
         $totalNum=$mdModel->where($where)->count(); //获取符合条件的额记录数
         $pageSize=10;
         $res=getPage($totalNum,$pageSize);//调用封装的公共函数分页
         $brList=$mdModel->alias('a')->field('a.*,b.name fname')->join('LEFT JOIN jia_mtype as b on a.fid=b.id')->where(array('a.status'=>array('egt',0),'a.name'=>array('LIKE','%'.$sear.'%')))->limit($res[0],$res[1])->order('id desc')->select();
         $this->assign('brList',$brList);
         $this->assign('page_str',$res[2]);
         $this->display();
    }

    /*
    ***新增建材品牌
    */
    public function brandAdd(){
        $this->assign(array('title'=>'新增品牌','OneAuth'=>$this->OneAuth,'TowAuth'=>$this->TowAuth));
        $brandModel=D('mbrand');
        if (IS_POST) {
            if ($brandModel->create(I('post.'),1)) {
                //处理logo上传
                    $res=UploadOne('photo','shop/');
                    if ($res['img']==1 && $res['images'][0]!='') {
                        $brandModel->photo=$res['images'][0];
                    }
                    if ($brandModel->add()) {
                        
                        $this->ajaxReturn(array('status'=>1,'ok'=>'恭喜您，新增成功！'));
                        die();
                    }
            }
            $this->ajaxReturn(array('status'=>0,'error'=>$brandModel->getError()));
        }
        //获取品牌分类数据
        $mtypeModel=M('mtype');
        $mtype=$mtypeModel->where(array('status'=>array('egt',0)))->select();
        $this->assign('mtype',$mtype);
        $this->display();
    }

    /*
    ***编辑建材品牌
    */
    public function brandEdit(){
         $this->assign(array('title'=>'编辑品牌','OneAuth'=>$this->OneAuth,'TowAuth'=>$this->TowAuth));
         $brandModel=D('mbrand');

         if (IS_POST) {
             if ($data=$brandModel->create(I('post.'),2)) {
                 //处理logo上传
                $res=UploadOne('pic','shop/');
                    if ($res['images'][0]!=='') {
                        $data['photo']=$res['images'][0];
                        //需将硬盘上的旧图片删除
                        $imgurl=$brandModel->field('photo')->find(I('post.id'));
                        $imgurl=C('IMG_ROOTPATH').$imgurl['photo'];
                        unlink($imgurl);    
                    }
                    if ($brandModel->save($data)!==false) {
                        $this->ajaxReturn(array('status'=>1,'ok'=>'恭喜您！更新成功！'));
                        die();
                    }
             }
             $this->ajaxReturn(array('status'=>0,'error'=>$brandModel->getError()));
             return;
         }
         $id=I('get.id');
         if (!$id) {
             $this->error('参数错误');
         }
         //获取编辑的数据
         $editData=$brandModel->find($id);
         $this->assign('editData',$editData);
         //获取品牌分类数据
         $mtypeModel=M('mtype');
         $mtype=$mtypeModel->where(array('status'=>array('egt',0)))->select();
         $this->assign('mtype',$mtype);
         $brandModel=D('mbrand');
         $this->display();
    }

    /*
    ***建材分类管理列表
    */
    public function classIndex(){

        $this->assign(array('title'=>'建材分类管理列表','OneAuth'=>$this->OneAuth,'TowAuth'=>$this->TowAuth));
        //获取分类信息
        $Mdb=D('mtype');
        $where['status']=array('egt',0);//没有被删除
        //搜索功能
        if(IS_POST){
            $name=I('post.name');
            if (empty($name) || $name=='请输入名称') {
                $this->error('请输入搜索的名称');
            }
            $where['name']=array('LIKE','%'.$name.'%');
        }
        
        /**************************************设定分页****************/
        $totalPage=$Mdb->where($where)->count();//总的记录数
        $page=10;//每页显示的数量
        //调用分页公用函数
        $pageArr=getPage($totalPage,$page);
        $MtyList= $Mdb->where($where)->limit($pageArr[0],$pageArr[1])->order('id desc')->select();
        //获取父ID及名称
        foreach ($MtyList as $k=>$v){
            if ($v['fid']==0){
                $MtyList[$k]['fname']="顶级";
            }else{
                //取出它的父级名称
                $res=$Mdb->field('name')->find($v['fid']);
                $MtyList[$k]['fname']=$res['name'];
            }
        }
        
        $this->assign('MtyList',$MtyList);
        $this->assign('page_str',$pageArr[2]);
        $this->display();
    }

    /***
    ***新增建材分类
    **/
    public function classAdd(){
        $this->assign(array('title'=>'新增建材分类','OneAuth'=>$this->OneAuth,'TowAuth'=>$this->TowAuth));
        $mMdoel=M('mtype');
        if (IS_POST) {
            if ($mMdoel->create(I('post.'),1)) {
                if ($mMdoel->add()) {
                    $this->ajaxReturn(array('status'=>1,'ok'=>'恭喜您，新增成功！'));
                    die();
                }
            }
            $this->ajaxReturn(array('status'=>0,'error'=>$mMdoel->getError()));
            return;
        }
        //取出顶级分类
        $parentList=$mMdoel->where(array('status'=>array('egt',0),'fid'=>array('eq',0)))->select();
        $this->assign('parentList',$parentList);
        $this->display();
    }

    /***
    ***编辑建材分类
    **/
    public function classEdit(){
        $this->assign(array('title'=>'新增建材分类','OneAuth'=>$this->OneAuth,'TowAuth'=>$this->TowAuth));
        $mMdoel=M('mtype');

        if (IS_POST) {
            if ($mMdoel->create(I('post.'),2)) {
                if ($mMdoel->save()!==false) {
                    $this->ajaxReturn(array('status'=>1,'ok'=>'恭喜您！更新成功！'));
                    die();
                }
            }
            $this->ajaxReturn(array('status'=>0,'error'=>$mMdoel->getError()));
        }
        //获取编辑的数据
        $id=I('get.id');
        if (!$id) {
            $this->error('参数错误');
        }
        $editData=$mMdoel->find($id);
        $this->assign('editData',$editData);
        //取出顶级分类
        $parentList=$mMdoel->where(array('status'=>array('egt',0),'fid'=>array('eq',0)))->select();
        $this->assign('parentList',$parentList);
        $this->display();
    }

    /**
    ***建材活动管理
    */
    public function hdIndex(){
        //根据用户权限显示菜单！
         $this->assign(array('title'=>'建材活动管理列表','OneAuth'=>$this->OneAuth,'TowAuth'=>$this->TowAuth));
         $goodsDb=D('Jcgoods');
         $where['status']=array('egt',0);//没有被删除
          
         //搜索功能
         if(IS_POST){
             $name=I('post.name');
             if (empty($name) || $name=='请输入名称') {
                 $this->error('请输入需要查找的名称');
             }
             $where['name']=array('LIKE','%'.$name.'%');
         }        
         /**************************************设定分页****************/
         $tatalPage=$goodsDb->where($where)->count();//总的记录数
         $page=10;//每页显示的数量
         $page_arr=getPage($tatalPage,$page);  //调用公共函数分页       
         $goodsList=$goodsDb->where($where)->limit($page_arr['0'],$page_arr[1])->order('time desc')->select();
         $this->assign('goodsList',$goodsList);
         $this->assign('page_str',$page_arr[2]);         
         $this->display();
    }

    /*
    ***新增建材活动
    *
    */
    public function hdAdd(){
        $this->assign(array('title'=>'新增活动','OneAuth'=>$this->OneAuth,'TowAuth'=>$this->TowAuth));
        $goodsDb=D('Jcgoods');
        if (IS_POST) {
            if ($goodsDb->create(I('post.'),1)) {
                if ($goodsDb->add()) {
                    $this->ajaxReturn(array('status'=>1,'ok'=>'恭喜您，新增成功！'));
                    die();
                }
            }
            $this->ajaxReturn(array('status'=>0,'error'=>$goodsDb->getError()));
            return;
        }

        $this->display();
    }

    /***
    ***状态操作
    ***/
    public function setStatus($method=null){
        $id=I('get.id');
        $model=I('get.mo');
        if(!$id || !$model){
            $this->error('参数错误');
        }
        switch(strtolower($method)){  //将参数统一转换为小写
        
            case "forbid":
                $this->forbid($model,array('id'=>$id));
                break;
            case "resumew":
                $this->resumew($model,array('id'=>$id));
                break;
            case "delete":
                $this->delete($model,array('id'=>$id));
                break;
            default:
                $this->error('非法参数');
        }
    }

 }