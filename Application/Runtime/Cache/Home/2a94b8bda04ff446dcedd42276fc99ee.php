<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php echo C('WEB_SITE_TITLE');?></title>
    <meta name="keywords" content="中山装修，中山装饰公司，中山装饰，中山装修网，中山装修报价，中山家装公司，中山装修公司">
    <meta name="description" content="特色698全包套餐,装修分期,45天标准工期,材料工厂直接采购,无中间商赚差价,免费一对一设计,各个镇区均配有体验店,一站式解决您的装修难题.服务热线:400-838-2229">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="/Public/Home/img/icon/favicon.ico" media="screen">
    <link rel="stylesheet" type="text/css" href="/Public/Home/css/style.css?v=1.0.7">
    <link rel="stylesheet" type="text/css" href="/Public/Home/css/index.css?v=1.0.8">
    <link rel="stylesheet" type="text/css" href="/Public/Home/css/stywor.css?v=1.0.1">
    <link rel="stylesheet" type="text/css" href="/Public/Home/css/effect_sub.css?v=1.1.9">
    <link rel="stylesheet" type="text/css" href="/Public/Home/css/college.css?v=1.0.1">
    <link rel="stylesheet" type="text/css" href="/Public/Home/css/news.css?v=1.0.3">
    <link rel="stylesheet" type="text/css" href="/Public/Home/css/special.css?v=1.1.4">
    <link rel="stylesheet" type="text/css" href="/Public/Home/css/stytea.css?v=1.0.1">
    <link rel="stylesheet" type="text/css" href="/Public/Home/css/build.css?v=1.0.1">
    <link rel="stylesheet" type="text/css" href="/Public/Home/css/brand.css?v=1.0.4" /> 
    <script type="text/javascript" src="/Public/Home/js/jquery.min.js?v=1.0.0"></script>
    <script type="text/javascript" src="/Public/Home/js/banner.js?1.0.2"></script>
    <script type="text/javascript" src="/Public/Home/js/jquery.SuperSlide.2.1.1.js"></script>
    <script type="text/javascript" src="/Public/Home/js/jquery.lazyload.min.js?v=1.0.0"></script>
    <script type="text/javascript" src="/Public/Home/js/scroll.js?v=1.0.2"></script>
      
<script>
    window.onload = function(){
        var ms = document.getElementById("mysteve");
        var add = document.getElementById("add");
        ms.onmouseover = function(){
            add.style.display = "block";
        };
        add.onmouseover = function(){
            add.style.display = "block";
        };
        ms.onmouseout = function(){
            add.style.display = "none";
        };
        add.onmouseout = function(){
            add.style.display = "none";
        };
    };
</script>
</head>
<body>
    <div class="head_top">
        <div>
            <div class="user_login">
             <?php  if(session('uid')){ ?>      
                    <a href="#" id="hear_user"><span>您好, <?php echo session('nickname'); ?>!</span></a>
                    <a href="<?php echo U('Member/logout');?>" id="hear_exit"><span>退出</span></a>
            <?php  }else{ ?>     
                
                    <a href="<?php echo U('Member/register');?>" id="hear_reg"><span>注册</span></a>
                    <a href="javascript:fromaaUrl()" id="hear_login"><span>登录</span></a>
            <?php } ?> 
            </div>
            <div class="head_memu">
                <a href="https://mall.jd.com/index-738854.html">京东旗舰店</a>
                <a href="<?php echo U('Hd/stages');?>" target="_blank">装修贷</a>
                <a href="<?php echo U('Hd/act868');?>" target="_blank">868套餐</a>
                <a href="http://www.kujiale.com/v/show/Jiajoo" rel="nofollow" target="_blank">效果图</a>
                <a href="<?php echo U('Hd/brand');?>" target="_blank">品牌故事</a>
                <a href="javascript:;" class="head_memu_wx">关注微信<img src="/Public/Home/img/icon/adr_wx.jpg" width="100" /></a>
                <a href="<?php echo U('article/invite');?>" target="_blank">招贤纳士</a>
                <a target="_blank" class="head_memu_wx">加盟热线：400-838-2229</a>
            </div>
        </div> 
    </div>
    <div class="header">
        <!-- 主菜单 -->
        <div class="logo clearfix">
            <h1><a href="<?php echo U('Index/index');?>"><img src="/Public/Home/img/icon/logo.jpg" alt="家造网"></a></h1>
            <p><span style="letter-spacing: 1.7px;">O2O一站式时尚家装平台</span><span>设计 / 主材 / 配送 / 施工 / 售后</span></p>
            <div class="telephone">
                <span>服务热线：</span>
                <a href="tel:4008382229">400-838-2229</a>
            </div>
        </div>
        <div class="menu_div clearfix">
            <ul class="menu" id="menu">
                <i class="scrollBottom"></i>
                <li class="menu_one"><a class="menu01" href="<?php echo U('Index/index');?>">首页</a></li>
                <li class="menu_other">
                    <a class="menu03" onclick="return false;" href="javascript:void(0)" target="_blank">全包套餐<img class="new-smdw" src="/Public/Home/img/head_por/new-sm.gif"><span class="menu_icon"></span></a>
                    <div>
                        <a href="<?php echo U('Hd/newact868');?>" target="_blank">868套餐<img class="new-cmdw" src="/Public/Home/img/head_por/new-cm.gif"></a>
                        <a href="<?php echo U('Hd/newact698');?>" target="_blank">698套餐</a>
                        <a href="<?php echo U('Hd/custom');?>" target="_blank">个性定制</a>
                    </div>
                </li>
                <li class="menu_other">
                    <a class="menu04" href="<?php echo U('Xgtu/effect?fg=30');?>" target="_blank">装修案例<span class="menu_icon"></span></a>
                    <div>
                        <a href="<?php echo U('Xgtu/effect?fg=30');?>" target="_blank">平面效果</a>
                        <a href="http://www.kujiale.com/v/show/Jiajoo" rel="nofollow" target="_blank">VR效果</a>
                    </div>
                </li>
                <li><a class="menu07" href="<?php echo U('Hd/standards');?>" target="_blank">装修标准</a></li>
                <li><a class="menu02" href="<?php echo U('Hd/stages');?>" target="_blank">装修贷</a></li>
                <li><a class="menu06" href="<?php echo U('Article/gonglve');?>" target="_blank">装修攻略</a></li>
                <li><a class="menu08" href="<?php echo U('Hd/join');?>" target="_blank">招商加盟</a></li>
                
                <li class="menu_other">
                    <a class="menu09" href="<?php echo U('Hd/brand');?>" target="_blank">关于家造网<span class="menu_icon"></span></a>
                    <div>
                        <a href="<?php echo U('Sg/shopnbclist');?>" target="_blank">线下体验馆</a>
                        <a href="<?php echo U('Hd/college');?>" target="_blank">商学院</a>
                        <a href="<?php echo U('Article/news');?>" target="_blank">公司新闻</a>
                        <a href="<?php echo U('Hd/brand');?>" target="_blank">品牌故事</a>
                        <a href="<?php echo U('article/invite');?>" target="_blank">招贤纳士</a>
                    </div>
                </li>
            </ul>
            <div class="award clearfix">
                <div class="bd">
                    <ul>
                        <li><a href="https://jiajoo.jd.com/" target="_blank"><img src="/Public/Home/img/icon/aw_03.gif?122" alt="9.9微礼包" /></a></li>
                        <li><a href="<?php echo U('Hd/listing');?>" target="_blank"><img src="/Public/Home/img/icon/aw_02.png?123" alt="家造网挂牌科技版" style="margin-top: 16px;" /></a></li>
                        <li><a href="javascript:;"><img src="/Public/Home/img/icon/aw_01.png?123" alt="中国好声音全国海选优秀赞助商" style="margin-top: 16px;" /></a></li>
                    </ul>
                </div>
                <a href="javascript:;" class="prev"></a>
                <a href="javascript:;" class="next"></a>
            </div>
        </div>
    </div>



<script type="text/javascript" src="/Public/Home/js/raphael-min.js"></script>
<script type="text/javascript" src="/Public/Home/js/zhongshanMap.js?v=8"></script>
<script type="text/javascript" src="/Public/Home/js/map.js"></script>

<script type="text/javascript">
	$(function(){
		$(".menu01").addClass("active");
	})
</script>

<div class="head clearfix">
	<div class="head_subsc_bg"></div>
	<div class="head_subsc">
		<div class="rhd">预约咨询设计师，3秒精准报价</div>
	    <form action="<?php echo U('Sg/postuser');?>" mini-form="fast-tenders" method="post" class="form_subscr" id="mytender8">
	    	<label>
	    		<input type="text" name="name" placeholder="您的姓名" class="allName" value="" >
	    	</label>
	        <label>
				<input type="text" name="mobile" placeholder="手机号码" class="allNum" />
	        	<span class="placeholdSpan">手机号码</span>
	        </label>
	        <label>
	        	<input type="hidden" name="from" value="" >
	        	<input type="button" value="立即咨询" class="design_release indexBtn" />
	        </label>
	    </form>
</div>
<div class="index_banner">
	<div class="bd">
		<ul class="banner_bd_ul">
			<li>
				<a href="<?php echo U('Hd/act20years');?>" target="_blank" style="background:url(/Public/Home/img/index/banner/banner-6.jpg) center center no-repeat"></a>
			</li>
			<li>
				<a href="<?php echo U('Hd/frist698');?>" target="_blank" style="background:url(/Public/Home/img/index/banner/banner-8.jpg?1230) center center no-repeat"></a>
			</li>
			<li>
				<a href="<?php echo U('Hd/newact868');?>" target="_blank" style="background:url(/Public/Home/img/index/banner/banner-2.jpg?123) center center no-repeat"></a>
			</li>
			<li>
				<a href="https://jiajoo.jd.com/" target="_blank" style="background:url(/Public/Home/img/index/banner/banner-1.jpg?13236) center center no-repeat"></a>
			</li>
			
			<li>
				<a href="<?php echo U('Hd/stages');?>" target="_blank" style="background:url(/Public/Home/img/index/banner/banner-3.jpg?1223) center center no-repeat"></a>
			</li>
			<li>
				<a href="<?php echo U('Hd/teststyle');?>" target="_blank" style="background:url(/Public/Home/img/index/banner/banner-5.jpg?22) center center no-repeat"></a>
			</li>
			<li>
				<a href="<?php echo U('Hd/quote');?>" target="_blank" style="background:url(/Public/Home/img/index/banner/banner-4.jpg?723) center center no-repeat"></a>
			</li>
		</ul>
	</div>
		<div class="hd">
			<ul class="banner_hd_ul">
				<li class="active"></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
			</ul>
		</div>
	</div>
</div>

<div class="ribbon w_1200 clearfix">
	<ul>
		<li class="ribbon_a_1">
			<a href="<?php echo U('Hd/quote');?>" target="_blank">
				<div><i></i><div></div></div>
				<span>免费报价</span>
				<p>3秒算出您家装修多少钱</p>
			</a>
		</li>
		<li class="ribbon_a_2">
			<a href="<?php echo U('Hd/subdes');?>" target="_blank">
				<div><i></i><div></div></div>
				<span>免费设计</span>
				<p>0元设计全屋平面及3D效果图</p>
			</a>
		</li>
		<li class="ribbon_a_3">
			<a href="<?php echo U('Hd/stages');?>" target="_blank">
				<div><i></i><div></div></div>
				<span>装修贷</span>
				<p>超低利息，助您装新家</p>
			</a>
		</li>
		<li class="ribbon_a_4">
			<a href="<?php echo U('Hd/insure');?>" target="_blank">
				<div><i></i><div></div></div>
				<span>装修保</span>
				<p>保障装修质量，24h金牌服务 </p>
			</a>
		</li>
	</ul>
</div>

<div class="bg_f7f7f7">
	<div class="favorable w_1200 clearfix">
		<a href="<?php echo U('Hd/newact868');?>" class="favor_left" target="_blank">
			<img data-src="/Public/Home/img/index/zxxget/combo_868.png" alt="868标准全包套餐" />
		</a>
		<a href="<?php echo U('Hd/newact698');?>" class="favor_right" target="_blank" style="padding-top: 4px;">
			<img data-src="/Public/Home/img/index/zxxget/combo_698.png" alt="698基础全包套餐" />
		</a>
		
	</div>
</div>

<div class="service w_1200 clearfix">
	<div class="titleAll">
		<h2>管家式服务流程</h2>
		<p>一站式的装修设计体验、超齐全的装修材料样品、个性化的一对一设计服务</p>
	</div>
	<ul>
		<li class="service_icon1">
			<a href="javascript:;"><div><i></i></div><p>项目预约<br />了解套餐</p></a>
		</li>
		<li class="service_icon2">
			<a href="javascript:;"><div><i></i></div><p>卖场体验<br />感知产品</p></a>
		</li>
		<li class="service_icon3">
			<a href="javascript:;"><div><i></i></div><p>3D替换<br />满意签约</p></a>
		</li>
		<li class="service_icon4">
			<a href="javascript:;"><div><i></i></div><p>上门复尺<br />动感设计</p></a>
		</li>
		<li class="service_icon5">
			<a href="javascript:;"><div><i></i></div><p>优选主材<br />准备开工</p></a>
		</li>
		<li class="service_icon6">
			<a href="javascript:;"><div><i></i></div><p>监理保障<br />上门验收</p></a>
		</li>
		<li class="service_icon7">
			<a href="javascript:;"><div><i></i></div><p>竣工验收<br />全程负责</p></a>
		</li>
	</ul>
</div>

<div class="bg_f7f7f7">
	<div class="styles w_1200 clearfix">
		<div class="titleAll">
			<h2>设计风格 / 效果图</h2>
			<p>海量装修美图，为新家找灵感！</p>
		</div>
		<div class="styles_slide clearfix">
			<a href="<?php echo U('Xgtu/effect?fg=5');?>" target="_blank">现代</a>
			<a href="<?php echo U('Xgtu/effect?fg=8');?>" target="_blank">中式</a>
			<a href="<?php echo U('Xgtu/effect?fg=13');?>" target="_blank">田园</a>
			<a href="<?php echo U('Xgtu/effect?fg=14');?>" target="_blank">欧式</a>
			<a href="<?php echo U('Xgtu/effect?fg=15');?>" target="_blank">古典</a>
			<a href="<?php echo U('Xgtu/effect?fg=17');?>" target="_blank">地中海</a>
			<a href="<?php echo U('Xgtu/effect?fg=18');?>" target="_blank">混搭</a>
		</div>
		<ul class="styles_flat clearfix">
			<li class="styles_img_1">
				<a href="http://www.kujiale.com/xiaoguotu/pano/3FO4EUOGSLHO" rel="nofollow" target="_blank">
					<img data-src="/Public/Home/img/index/3D/20170505421/img-g-2584132.jpg" alt="3D云设计" />
					<div></div>
					<p>现代简约-全景效果图</p>
				</a>
			</li>
			<li class="styles_img_2">
				<a href="http://www.kujiale.com/xiaoguotu/pano/3FO4EUNAFBEJ" rel="nofollow" target="_blank">
					<img data-src="/Public/Home/img/index/3D/20170505421/img-g-154689.jpg" alt="3D云设计" />
					<div></div>
					<p>欧色风格-全景效果图</p>
				</a>
			</li>
			<li class="styles_img_3">
				<a href="http://www.kujiale.com/xiaoguotu/pano/3FO4EUO4EOIW" rel="nofollow" target="_blank">
					<img data-src="/Public/Home/img/index/3D/20170505421/img-g-4879213.jpg" alt="3D云设计" />
					<div></div>
					<p>中式风格-全景效果图</p>
				</a>
			</li>
			<li class="styles_img_4">
				<a href="<?php echo U('Xgtu/effect?fg=30');?>" target="_blank">
					<img data-src="/Public/Home/img/index/effect/20170901032/img-879123213.jpg" alt="装修效果图" />
					<div></div>
					<p>装修效果图</p>
				</a>
			</li>
			<li class="styles_img_5">
				<a href="<?php echo U('Xgtu/effect?fg=30');?>" target="_blank">
					<img data-src="/Public/Home/img/index/effect/20170901032/img-84221387.jpg" alt="装修效果图" />
					<div></div>
					<p>装修案例图</p>
				</a>
			</li>
		</ul>
	</div>
</div>

<div class="advertisement">
	<div class="bd">
		<ul class="">
			<li>
				<a href="<?php echo U('Hd/brand');?>" target="_blank"><img data-src="/Public/Home/img/index/ad/201707231/img-ad-452654.jpg?23" alt="家造网发展历程"/></a>
			</li>
			<li>
				<a href="<?php echo U('Hd/join');?>" target="_blank"><img data-src="/Public/Home/img/index/ad/201707231/img-ad-689512.jpg?55" alt="诚邀加盟"/></a>
			</li>
			<li>
				<a href="<?php echo U('Hd/stages');?>" target="_blank"><img data-src="/Public/Home/img/index/ad/201707231/img-ad-858256.jpg?23" alt="装修贷款还能免息分期"/></a>
			</li>
		</ul>
	</div>
	<div class="hd">
		<ul>
			<li></li>
			<li></li>
			<li></li>
		</ul>
	</div>
</div>
<script type="text/javascript">
	jQuery(".advertisement").slide({mainCell:".bd ul",effect:"leftLoop",autoPlay:true,mouseOverStop:true,interTime:5000,switchLoad:"data-src"});
</script>

<div class="coopBrand w_1200 clearfix">
	<div class="titleAll">
		<h2>品牌主材展示</h2>
		<p>一、二线名优品牌质量保证，材料正品</p>
	</div>
	<ul class="coop_btn">
		<li class=""><a href="javascript:;">陶瓷</a>&emsp;/&emsp;</li>
		<li><a href="javascript:;">卫浴</a>&emsp;/&emsp;</li>
		<li><a href="javascript:;">地板</a>&emsp;/&emsp;</li>
		<li><a href="javascript:;">橱柜</a>&emsp;/&emsp;</li>
		<li><a href="javascript:;">门业</a>&emsp;/&emsp;</li>
		<li><a href="javascript:;">吊顶</a></li>
	</ul>
	<ul class="coop_bra clearfix">
		<li class="">
			<a href="<?php echo U('Sg/buildmerlist?bid=1');?>" target="_blank"><img data-src="/Public/Home/img/index/brand/1/a_1.png" alt="欧神诺陶瓷" /></a>
			<a href="<?php echo U('Sg/buildmerlist?bid=3');?>" target="_blank"><img data-src="/Public/Home/img/index/brand/1/a_2.png" alt="百和陶瓷" /></a>
			<a href="<?php echo U('Sg/buildmaterials');?>" target="_blank"><img data-src="/Public/Home/img/index/brand/1/a_6.png?6" alt="箭牌陶瓷" /></a>
		</li>
		<li>
			<a href="<?php echo U('Sg/buildmerlist?bid=54');?>" target="_blank"><img data-src="/Public/Home/img/index/brand/2/a_1.png" alt="爱马仕卫浴" /></a>
			<a href="<?php echo U('Sg/buildmerlist?bid=6');?>" target="_blank"><img data-src="/Public/Home/img/index/brand/2/a_2.png" alt="尚高卫浴" /></a>
			<a href="<?php echo U('Sg/buildmaterials');?>" target="_blank" class="last_li_a"><img data-src="/Public/Home/img/index/brand/2/a_4.png?6" alt="金海湾淋浴房" /></a>
		</li>
		<li>
			<a href="<?php echo U('Sg/buildmerlist?bid=10');?>" target="_blank"><img data-src="/Public/Home/img/index/brand/3/a_1.png" alt="马德兰地板" /></a>
			<a href="<?php echo U('Sg/buildmaterials');?>" target="_blank"><img data-src="/Public/Home/img/index/brand/3/a_2.png" alt="大自然地板" /></a>
			<a href="<?php echo U('Sg/buildmaterials');?>" target="_blank"><img data-src="/Public/Home/img/index/brand/3/a_3.png" alt="尚友地板" /></a>
		</li>
		<li>
			<a href="<?php echo U('Sg/buildmaterials');?>" target="_blank"><img data-src="/Public/Home/img/index/brand/4/a_5.png?6" alt="箭牌橱柜" /></a>
			<a href="<?php echo U('Sg/buildmaterials');?>" target="_blank"><img data-src="/Public/Home/img/index/brand/4/a_4.png?6" alt="碧乐橱柜" /></a>
			<a href="<?php echo U('Sg/buildmaterials');?>" target="_blank" class="last_li_a"><img data-src="/Public/Home/img/index/brand/4/a_2.png" alt="西雅橱柜" /></a>
		</li>
		<li>
			<a href="<?php echo U('Sg/buildmerlist?bid=29');?>" target="_blank"><img data-src="/Public/Home/img/index/brand/5/a_1.png" alt="富琦莱门业" /></a>
			<a href="<?php echo U('Sg/buildmerlist?bid=31');?>" target="_blank"><img data-src="/Public/Home/img/index/brand/5/a_2.png?6" alt="鸿润森林门业" /></a>
			<a href="<?php echo U('Sg/buildmaterials');?>" target="_blank"><img data-src="/Public/Home/img/index/brand/5/a_5.png" alt="柏泰安防" /></a>
		</li>
		<li>
			<a href="<?php echo U('Sg/buildmerlist?bid=51');?>" target="_blank"><img data-src="/Public/Home/img/index/brand/6/a_1.png" alt="巴迪斯吊顶" /></a>
			<a href="<?php echo U('Sg/buildmerlist?bid=52');?>" target="_blank"><img data-src="/Public/Home/img/index/brand/6/a_2.png" alt="奥斯美吊顶" /></a>
			<a href="<?php echo U('Sg/buildmerlist?bid=33');?>" target="_blank" class="last_li_a"><img data-src="/Public/Home/img/index/brand/6/a_3.png" alt="穗之杰吊顶" /></a>
		</li>
	</ul>
</div>

<div class="clientTalk">
	<div class="client_bg">
		<img data-src="/Public/Home/img/index/client/bg.jpg?555" alt="业主分享真实装修心得，客户的评价是我们的勋章" />
	</div>
	<div class="w_1200">
		<div class="client_right">
			<h2>客户说</h2>
			<p class="client_r_p">业主分享真实装修心得，客户的评价是我们的勋章。</p>
			<div class="client_r_br">
				<div class="bd">
					<ul>
						<li class=""><img src="/Public/Home/img/index/client/201708060/head-5445621.jpg"/></li>
						<li class="active"><img src="/Public/Home/img/index/client/2017651241/head-8262332.jpg"/></li>
						<li class="active"><img src="/Public/Home/img/index/client/2017092133/head-87231486.jpg"/></li>
						<li class="active"><img src="/Public/Home/img/index/client/201709078/head-987123213.jpg"/></li>
						<li class="active"><img src="/Public/Home/img/index/client/2017090712/head-87932213.jpg"/></li>
						<li class="active"><img src="/Public/Home/img/index/client/2017090714/head-54623189.jpg"/></li>
						<li class="active"><img src="/Public/Home/img/index/client/2017090791/head-65456123.jpg"/></li>
						<li class="active"><img src="/Public/Home/img/index/client/2017091239/head-5454124.jpg"/></li>
						<li class="active"><img src="/Public/Home/img/index/client/2017098512/head-546542138.jpg"/></li>
						<li class="active"><img src="/Public/Home/img/index/client/20170907165/head-212156.jpg"/></li>
						<li class="active"><img src="/Public/Home/img/index/client/20171023012/head-23545468.jpg"/></li>
						<li class="active"><img src="/Public/Home/img/index/client/20170907213/head-3255645.jpg"/></li>
					</ul>
				</div>
				<div class="fhd">
					<ul>
						<li class="active">
							<div class="client_r_ti">
								<p>缘来是你</p>
								<span>恒大绿洲 （89<b>㎡</b>）</span>
							</div>
							<div class="client_r_tx">本来装修想自己从头到尾操刀，无奈工作临时调动，每天忙得不可开交，只好把装修交给家装公司了，因为经费有限，在网上对比了很多公司的价格，看到这个868元/m2的套餐，主要看中性价比，有在合同上帮我备注零增项，这个承诺让我最满意，一点不弄虚作假，推荐给大家！</div>
							<img data-src="/Public/Home/img/index/client/201708060/img-89452123.jpg?1" lass="client_r_img" />
							<img data-src="/Public/Home/img/index/client/201708060/img-89823112ew.jpg?1" >
						</li>
						<li>
							<div class="client_r_ti">
								<p>林双木林</p>
								<span>金科时代 （120<b>㎡</b>）</span>
							</div>
							<div class="client_r_tx">服务很热情，设计图方案隔天就出来了，专业与技术都很过硬，不愧是做口碑的大公司，真的能够按你的构想设计出你想象的房子，同时也给出很多合理的建议，最重要的是材料特别好，也特别环保，装修交给他们后都可以轻松搞定了，剩下妥妥的放心，自己省心省力的。</div>
							<img data-src="/Public/Home/img/index/client/2017651241/img-75412218.jpg?1" lass="client_r_img" />
							<img data-src="/Public/Home/img/index/client/2017651241/img-863321125.jpg?1" >
						</li>
						<li>
							<div class="client_r_ti">
								<p>叶炳良</p>
								<span>板芙纯水岸 （109<b>㎡</b>）</span>
							</div>
							<div class="client_r_tx">我们是第一次装修，什么都不懂，幸好遇到了设计师小王特别负责任，性格又好。一开始的时候还挺不放心的，觉得交钱交的太快了，好在他们做事情很利索，我们想着早点干完早点散散气，早点入住，当初承诺60天工期，实际50多天就搞好了，要是有朋友装会给介绍的。</div>
							<img data-src="/Public/Home/img/index/client/2017092133/img-7845124.jpg?1" lass="client_r_img" />
							<img data-src="/Public/Home/img/index/client/2017092133/img-987521354.jpg?1" >
						</li>
						<li>
							<div class="client_r_ti">
								<p>向阳生长</p>
								<span>蓝天金地 （86<b>㎡</b>）</span>
							</div>
							<div class="client_r_tx">施工的工人每天都好辛苦，但服务态度还是很好，他们公司对施工很看重，项目经理和监理人员都积极配合，各个环节衔接得很好，每天监理都会发施工现场的图片给我，保证我清楚的知道今天的施工进程，果然没选错！</div>
							<img data-src="/Public/Home/img/index/client/201709078/img-23165478.jpg?1" lass="client_r_img" />
							<img data-src="/Public/Home/img/index/client/201709078/img-78922654.jpg?1" >
						</li>
						<li>
							<div class="client_r_ti">
								<p>林小武</p>
								<span>华发四季 （116<b>㎡</b>）</span>
							</div>
							<div class="client_r_tx">本身我对装修一窍不通，所以刚开始经常自己跑到现场去监督装修进程，没想到设计师还会来我家工地上亲自检查，并经常会和我沟通细节，还有专业的监理监督，后来我就基本不去看现场了。现在已经快完工了，看着自己的新家，特别感谢家造网。</div>
							<img data-src="/Public/Home/img/index/client/2017090712/img-1230546.jpg?1" lass="client_r_img" />
							<img data-src="/Public/Home/img/index/client/2017090712/img-78454545.jpg?1" >
						</li>
						<li>
							<div class="client_r_ti">
								<p>老范</p>
								<span>南朗盈彩美地 （92<b>㎡</b>）</span>
							</div>
							<div class="client_r_tx">他们的施工团队管理很规范，我也会经常去看看工地，他们下班后都会将工地整洁后才会走。有次瓦工那边出了点问题，我没提，心想他们会不会也糊弄过去，第三天再去看的时候，已经修复好了。虽然现在还没完工，但是我很期待完工后的效果。</div>
							<img data-src="/Public/Home/img/index/client/2017090714/img-7895213.jpg?1" lass="client_r_img" />
							<img data-src="/Public/Home/img/index/client/2017090714/img-8796132.jpg?1" >
						</li>
						<li>
							<div class="client_r_ti">
								<p>超超俊</p>
								<span>港口裕港豪庭 （109<b>㎡</b>）</span>
							</div>
							<div class="client_r_tx">房子是我们的婚房，我对环保和质量比较重视，朋友就是在这家公司装的，我觉得挺不错的，就询问了下。特地去他们门店了解他们的施工工艺和看了他们的材料展厅，都是一线的大牌，选的箭牌的卫浴，欧神诺的瓷砖，还可以做定制的，各个细节都做得很棒，满分。</div>
							<img data-src="/Public/Home/img/index/client/2017090791/img-45546875.jpg?1" lass="client_r_img" />
							<img data-src="/Public/Home/img/index/client/2017090791/img-4554621387.jpg?1" >
						</li>
						<li>
							<div class="client_r_ti">
								<p>我的未来不是梦</p>
								<span>正和中州 （113<b>㎡</b>）</span>
							</div>
							<div class="client_r_tx">我喜欢极简的设计风格，装饰的部位要少，但是在颜色和布局上，在装修材料的选择配搭上需要费很大的劲，这是一种境界。跟设计师只是简单谈了下我的想法，没想到给我设计的这一组效果正好就是我满意的，果然专业的人做专业的事。</div>
							<img data-src="/Public/Home/img/index/client/2017091239/img-79845213.jpg?1" lass="client_r_img" />
							<img data-src="/Public/Home/img/index/client/2017091239/img-7983123846.jpg?1" >
						</li>
						<li>
							<div class="client_r_ti">
								<p>Peter</p>
								<span>火炬御龙坊 （84<b>㎡</b>）</span>
							</div>
							<div class="client_r_tx">房子面积比较小，为了后期省心，选了好久，最终定在这个公司，果然没有让我失望，套餐实惠不失质量，从设计师到施工队都很认真负责，有问题及时解决，很适合手头不宽裕的人，感觉捡了大便宜，很满意的一次装修历程。</div>
							<img data-src="/Public/Home/img/index/client/2017098512/img-87712879.jpg?1" lass="client_r_img" />
							<img data-src="/Public/Home/img/index/client/2017098512/img-987231231.jpg?1" >
						</li>
						<li>
							<div class="client_r_ti">
								<p>雾里看花</p>
								<span>中山奥园 （104<b>㎡</b>）</span>
							</div>
							<div class="client_r_tx">设计师小刘很专业，尽心负责，有耐心，上次碰到吊顶细节云里雾里的时候，能耐心讲解到我们弄明白，整个施工过程也没有增项，包括材料配送都很及时，完全没有耽误工期，碰到问题能及时处理，热情耐心，报价也很透明，超满意的！</div>
							<img data-src="/Public/Home/img/index/client/20170907165/img-485154.jpg?1" class="client_r_img" />
							<img data-src="/Public/Home/img/index/client/20170907165/img-2782123.jpg?1" />
						</li>
						<li>
							<div class="client_r_ti">
								<p>小锅锅</p>
								<span>东升丽景城 （91<b>㎡</b>）</span>
							</div>
							<div class="client_r_tx">我最满意的是他们的服务，从前期去门店咨询销售、到后面接触设计师、负责施工的师傅、甚至是售后，验房后才发现点小问题，打电话给他们，第二天就过来解决了问题。而且都是笑脸迎人，不会摆脸色给我们看，非常感谢。</div>
							<img data-src="/Public/Home/img/index/client/20171023012/img-1123546.jpg?1" class="client_r_img" />
							<img data-src="/Public/Home/img/index/client/20171023012/img-872554213.jpg?1" />
						</li>
						<li>
							<div class="client_r_ti">
								<p>徐旭</p>
								<span>南区盈悦新城 （102<b>㎡</b>）</span>
							</div>
							<div class="client_r_tx">房子收楼之后，手头不宽裕，一直没有装修，那次路过他们门店看到698元/m2的套餐，就进去了解下，店长跟我说在这里办装修贷还补贴2000元，这么大的诱惑我还是再回去考虑了几天才定下来，办理贷款也很快批下来了，开工一段时间了，期待能尽快入住！</div>
							<img data-src="/Public/Home/img/index/client/20170907213/img-32314654.jpg?1" class="client_r_img" />
							<img data-src="/Public/Home/img/index/client/20170907213/img-65332123.jpg?1" />
						</li>
					</ul>
				</div>
				<a href="javascript:;" class="prev"></a>
				<a href="javascript:;" class="next"></a>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	jQuery(".client_right").slide({ mainCell:".bd ul", effect:"leftLoop",vis:4, autoPlay:false});
</script>

<div class="experience clearfix">
	<div class="w_1200">
		<div class="titleAll">
			<h2>线下体验馆</h2>
			<p>多家实体体验馆，让装修更有保障！</p>
		</div>
		<!-- <a href="<?php echo U('Sg/shopnbclist');?>" target="_blank" class="titleAll_more">了解更多&gt;</a> -->
		<br />
		<div class="experWrap">
	       	<a href="<?php echo U('Sg/shopnbclist');?>" target="_blank">
	       		<div id="zhongshanMap"></div>
	            <pre class="brush:js"></pre>
			    <!-- <div class="addIcon"></div> -->
	       	</a>
		</div>
		<div class="experText">
			<p class="experText_p1">家造网已成功布局<span> 14 </span>家线下体验馆</p>
			<p class="experText_p2">家造网计划在2017年底前完成全中山体验馆布点工作，力求城区及每个镇区都有线下体验馆。2018年，范围将扩大到附近城市，如江门、阳江、清远。</p>
			
			<div class="experText_dvi1"><div></div>已开业</div>
			<div class="experText_dvi2"><div></div>装修中</div>
			<div class="experText_dvi3"><div></div>筹建中</div>
		</div>
	</div>
	<script type="text/javascript">
	    $('#zhongshanMap').SVGMap({
	        stateTipHtml: function(stateData, obj){
	            return '<p>' + obj.name + '</p>' + '地址：' + obj.address;
	        }
	    });
	</script>
</div>

<div class="bg_f7f7f7">
	<div class="aboutJia w_1200 clearfix">
		<div class="titleAll">
			<h2>关于家造网</h2>
			<p>家造网O2O一站式时尚家装平台，一步一脚印，树立发展里程碑</p>
		</div>
		<ul>
		<?php if(is_array($guanyu)): $i = 0; $__LIST__ = array_slice($guanyu,0,3,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
				<a href="/index.php/Home/<?php echo ($vo["url"]); ?>" target="_blank">
					<div class="aboutj_img"><img data-src="/Public/Upload/guanyu/<?php echo ($vo["logo"]); ?>" title="<?php echo ($vo["title"]); ?>" /></div>
					<div class="aboutj_d">
						<p class="abuotj_ti clearfix"><span><?php echo ($vo["title"]); ?></span><small><?php echo ($vo["getdate"]); ?></small></p>
						<p class="abuotj_tx"><?php echo ($vo["desc"]); ?></p>
					</div>
				</a>
			</li><?php endforeach; endif; else: echo "" ;endif; ?>
		</ul>
	</div>
</div>

<div class="stratIn">
	<div class="w_1200">
		<div class="titleAll">
			<h2>装修攻略</h2>
			<p>学习实用装修经验，避免装修猫腻！</p>
			<a href="<?php echo U('Article/gonglve');?>" target="_blank" class="titleAll_more">更多&gt;&gt;</a>
		</div>
		<ul>
			<?php if(is_array($gllist)): $i = 0; $__LIST__ = $gllist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="clearfix">
				<a href="<?php echo U('Article/newstext',array('id'=>$vo['id']));?>" target="_blank">
					<div class="stratin_w_img"><img data-src="/Public/Upload/<?php echo ((isset($vo['pic']) && ($vo['pic'] !== ""))?($vo['pic']):'/Public/Home/img/news/1.png'); ?>" alt="装修攻略-<?php echo ($vo["title"]); ?>" /></div>
					<div class="stratin_w_div">
						<p class="stratin_w_ti"><?php echo ($vo["title"]); ?></p>
						<p class="stratin_w_tx"><?php echo ((isset($vo["description"]) && ($vo["description"] !== ""))?($vo["description"]):"一站式流程装修服务平台，装修分期，零首付、零利息 www.jiajoo.com"); ?></p>
					</div>
				</a>
			</li><?php endforeach; endif; else: echo "" ;endif; ?>
		</ul>
	</div>
</div>

<div class="newsIn w_1200 clearfix">
	<div class="titleAll">
		<h2>新闻中心</h2>
		<p>关注新闻，了解家造网动态。</p>
		<a href="<?php echo U('Article/news');?>" target="_blank" class="titleAll_more">更多&gt;&gt;</a>
	</div>
	<ul>
		<?php if(is_array($newList)): $i = 0; $__LIST__ = $newList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
			<a href="<?php echo U('Article/newstext',array('id' => $vo['id']));?>" target="_blank">
				<span><?php echo date('m/d',$vo['create_time'])?></span>
				<p class="newsin_ti"><?php echo ($vo["title"]); ?></p>
				<p class="newsin_tx"><?php echo ((isset($vo["description"]) && ($vo["description"] !== ""))?($vo["description"]):"一站式流程装修服务平台，装修分期，零首付、零利息 www.jiajoo.com"); ?></p>
			</a>
		</li><?php endforeach; endif; else: echo "" ;endif; ?>
	</ul>
</div>

<div class="footer_5a">
	<div class="w_1200">
		<p class="f_5a_tit"><span>互联网家装<br />5A平台</span></p>
		<div class="f_5a_div clearfix">
			<div class="f_5a_div_1">
				<i class="footer_1"></i>
				<p>A级</p>
				<p>施工质量</p>
			</div>
			<div class="f_5a_div_2">
				<i class="footer_2"></i>
				<p>A级</p>
				<p>垂直管理</p>
			</div>
			<div class="f_5a_div_3">
				<i class="footer_3"></i>
				<p>A级</p>
				<p>标准工艺</p>
			</div>
			<div class="f_5a_div_4">
				<i class="footer_4"></i>
				<p>A级</p>
				<p>大牌材料</p>
			</div>
			<div class="f_5a_div_5">
				<i class="footer_5"></i>
				<p>A级</p>
				<p>售后服务</p>
			</div>
		</div>
	</div>
</div>


<div id="footer">
    <div class="footer clearfix">
        <div class="footer_rela">
            <em class="f_cont_title">联系我们</em>
            <p>地址：广东省中山市火炬开发区孙文东路851号鼎峰时代大厦三楼</p>
            <p>服务热线：400-838-2229&nbsp;&nbsp;&nbsp;&nbsp;售后电话：0760-85338839</p>
            <p>加盟热线：400-838-2229</p>
            <p>E-mail：jsd@jiajoo.com</p>
        </div>
        <div class="f_ewm">
            <p><em class="f_cont_title f_title">关注我们</em></p>
            <p>
                <span><img src="/Public/Home/img/icon/jdsc.jpg" width="83">京东商城</span>
                <span><img src="/Public/Home/img/icon/adr_wx.jpg" width="83">官方微信</span>
                <span><img src="/Public/Home/img/icon/adr_weibo.jpg" width="83">官方微博</span>
            </p>
        </div>
    </div>
    <div class="footer_friend">
        友情连接：
        <!-- <a rel="nofollow" href="http://wpa.qq.com/msgrd?V=1&amp;uin=3245038281&amp;Site=-&amp;Menu=yes" target="_blank" style="float:right;margin:0;"> <span></span>友链合作&gt;&gt;</a> -->
        <br />
        <!-- 模板中实例化控制器 -->
        <?php echo R('Footlink/linkList','','Widget');?>
    </div>
</div>
<div class="footer_font">
    <div class="footer_bot clearfix">
        <span>Copyright © 2015 广东家时代装饰科技股份有限公司  版权所有</span>
        <span>
            <a href="http://www.miitbeian.gov.cn/" rel="nofollow" target="_blank">粤ICP备15087169号-3</a>
        </span>
    </div>
</div>
<div class="man_menu">
    <a href="javascript:;" onclick="hz6d_is_exist('setIsinvited()%3Bwindow.open(#liyc#https%3A%2F%2Fwww16.53kf.com%2FwebCompany.php%3Farg%3D10164577%26style%3D1%26language%3Dzh-cn%26charset%3Dgbk%26kflist%3Doff%26kf%3D826088521%40qq.com%2C3245038281%40qq.com%26zdkf_type%3D1%26referer%3Dhttp%253A%252F%252Fwww.abc.com%252Fhome%252Fxgtu%252Feffect.html%2523%2523%2523%26keyword%3D%26tfrom%3D1%26tpl%3Dcrystal_blue%26uid%3D98acce75e985e4778e6ee2ea71e571d3#liyc#%2C%20#liyc#_blank#liyc#%2C%20#liyc#height%3D600%2Cwidth%3D800%2Ctop%3D50%2Cleft%3D200%2Cstatus%3Dyes%2Ctoolbar%3Dno%2Cmenubar%3Dno%2Cresizable%3Dyes%2Cscrollbars%3Dno%2Clocation%3Dno%2Ctitlebar%3Dno#liyc#)');"  rel="nofollow" class="man_se">
        <i></i>
        <span>在线客服</span>
    </a>
    <a href="<?php echo U('Hd/subdes');?>" target="_blank" class="man_dis">
        <i></i>
        <span>免费设计</span>
    </a>
    <a href="<?php echo U('Hd/quote');?>" target="_blank" class="man_quo">
        <i></i>
        <span>免费报价</span>
    </a>
    <a href="javascript:;" class="man_wx">
        <i></i>
        <span>关注我们</span>
        <div>
            <img src="/Public/Home/img/icon/adr_wx.jpg" />
            <span>关注我们了解更多装修知识</span>
        </div>
    </a>
    <a href="javascript:;" class="pro_subs">
        <i></i>
        <span>立即预约</span>
    </a>
    <a href="javascript:;" class="go_top">
        <i></i>
        <span>返回顶部</span>
    </a>
</div>
</body>
</html>

<script>
(function() {var _53code = document.createElement("script");_53code.src = "https://tb.53kf.com/code/code/10164577/1";var s = document.getElementsByTagName("script")[0]; s.parentNode.insertBefore(_53code, s);})();
</script>

<script>
// 荣誉滚动  
jQuery(".award").slide({mainCell:".bd ul",autoPlay:true,mouseOverStop:true,interTime:5000});

// 登陆获取来源链接
function fromaaUrl(){
    self.location = "<?php echo U('Member/login');?>?ReturnUrl=" + encodeURIComponent(location.href);
}

(function(){

    var bp = document.createElement('script');
    var curProtocol = window.location.protocol.split(':')[0];
    if (curProtocol === 'https') {
        bp.src = 'https://zz.bdstatic.com/linksubmit/push.js';        
    }
    else {
        bp.src = 'http://push.zhanzhang.baidu.com/push.js';
    }
    var s = document.getElementsByTagName("script")[0];
    s.parentNode.insertBefore(bp, s);
})();

$(function() {
    $("img[data-src]").lazyload({effect: "fadeIn"});
});
</script>
<script type="text/javascript" src="/Public/Home/js/style.js?v=1.0.2"></script>
<script type="text/javascript" src="/Public/Home/js/index.js?v=1.0.2"></script>
<script type="text/javascript" src="/Public/Home/js/scrollBar.js?v=1.0.0"></script>
<script>
    /**百度统计**/
var _hmt = _hmt || [];
(function() {
    var hm = document.createElement("script");
    hm.src = "https://hm.baidu.com/hm.js?eada5bbc482e16b735054cd49e54fee4";
    var s = document.getElementsByTagName("script")[0];
    s.parentNode.insertBefore(hm, s);
})();
    /**百度统计**/
</script>