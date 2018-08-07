<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="keywords" content="admin, dashboard, bootstrap, template, flat, modern, theme, responsive, fluid, retina, backend, html5, css, css3">
  <meta name="description" content="">
  <meta name="author" content="ThemeBucket">
  <link rel="shortcut icon" href="#" type="image/png">

  <title><?php echo ($title); ?></title>
<!--icheck-->
  <link href="/Application/Admin/Public/js/iCheck/skins/minimal/minimal.css" rel="stylesheet">
  <link href="/Application/Admin/Public/js/iCheck/skins/square/square.css" rel="stylesheet">
  <link href="/Application/Admin/Public/js/iCheck/skins/square/red.css" rel="stylesheet">
  <link href="/Application/Admin/Public/js/iCheck/skins/square/blue.css" rel="stylesheet">
  <link rel="shortcut icon" type="image/x-icon" href="/Application/Admin/Public/images/favicon.ico" media="screen">
  <!--dashboard calendar-->
  <link href="/Application/Admin/Public/css/clndr.css" rel="stylesheet">
  <!--Morris Chart CSS -->
  <link rel="stylesheet" href="/Application/Admin/Public/js/morris-chart/morris.css">
  <!--common-->
  <link href="/Application/Admin/Public/css/style.css" rel="stylesheet">
  <link href="/Application/Admin/Public/css/style-responsive.css" rel="stylesheet">

  <script src="/Application/Admin/Public/js/jquery-1.10.2.min.js"></script>
  
  <!-- jquery form表单提交插件 -->
  <script src="/Application/Admin/Public/js/form/jquery-1.8.3.min.js"></script>
  <script src="/Application/Admin/Public/js/form/jquery.form.js"></script>
  <script src="/Application/Admin/Public/js/layer/layer.js"></script>  
  <!-- ajax状态操作 -->
  <script src="/Application/Admin/Public/js/status.js"></script>
  <!-- 在线编辑器 -->
  <script type="text/javascript" charset="utf-8" src="/Application/Admin/Public/ueditor/ueditor.config.js"></script>
  <script type="text/javascript" charset="utf-8" src="/Application/Admin/Public/ueditor/ueditor.all.min.js"> </script>
  <script type="text/javascript" charset="utf-8" src="/Application/Admin/Public/ueditor/lang/zh-cn/zh-cn.js"></script>
</head>

<body class="sticky-header">

<section>
    <!-- left side start-->
    <div class="left-side sticky-left-side">

        <!--logo and iconic logo start-->
        <div class="logo">
            <a href="index.html"><img src="/Application/Admin/Public/images/logo.png" alt=""></a>
        </div>
        <!--logo and iconic logo end-->
        <div class="left-side-inner">

            <!-- visible to small devices only -->

            <!--sidebar nav start-->
    <ul class="nav nav-pills nav-stacked custom-nav">
        <li class="active"><a href="<?php echo U('Index/index');?>"><i class="fa fa-home"></i> <span>首页</span></a></li>
            <?php if(is_array($OneAuth)): $i = 0; $__LIST__ = $OneAuth;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; $class=$vo['class_name']? $vo['class_name']:'fa-tasks';?>
			<li class="menu-list"><a href=""><i class="fa <?php echo ($class); ?>"></i> <span><?php echo ($vo["auth_name"]); ?></span></a>
                <ul class="sub-menu-list">
					<?php if(is_array($TowAuth)): $i = 0; $__LIST__ = $TowAuth;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo1): $mod = ($i % 2 );++$i; if($vo1['auth_pid']==$vo['auth_id']):?>
                    <li><a href="/index.php/Admin/<?php echo ($vo1["auth_c"]); ?>/<?php echo ($vo1["auth_a"]); ?>"><?php echo ($vo1["auth_name"]); ?></a></li>
					<?php endif; endforeach; endif; else: echo "" ;endif; ?>
                </ul>
            </li><?php endforeach; endif; else: echo "" ;endif; ?>   
    </ul>
            <!--sidebar nav end-->

    </div>
</div>
    <!-- left side end-->
    
    <!-- main content start-->
        <div class="main-content" >

        <!-- header section start-->
       <div class="header-section" style="background:#0ea699;">

            <!--toggle button start-->
            <a class="toggle-btn"><i class="fa fa-bars"></i></a>
            <!--toggle button end-->

            <!--search start-->
            <form class="searchform" action="index.html" method="post">
                <input type="text" class="form-control" name="keyword" placeholder="Search here..." />
            </form>
            <!--search end-->
<!--notification menu start -->
	<div class="menu-right">
        <ul class="notification-menu">
            <li style="margin-top:15px;"><a>清除缓存</a></li>
                   <li>
                        <a href="#" class="btn btn-default dropdown-toggle info-number" data-toggle="dropdown">
                            <i class="fa fa-tasks"></i>
                            <span class="badge">8</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-head pull-right">
                            <h5 class="title">You have 8 pending task</h5>
                            <ul class="dropdown-list user-list">
                                <li class="new">
                                    <a href="#">
                                        <div class="task-info">
                                            <div>Database update</div>
                                        </div>
                                        <div class="progress progress-striped">
                                            <div style="width: 40%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="40" role="progressbar" class="progress-bar progress-bar-warning">
                                                <span class="">40%</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="new">
                                    <a href="#">
                                        <div class="task-info">
                                            <div>Dashboard done</div>
                                        </div>
                                        <div class="progress progress-striped">
                                            <div style="width: 90%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="90" role="progressbar" class="progress-bar progress-bar-success">
                                                <span class="">90%</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <div class="task-info">
                                            <div>Web Development</div>
                                        </div>
                                        <div class="progress progress-striped">
                                            <div style="width: 66%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="66" role="progressbar" class="progress-bar progress-bar-info">
                                                <span class="">66% </span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <div class="task-info">
                                            <div>Mobile App</div>
                                        </div>
                                        <div class="progress progress-striped">
                                            <div style="width: 33%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="33" role="progressbar" class="progress-bar progress-bar-danger">
                                                <span class="">33% </span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <div class="task-info">
                                            <div>Issues fixed</div>
                                        </div>
                                        <div class="progress progress-striped">
                                            <div style="width: 80%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="80" role="progressbar" class="progress-bar">
                                                <span class="">80% </span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="new"><a href="">See All Pending Task</a></li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href="#" class="btn btn-default dropdown-toggle info-number" data-toggle="dropdown">
                            <i class="fa fa-envelope-o"></i>
                            <span class="badge">5</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-head pull-right">
                            <h5 class="title">You have 5 Mails </h5>
                            <ul class="dropdown-list normal-list">
                                <li class="new">
                                    <a href="">
                                        <span class="thumb"><img src="/Application/Admin/Public/images/photos/user1.png" alt="" /></span>
                                        <span class="desc">
                                          <span class="name">John Doe <span class="badge badge-success">new</span></span>
                                          <span class="msg">Lorem ipsum dolor sit amet...</span>
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                        <span class="thumb"><img src="/Application/Admin/Public/images/photos/user2.png" alt="" /></span>
                                        <span class="desc">
                                          <span class="name">Jonathan Smith</span>
                                          <span class="msg">Lorem ipsum dolor sit amet...</span>
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                        <span class="thumb"><img src="/Application/Admin/Public/images/photos/user3.png" alt="" /></span>
                                        <span class="desc">
                                          <span class="name">Jane Doe</span>
                                          <span class="msg">Lorem ipsum dolor sit amet...</span>
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                        <span class="thumb"><img src="/Application/Admin/Public/images/photos/user4.png" alt="" /></span>
                                        <span class="desc">
                                          <span class="name">Mark Henry</span>
                                          <span class="msg">Lorem ipsum dolor sit amet...</span>
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                        <span class="thumb"><img src="/Application/Admin/Public/images/photos/user5.png" alt="" /></span>
                                        <span class="desc">
                                          <span class="name">Jim Doe</span>
                                          <span class="msg">Lorem ipsum dolor sit amet...</span>
                                        </span>
                                    </a>
                                </li>
                                <li class="new"><a href="">Read All Mails</a></li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href="#" class="btn btn-default dropdown-toggle info-number" data-toggle="dropdown">
                            <i class="fa fa-bell-o"></i>
                            <span class="badge">4</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-head pull-right">
                            <h5 class="title">Notifications</h5>
                            <ul class="dropdown-list normal-list">
                                <li class="new">
                                    <a href="">
                                        <span class="label label-danger"><i class="fa fa-bolt"></i></span>
                                        <span class="name">Server #1 overloaded.  </span>
                                        <em class="small">34 mins</em>
                                    </a>
                                </li>
                                <li class="new">
                                    <a href="">
                                        <span class="label label-danger"><i class="fa fa-bolt"></i></span>
                                        <span class="name">Server #3 overloaded.  </span>
                                        <em class="small">1 hrs</em>
                                    </a>
                                </li>
                                <li class="new">
                                    <a href="">
                                        <span class="label label-danger"><i class="fa fa-bolt"></i></span>
                                        <span class="name">Server #5 overloaded.  </span>
                                        <em class="small">4 hrs</em>
                                    </a>
                                </li>
                                <li class="new">
                                    <a href="">
                                        <span class="label label-danger"><i class="fa fa-bolt"></i></span>
                                        <span class="name">Server #31 overloaded.  </span>
                                        <em class="small">4 hrs</em>
                                    </a>
                                </li>
                                <li class="new"><a href="">See All Notifications</a></li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            <img src="/Application/Admin/Public/images/photos/user-avatar.png" alt="" />
                                                           <?php echo session('adminname'); $admin_id=session('admin_id'); ?> 
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-usermenu pull-right">
                            <li><a href="<?php echo U('User/edit','',false);?>/admin_id/<?php echo ($admin_id); ?>"><i class="fa fa-user"></i>修改</a></li>
                            <li><a href="#"><i class="fa fa-cog"></i>设置</a></li>
                            <li><a href="<?php echo U('Index/outLogin');?>"><i class="fa fa-sign-out"></i>退出</a></li>
                        </ul>
                    </li>

                </ul>
            </div>
			    
<!--notification menu end -->

        </div>
        
        <!-- header section end-->
		
        <!--body wrapper start-->
		
<style type="text/css">
table{margin-top: -30px;}
tr{height: 35px;}
th{font-weight: bold;padding-top:18px;font-family:'微软雅黑';}
.yourclass{width: 300px;height: 150px;background: #5fb15b;text-align:center;color:white}
</style>
<div class="page-heading">
    <h3><?php echo ($title); ?></h3>
       <ul class="breadcrumb">
           <li><a href="javascript:void(0);">控制面板</a></li>
           <li><a href="<?php echo U('hdIndex');?>">返回</a></li>
           <li class="active"> Editable Table </li>
      </ul>
</div>

<div class="wrapper">
             <div class="row">
                <div class="col-sm-12">
                <section class="panel">
                <header class="panel-heading">
                    Editable Table
                    <span class="tools pull-right">
                        <a href="javascript:;" class="fa fa-chevron-down"></a>
                        <a href="javascript:;" class="fa fa-times"></a>
                     </span>
                </header>
                <div class="panel-body">
                <div class="adv-table editable-table ">
                <div class="clearfix">
                   
                </div>
                
        </div>
     </div>
<form id="form_data" action=" " method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo ($editData["id"]); ?>">    
 <table  style="width:50%;height:300px;margin-left:20px;font-size:16px">
    <tr><th>活动名称:</th></tr>
    <tr><td><input type="text" name="name" size="47" value="<?php echo ($editData["name"]); ?>" /> </td></tr>
    
    <tr><th>活动期数:</th></tr>
    <tr><td><input type="number" name="hdnum" min="1" max="30" value="<?php echo ($editData["hdnum"]); ?>" /> </td></tr>
    
    <tr><th>活动有效时间:</th></tr>
    <tr><td><input type="date" name="time" size="47" value="<?php echo ($editData["time"]); ?>" /> </td></tr>
  
    <tr><th>原价:</th></tr>
    <tr><td><input type="text" name="oprice" size="47" value="<?php echo ($editData["oprice"]); ?>" /> </td></tr>

    <tr><th>现实优惠价:</th></tr>
    <tr><td><input type="text" name="nprice" size="47" value="<?php echo ($editData["nprice"]); ?>" /> </td></tr>
 	  
    <tr><th>商品图片（点击进行删除，尺寸：490px*490px；最多6张）</th></tr>
	  <tr>
	  	<td>
	  <div style="border: 1px dashed; height:320px;width: 155%;text-align: center;background-color:#f3f3f3;">
      <div style="margin-top:10px;">
        <?php if(is_array($imgData)): $i = 0; $__LIST__ = $imgData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><span title="点击删除图片" id="<?php echo ($vo["id"]); ?>" class="pic" style="cursor: pointer;"><img src='/Public/Upload/<?php echo ($vo["img"]); ?>' width='100'></span><?php endforeach; endif; else: echo "" ;endif; ?>
      </div>
	  	<div style="width:98%;height: 90%;margin:10px auto;text-align: center;" id="pcs"></div>
		<div style="margin-top:-50px;">
	  	  <input onclick="$(this).parent().parent().find('#pcs').append('<span style=\'float:left\'><input  type=\'file\' name=\'pics[]\' id=\'file\' /><br/></span>')" type="button" value="点击添加图片" />
	  	</div>
	  </div>
	 </td>
	 </tr>
   <tr><th>品牌logo图片</th></tr>
   <tr><td><input type="file" name="brandimg" id="picture"/><img src="/Public/Upload/<?php echo ($editData["brandimg"]); ?>" id="ps" width='70px'></td></tr>
    
    <tr><th>活动列表单图片</th></tr>
    <tr><td><input type="file" name="listimg" id="logo"/><img src="/Public/Upload/<?php echo ($editData["listimg"]); ?>" id="po" width='70px'></td></tr>
    
    <tr><th>商品参数图片</th></tr>
    <tr><td><input type="file" name="pimg" id="pic"/><img src="/Public/Upload/<?php echo ($editData["pimg"]); ?>" id="pi" width='70px'></td></tr>

    <tr><th>等级（请填写数字，越高排名越前）:</th></tr>
    <tr><td><input type="text" name="lev" size="47" value="<?php echo ($editData["lev"]); ?>" /> </td></tr>
    
    <tr><th>商品详情描述:</th></tr>
    <tr><td><textarea name="content" id="content"><?php echo ($editData["content"]); ?></textarea></td></tr>
  <tr>
    <td colspan=2><input type="submit"  value="提交"/> &nbsp &nbsp &nbsp<input type="reset"  value="重置" /></td>
 	</tr>   
   	               
</table>
</form> 
</section>
<script type="text/javascript">
//jquerForm插件提交
actionForm("<?php echo U('hdEdit');?>","<?php echo U('hdIndex');?>");

//显示封面预览
$('#pic').change(function(){
  //获取图片文件
  var pic_file=this.files[0];
  //调用预览方法
  preview_pic(pic_file,'pi');
});

//显示封面预览
$('#picture').change(function(){
  //获取图片文件
  var pic_file=this.files[0];
  //调用预览方法
  preview_pic(pic_file,'ps');
});

//显示封面预览
$('#logo').change(function(){
  //获取图片文件
  var pic_file=this.files[0];
  //调用预览方法
  preview_pic(pic_file,'po');
});

//预览方法实现
function preview_pic(pic,s2){
  //通过html5的FileReader对象
  var r=new FileReader();
  r.readAsDataURL(pic);
  r.onload=function(){
    $('#'+s2).attr('src',this.result).show();
  }
}

//ajax删除单张图片数据
$('.pic').click(function(){
  if (confirm('确定要删除吗？')) {
        var id=$(this).attr('id');
        var sp=$(this);
        $.ajax({
          type:"get",
          url:"<?php echo U('ajaxDelImg','',false);?>/id/"+id+"/model/jcimg",
          dataType:"json",
          success:function(data){
              if(data.ok==1){
                     layer.open({
                      type: 1,
                      title:false,
                      closeBtn: 1,
                      shadeClose: true,
                      skin: 'yourclass',
                      content: '<h4 style="line-height:110px;">恭喜你,删除成功！</h4>'
                    });
                  //将该标签删除
                  sp.remove();
              }else{
                     layer.open({
                      type: 1,
                      title:false,
                      closeBtn: 1,
                      shadeClose: true,
                      skin: 'yourclass',
                      content: '<h3 style="line-height:105px;">删除失败！</h3>'
                    });
              }
          }
        });
  }
  
});

//在线编辑器
UE.getEditor('content', {
  "initialFrameWidth" : "90%",   // 宽
  "initialFrameHeight" : 400,      // 高
  "maximumWords" : 3000,// 最大可以输入的字符数量
  'scaleEnabled':true
});
</script>



 
		<footer>
            2018 &copy; AdminEx by <a href="http://www.jiajoo.com" target="_blank">家造网</a>
  		 </footer>       
        </div>
      
        <!--body wrapper end-->
    <!-- main content end-->
</section>

<!-- Placed js at the end of the document so the pages load faster -->
<script src="/Application/Admin/Public/js/jquery-ui-1.9.2.custom.min.js"></script>
<script src="/Application/Admin/Public/js/jquery-migrate-1.2.1.min.js"></script>
<script src="/Application/Admin/Public/js/bootstrap.min.js"></script>
<script src="/Application/Admin/Public/js/modernizr.min.js"></script>
<script src="/Application/Admin/Public/js/jquery.nicescroll.js"></script>

<!--easy pie chart-->
<script src="/Application/Admin/Public/js/easypiechart/jquery.easypiechart.js"></script>
<script src="/Application/Admin/Public/js/easypiechart/easypiechart-init.js"></script>

<!--Sparkline Chart-->
<script src="/Application/Admin/Public/js/sparkline/jquery.sparkline.js"></script>
<script src="/Application/Admin/Public/js/sparkline/sparkline-init.js"></script>

<!--icheck -->
<script src="/Application/Admin/Public/js/iCheck/jquery.icheck.js"></script>
<script src="/Application/Admin/Public/js/icheck-init.js"></script>

<!-- jQuery Flot Chart-->
<script src="/Application/Admin/Public/js/flot-chart/jquery.flot.js"></script>
<script src="/Application/Admin/Public/js/flot-chart/jquery.flot.tooltip.js"></script>
<script src="/Application/Admin/Public/js/flot-chart/jquery.flot.resize.js"></script>
<!--Morris Chart-->
<script src="/Application/Admin/Public/js/morris-chart/morris.js"></script>
<script src="/Application/Admin/Public/js/morris-chart/raphael-min.js"></script>

<!--Calendar-->
<script src="/Application/Admin/Public/js/calendar/clndr.js"></script>
<script src="/Application/Admin/Public/js/calendar/evnt.calendar.init.js"></script>
<script src="/Application/Admin/Public/js/calendar/moment-2.2.1.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.5.2/underscore-min.js"></script>

<!--common scripts for all pages-->
<script src="/Application/Admin/Public/js/scripts.js"></script>

<!--Dashboard Charts-->
<script src="/Application/Admin/Public/js/dashboard-chart-init.js"></script>

</body>
</html>