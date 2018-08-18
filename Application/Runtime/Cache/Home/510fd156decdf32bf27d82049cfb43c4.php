<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>注册账号——家造网</title>
    <meta name="keywords" content="中山装修，装修分期，0首付装修，中山家装，时尚家装，中山装修装饰平台，中山装修设计效果图">
    <meta name="description" content="中山装修独立式流程装修服务平台，装修贷，零首付、零利息。家居软装饰品搭配，中山装修装饰平台，时尚家装的O2O平台。">
    <link rel="shortcut icon" type="image/x-icon" href="/Public/Home/img/icon/favicon.ico" media="screen">
    <link rel="stylesheet" type="text/css" href="/Public/Home/css/style.css?v=1.0.2" />
    <link rel="stylesheet" type="text/css" href="/Public/Home/css/login.css?v=1.0.1" />
    <script src="http://libs.baidu.com/jquery/1.10.2/jquery.min.js"></script> 
    <script type="text/javascript" src="/Public/Home/js/jquery.min.js?v=1.0.0"></script>
    <script type="text/javascript" src="/Public/Home/js/jquery.form.js"></script>
    <script type="text/javascript" src="/Public/Home/js/register.js"></script>

</head>
<body>
<div class="logo clearfix">
    <h1><a href="<?php echo U('Index/index');?>"><img src="/Public/Home/img/icon/logo.jpg" alt="家造网" /></a></h1>
    <p>服务热线：400-838-2229</p>
</div>
<div class="member">
    <div class="member_warp clearfix">
        <div class="member_register">
            <h3>手机号注册</h3>
            <form action=" " id="register" class="register" method="post" autocomplete="off" >
                <label>
                    <input type="text" name="name" id="name" placeholder="用户名" autocomplete="off"/>
                    <!-- <span class="placeholderA">用户名</span> -->
                </label>
                <!-- 提示语 -->
                <p><span></span></p>

                <label>
                    <input type="text" name="mobile" id="mobile" placeholder="手机号码"/>
                    <!-- <span class="placeholderA">手机号码</span> -->
                </label>
                <!-- 提示语 -->
                <p class=""><span></span></p>

                <label>
                    <input type="password" name="password" id="password" placeholder="密码" autocomplete="off"/>
                    <!-- <span class="placeholderA">密码</span> -->
                </label>
                <!-- 提示语 -->
                <p class=""><span></span></p>

                <label>
                    <input type="password" name="password2" id="password2" placeholder="确认密码" autocomplete="off"/>
                    <!-- <span class="placeholderA">确认密码</span> -->
                </label>
                
                <p class=""><span></span></p>

                <label class="regVerify">
                    <input type="text" name="verify" placeholder="验证码" id="verify"/><a href="javascript:;" class="refrVerify refrVerify1">换一张</a>
                    <!-- <span class="placeholderA placeho_ver">验证码</span> -->
                </label>
               <!--  提示语 -->
                <p class=""><span id="e"></span></p>
                <!-- 验证码 -->
                  
                  <img class="refrVerify1" src="<?php echo U('Member/verify');?>" onclick="this.src='<?php echo U('Member/verify');?>'" />
                 <label class="regNoteVerify" style="display: none;">
                    <input type="text" name="cap" placeholder="短信验证码" /><a href="javascript:;" id="btn">发送短信</a>
                    <!-- <span class="placeholderA placeho_ver">短信验证码</span> -->
                 </label>
                 <!-- 提示语 -->
                <p><span id="cap"></span></p>
                
                <label>
                    <input type="submit" value="注&nbsp;&nbsp;册" class="registerBtn" >
                </label>
            </form>
            <p class="newReg">已注册账号，<a href="<?php echo U('Member/login');?>">立即登陆</a></p>
            <!-- <iframe id="id_iframe" name="register" style="display:none;"></iframe>  -->
        </div>
    </div>
</div>
<div class="member_foot">
    <p>
        <a href="<?php echo U('Index/index');?>">首页</a>|<a href="<?php echo U('Hd/brand');?>">关于我们</a>|<a href="<?php echo U('Hd/college');?>">商学院</a>|<a href="<?php echo U('Hd/act698');?>">装修套餐</a>|<a href="<?php echo U('Xgtu/effect');?>">装修效果图</a>|<a href="<?php echo U('article/gonglve');?>">装修攻略</a>|<a href="<?php echo U('Hd/join');?>">招商加盟</a>
    </p>
    <p>Copyright © 2015 广东家时代装饰科技股份有限公司&nbsp;&nbsp;版权所有&nbsp;&nbsp;粤ICP备15087169号-3</p>
</div>
</body>
</html>
<script type="text/javascript">
//点击切换验证码
 $('.refrVerify ').click(function(){
     $('.refrVerify1').attr('src',"<?php echo U('Member/verify');?>");
 });

</script>