<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>登陆——家造网</title>
    <meta name="keywords" content="中山装修，装修分期，0首付装修，中山家装，时尚家装，中山装修装饰平台，中山装修设计效果图">
    <meta name="description" content="中山装修独立式流程装修服务平台，装修贷，零首付、零利息。家居软装饰品搭配，中山装修装饰平台，时尚家装的O2O平台。">
    <link rel="shortcut icon" type="image/x-icon" href="/Public/Home/img/icon/favicon.ico" media="screen">
    <link rel="stylesheet" type="text/css" href="/Public/Home/css/style.css?v=1.0.2" />
    <link rel="stylesheet" type="text/css" href="/Public/Home/css/login.css?v=1.0.1" />
    <script type="text/javascript" src="/Public/Home/js/jquery.min.js?v=1.0.0"></script>
    <script type="text/javascript" src="/Public/Home/js/index.js?v=1.0.0"></script>
    <script type="text/javascript" src="/Public/Home/js/login.js?v=1.0.0"></script>
</head>
<body>
<div class="logo clearfix">
    <h1><a href="<?php echo U('Index/index');?>"><img src="/Public/Home/img/icon/logo.jpg" alt="家造网" /></a></h1>
    <p>服务热线：400-838-2229</p>
</div>
<div class="member">
    <div class="member_warp clearfix">
        <div class="member_login">
            <h3>手机号登陆</h3>
            <form action="<?php echo U('Member/login');?>" mini-form="fast-tenders" method="post" class="login" id="logina" >
                <!-- 提示语 -->
                <p class="login_hint"><span></span></p>
                <label>
                    <input type="text" name="mobile" placeholder="手机号码" />
                    <span class="placeholderA">手机号码</span>
                </label>
    
                <label>
                    <input type="password" name="password" placeholder="密码" autocomplete="off"/>
                    <span class="placeholderA">密码</span>
                </label>

                <label class="autologon">
                    <input type="checkbox" name="checkbox" />下次自动登陆
                </label>
                <a href="<?php echo U('Member/forgetpwd');?>" class="forget_pass">忘了密码？</a>
                <label>
                    <input type="submit" value="登&nbsp;陆" class="loginBtn" />
                </label>
            </form>
            <p class="newReg">还没有账号？<a href="<?php echo U('Member/register');?>">立即注册</a></p>
            <!--<iframe id="id_iframe" name="id_iframe" style="display:none;"></iframe>-->
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