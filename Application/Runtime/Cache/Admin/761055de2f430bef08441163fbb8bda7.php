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


  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="js/html5shiv.js"></script>
  <script src="js/respond.min.js"></script>
  <![endif]-->

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
		
<style>
#tabbar-div{font-size:18px;width:20%;height:30px;text-align:center;}
#tabbar-div ul li{list-style-type:none;float:left;line-height:28px;width:50%;cursor:pointer;border:1px #d8ef3a solid;}
.tab-front{background:#4ca90f;};
</style>
 <div class="page-heading">
 <h3><?php echo ($title); ?></h3>
 <ul class="breadcrumb">
    <li><a href="#">控制面板</a></li>
    <li><a href="<?php echo U('index','',false);?>/cat_id/<?php echo ($cat_id); ?>">返回</a></li>
    <li class="active"> Editable Table </li>
</ul>
</div>
<div class="wrapper">
    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
                <header class="panel-heading">
                    <span class="tools pull-right">
                        <a href="javascript:;" class="fa fa-chevron-down"></a>
                        <a href="javascript:;" class="fa fa-times"></a>
                    </span>
				<div id="tabbar-div">
					<ul>
						<li class="tab-front">基本信息</li>
						<li class="tab-back">扩展</li>
					
					</ul>
				</div>
                </header>
<form id="form_data">    
<table class="table_content" style="width:100%;height:750px;margin-left:10px;font-size:16px">
	<input type="hidden" name="category_id" value="<?php echo ($cat_id); ?>">
	<input type="hidden" name="id" value="<?php echo ($doc["id"]); ?>">
	<input type="hidden" name="cover_id" value="<?php echo ($doc["cover_id"]); ?>">
    <tr><td>文档标题:</td></tr>
   	<tr><td><input type="text" name="title" size="50" value="<?php echo ($doc["title"]); ?>"/></td></tr>
   	<tr><td>标识:</td></tr>
   	<tr><td><input type="text" name="name"  size="50"/ value="<?php echo ($doc["name"]); ?>"></td></tr>
    <tr><td>描述:</td></tr>
    <tr><td><textarea rows="8" cols="80" name="description"><?php echo ($doc["description"]); ?></textarea></td></tr>
     <tr><td>文章内容:</td></tr>
   	<tr><td><textarea id="document" name="document"><?php echo ($docContent["content"]); ?></textarea></td></tr>              
</table>

<table class="table_content" style="display:none;width:100%;height:700px;margin-left:10px;font-size:16px;">
	<tr><td>内容类型：&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
			<select name="type">
				<option value="0" <?php echo $doc['type']==0? 'selected="selected"':''?>>--请选择--</option>
				<option value="1" <?php echo $doc['type']==1? 'selected="selected"':''?>>目录</option>
				<option value="2" <?php echo $doc['type']==2? 'selected="selected"':''?>>主题</option>
				<option value="3" <?php echo $doc['type']==3? 'selected="selected"':''?>>段落</option>
			</select>

	</td></tr>
	<tr><td>浏览量：&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="text" name="view" value="<?php echo ($doc["view"]); ?>"></td></tr>
	<tr>
		<td>可见性：&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
			<?php if($doc['display']==1):?>
			<input type="radio" name="display" value="0">不可见&nbsp&nbsp&nbsp&nbsp
			<input type="radio" name="display" value="1" checked="checked">所有人可见
			<?php else:?>
			<input type="radio" name="display" value="0"checked="checked">不可见&nbsp&nbsp&nbsp&nbsp
			<input type="radio" name="display" value="1" >所有人可见
			<?php endif;?>
		</td>
	</tr>
	
	<tr>
		<td>数据状态：&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
			<?php if($doc['status']==1):?>
			<input type="radio" name="status" value="0">禁用&nbsp&nbsp&nbsp&nbsp
			<input type="radio" name="status" value="1" checked="checked">启用
			<?php else:?>
			<input type="radio" name="status" value="0" checked="checked">禁用&nbsp&nbsp&nbsp&nbsp
			<input type="radio" name="status" value="1" >启用
			<?php endif;?>
		</td>
	</tr>
	<tr>
		<td>优先级：&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
			<input type="text" name="level" value="<?php echo ($doc["level"]); ?>" >
		</td>
	</tr>
	<tr><td>封面:</td></tr>
	<tr><td><input type="file" name="img"></td></tr>
	
	<tr><td><?php ShowImage($docImg['imgurl'],250,200);?></td></tr>	 
</table>

<table>
	<tr>
      <td colspan=2><input type="button"  value="提交" id="tijiao"/> &nbsp &nbsp &nbsp<input type="reset"  value="重置" /></td>  
	</tr>
</table> 
</form> 
<div id="tishi" style="width:1650px;height:50px;background:#f66b34;color:white;line-height:50px;position:fixed;top:80px;font-size:22px;padding-left:50px;display:none"></div>     
</section>
<script src="/Application/Admin/Public/js/jquery-1.10.2.min.js"></script>

<script type="text/javascript">

// 点击按钮切换table
$("#tabbar-div ul li").click(function(){
	// 获取点击的是第几个按钮
	var i = $(this).index();
	// 显示第i个table
	$(".table_content").eq(i).show();
	// 隐藏其他的table
	$(".table_content").eq(i).siblings(".table_content").hide();
	// 把原来选中的取消选中状态
	$(".tab-front").removeClass("tab-front").addClass("tab-back");
	// 切换点击的按钮的样式为选中状态
	$(this).removeClass("tab-back").addClass("tab-front");
});

$('#tijiao').click(function(){
	var form = new FormData(document.getElementById("form_data"));
    $.ajax({
        url: "<?php echo U('ajaxEdit');?>",
        type: "post",
        data: form,
        dataType:"json",
        processData: false,
        contentType: false,
        success: function(data) {
        	if(data.ok==0){
				$('#tishi').html(data.error);
				$('#tishi').fadeIn(1000);
				$('#tishi').fadeOut(3000);
			}else{
				$('#tishi').html('操作成功正在跳转！');
				$('#tishi').fadeIn(1000);
				$('#tishi').fadeOut(3000);
				
					setTimeout(function(){
						location.href="<?php echo U('index','',false);?>/cat_id/"+<?php echo ($cat_id); ?>;
					},3000);
				
			}
        }
 
    });
	
});
//在线编辑器
UE.getEditor('document', {
	"initialFrameWidth" : "95%",   // 宽
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
<script src="/Application/Admin/Public/js/jquery-1.10.2.min.js"></script>
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