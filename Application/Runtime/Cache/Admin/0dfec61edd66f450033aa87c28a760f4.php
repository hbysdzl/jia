<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="ThemeBucket">
    <link rel="shortcut icon" href="#" type="/Application/Admin/Public/image/png">

    <title>欢迎登陆家造网管理平台</title>

    <link href="/Application/Admin/Public/css/style.css" rel="stylesheet">
    <link href="/Application/Admin/Public/css/style-responsive.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
</head>

<body class="login-body">

<div class="container">

    <form class="form-signin" action="" method="post">
        <div class="form-signin-heading text-center">
            <h1 class="sign-title">家造网</h1>
            <img src="/Application/Admin/Public/images/login-logo.png" alt=""/>
        </div>
        <div class="login-wrap">
            <input type="text" class="form-control" placeholder="用户名" name="username">
            <input type="password" class="form-control" placeholder="密码" name="password">
			<input type="text" class="form-control" placeholder="验证码" name="code">
			<span><img src="<?php echo U('Login/code');?>" width="285" height="55" alt="CAPTCHA" border="1" onclick=this.src="<?php echo U('Login/code','',false);?>/"+Math.random() 
				style="cursor: pointer;" title="看不清？点击更换另一个验证码。" /><span>
            <input  class="btn btn-lg btn-login btn-block" type="button" id="btn" value="进入管理中心" style="font-size:25px;">
                <i class="fa fa-check"></i>
            </button>
		 
            <div class="registration">
                Not a member yet?
                <a class="" href="registration.html">
                   	注册
                </a>
            </div>
            <label class="checkbox">
                <input type="checkbox" value="remember-me"> 保存用户信息！
                <span class="pull-right">
                    <a data-toggle="modal" href="#myModal"> 忘记密码？</a>

                </span>
            </label>

        </div>
	</form>
        <!-- Modal -->
        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">忘记密码?</h4>
                    </div>
                    <div class="modal-body">
                        <p>输入您的电子邮件地址来重置您的密码！</p>
                        <input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">

                    </div>
                    <div class="modal-footer">
                        <button data-dismiss="modal" class="btn btn-default" type="button">返回</button>
                        <button class="btn btn-primary" type="button">提交</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal -->
</div>



<!-- Placed js at the end of the document so the pages load faster -->

<!-- Placed js at the end of the document so the pages load faster -->
<script src="/Application/Admin/Public/js/jquery-1.10.2.min.js"></script>
<script src="/Application/Admin/Public/js/bootstrap.min.js"></script>
<script src="/Application/Admin/Public/js/modernizr.min.js"></script>
<script type="text/javascript">
	$('#btn').click(function(){
		var from_data=$('.form-signin').serialize();
		$.ajax({
			type:"post",
			url:"<?php echo U('Login/ajaxLogin');?>",
			data:from_data,
			dataType:"json",
			success:function(data){
				if(data.ok==0){
					alert(data.error);
				}else{
					location.href="<?php echo U('Index/index');?>";
				}
			}
		});
	});
</script>
</body>
</html>