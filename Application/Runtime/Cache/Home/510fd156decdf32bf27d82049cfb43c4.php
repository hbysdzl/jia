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
    <script type="text/javascript" src="/Public/Home/js/jquery.min.js?v=1.0.0"></script>
    <script type="text/javascript" src="/Public/Home/js/index.js?v=1.0.0"></script>
   
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
            <form action="<?php echo U('Member/register');?>" id="register" class="register" method="post" autocomplete="off" >
                <label>
                    <input type="text" name="name" placeholder="用户名" autocomplete="off" maxlength="8"/>
                    <span class="placeholderA">用户名</span>
                </label>
                <!-- 提示语 -->
                <p class="register_hint register_name"><span></span></p>

                <label>
                    <input type="text" id="mobile" name="mobile" placeholder="手机号码"/>
                    <span class="placeholderA">手机号码</span>
                </label>
                <!-- 提示语 -->
                <p class="register_hint register_mob"><span></span></p>

                <label>
                    <input type="password" name="password" placeholder="密码" autocomplete="off"/>
                    <span class="placeholderA">密码</span>
                </label>
                <!-- 提示语 -->
                <p class="register_hint register_pass"><span></span></p>

                <label>
                    <input type="password" name="password2" placeholder="确认密码" autocomplete="off"/>
                    <span class="placeholderA">确认密码</span>
                </label>
                <p class="register_hint register_pass2"><span></span></p>

                <label class="regVerify">
                    <input type="text" name="verify" placeholder="验证码" id="verify"/><a href="javascript:;" class="refrVerify refrVerify1">换一张</a>
                    <span class="placeholderA placeho_ver">验证码</span>
                </label>
                <p class="register_hint register_ver"><span></span></p>
                <!-- 验证码 -->
                <img class="refreshImg refrVerify1" src="<?php echo U('Member/verify');?>"/>

                <label class="regNoteVerify">
                    <input type="text" name="cap" placeholder="短信验证码" id="cap" />
                    <a href="javascript:;" class="refrVerify refrVerify2">获取验证码</a>
                    <span class="placeholderA placeho_ver">短信验证码</span>
                </label>
                <p class="register_hint register_note"><span></span></p>
                
                <label>
                    <input type="button" value="注&nbsp;&nbsp;册" class="registerBtn" >
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

    //父子派生选择器（不考虑层次）在#register内部获得input节点对象
    var username=$("#register input[name='name']");
    var usermob=$("#register input[name='mobile']");
    var usrpwd=$("#register input[name='password']");
    var usrpwd2=$("#register input[name='password2']");
    var regver=$("#register input[name='verify']");
    var usercap=$("#register input[name='cap']"); //短信验证码框

    //正则表达式

    /*
    var regAname = /^[A-Za-z0-9_\-\u4e00-\u9fa5]{4,8}$/;
    var regAmob = /^1[3|4|5|7|8][0-9]\d{4,8}$/;
    var regApass = /^[A-Za-z0-9_\-?\-!\-,\-.\/]{6,14}$/;
    */
</script>