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
.num{background:#34eb8a;margin:3px;width:20px;display:inline-block;padding-left:5px;color:#040906};
</style>
 <div class="page-heading">
     <h3><?php echo ($title); ?></h3>
        <ul class="breadcrumb"><li><a href="#">控制面板</a></li>
            <li><a href="#">启用</a></li>
            <li class="active">禁用</li>
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
                    <div class="btn-group">
                        <button id="editable-sample_new" class="btn btn-primary">
                          	<a href="<?php echo U('dadd');?>">新增 </a><i class="fa fa-plus"></i>
                        </button>
                    </div> 
                </div>
            <div style="float:right;margin-top:-40px;">
            	<form action="/index.php/Admin/Drawing/dindex" method="post">
	                <div class="clearfix" style="margin-bottom:15px;">
	                	 <input type="text" name="name" size="30" value="请输入名称"/>
	                    <div class="btn-group">
	                        <button id="editable-sample_new" class="btn btn-primary" type="submit">搜索</button>
	                    </div>
	                </div>
      			</form>
            </div>
      
                <div class="space15"></div>
                <table class="table table-striped table-hover table-bordered" id="editable-sample">
                <thead>
                <tr>
                    <th style="width:50px;">ID</th>
                    <th>名称</th>
                    <th>所属类别ID/名称</th>
                    <th>状态</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                
          		<?php if(is_array($draw_name)): $i = 0; $__LIST__ = $draw_name;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="">
                    <td style="width:20px;"><?php echo ($vo["id"]); ?></td>
                    <td><?php echo ($vo["name"]); ?></td>
                    <td><?php echo ($vo["fid"]); ?>/<?php echo ($vo["fname"]); ?></td>
                    <td>
                    	<?php if($vo['status']==1): ?><span style="color: green;">正常</span>
                    	<?php else: ?>
                    		<span style="color: red;">禁用</span><?php endif; ?>
                    </td>
                    <td style="color:green">
                    	<span style="cursor:pointer;" ><a href="<?php echo U('dindex','',false);?>/id/<?php echo ($vo["id"]); ?>/p/<?php echo I('get.p')?>">
                    	<?php if($vo['status']==1): ?>禁用
                    	<?php else: ?>
                    		启用<?php endif; ?>
                    	</a></span> |
                    	<span style="cursor:pointer;" ><a href="<?php echo U('dedit','',false);?>/id/<?php echo ($vo["id"]); ?>">修改</a></span> |
                    	<span vo="<?php echo ($vo["id"]); ?>" class="del"style="cursor:pointer;" >删除</span>
					</td>
                </tr><?php endforeach; endif; else: echo "" ;endif; ?>      
                </tbody>
           </table>

       <div style="margin-left:0px;"><?php echo $page_str;?></div>
        </div>
     </div>

<div id="tishi" style="width:1650px;height:50px;background:#f66b34;color:white;line-height:50px;position:fixed;top:80px;font-size:22px;padding-left:50px;display:none;"></div>     
</section>

<script src="/Application/Admin/Public/js/jquery-1.10.2.min.js"></script>
<script type="text/javascript">
$('.del').click(function(){
	var id=$(this).attr('vo');
	var tr=$(this).parent().parent();
	if(confirm('确定要删除吗？')){
		$.ajax({
			type:"get",
			url:"<?php echo U('ajaxDdel','',false);?>/id/"+id,
			dataType:"json",
			success:function(data){
				if(data.ok==1){
					tr.remove();
					$('#tishi').html('删除成功！');
					$('#tishi').fadeIn(1000);
					$('#tishi').fadeOut(3000);
				}else{
					$('#tishi').html('删除失败!');
					$('#tishi').fadeIn(1000);
					$('#tishi').fadeOut(3000);				
				}
			}
		});
	
	}	
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