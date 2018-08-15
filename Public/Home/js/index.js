/* 
* @Author: Marte
* @Date:   2016-07-20 14:53:52
* @Last Modified by:   Marte
* @Last Modified time: 2017-11-16 15:18:55
*/

function isDigit(s){
    var patrn=/^[0-9]{1,20}$/;
    if (!patrn.exec(s)) return false;
    return true;
}

var wind = {
    succBack:function(data){
        if(data['data'] == 1){
            alert("预约成功");
            $("#mytender8 input[type='text']").val("");
            $(".h_p_b_fix").hide();
            $(".h_p_b_bg").hide();
            $(".stages_subs").hide();
        }else{
            alert("非常抱歉，预约失败！如您有任何问题可以咨询客服，感谢！");
        }
    },
    ajax:function(url, types, data, sback) {
        $.ajax({
            type: types,
            data: data,
            url: url,
            dataType: "json",
            success: sback
        });
    },
    ajaxGet:function(url, data, sback){
        wind.ajax(url,'get', data, sback);
    },
    ajaxPost:function(url, data, sback){
        wind.ajax(url,'post', data, sback);
    }

}

// 筛选---------
function Filter(a,b){
    var $ = function(e){return document.getElementById(e);}
    var ipts = $('filterForm').getElementsByTagName('input'),result=[];
    for(var i=0,l=ipts.length;i<l;i++){
        if(ipts[i].getAttribute('to')=='filter'){
            result.push(ipts[i]);
        }
    }
    if($(a)){
        $(a).value = b;
        for(var j=0,len=result.length;j<len;j++){

            if(result[j].value=='' || result[j].value=='0'){
                result[j].parentNode.removeChild(result[j]);
            }
        }
        document.forms['filterForm'].submit();
    }
    return false;
}
// 筛选-END----

// 
function inviteList() {
    var da = $(".invite_list_da"),
        ic = $(".invite_ic");
    $(".invite_list_ti").click(function() {
        $(this).find(ic).attr("class").indexOf("invite_ic2") > -1 ? (da.stop().slideUp(), ic.removeClass("invite_ic2")) : (da.stop().slideUp(), ic.removeClass("invite_ic2"), $(this).next(".invite_list_da").stop().slideDown(), $(this).find(".invite_ic").addClass("invite_ic2"));
    });
}

// 明星设计师- ----------
$(document).ready(function(){
    (function($) {
        $.fn.extend({
            showa: function(div) {
                var w = this.width(),
                    h = this.height(),
                    xpos = w / 2,
                    ypos = h / 2,
                    eventType = "",
                    direct = "";
                this.css({
                    "overflow": "hidden",
                    "position": "relative"
                });
                div.css({
                    "position": "absolute",
                    "top": this.width()
                });
                this.on("mouseenter mouseleave", function(e) {
                    var oe = e || event;
                    var x = oe.offsetX;
                    var y = oe.offsetY;
                    var angle = Math.atan((x - xpos) / (y - ypos)) * 180 / Math.PI;//目标的中心点的反正切值

                    if (angle > -45 && angle < 45 && y > ypos) {
                        direct = "down";
                    }
                    if (angle > -45 && angle < 45 && y < ypos) {
                        direct = "up";
                    }
                    if (((angle > -90 && angle < -45) || (angle > 45 && angle < 90)) && x > xpos) {
                        direct = "right";
                    }
                    if (((angle > -90 && angle < -45) || (angle > 45 && angle < 90)) && x < xpos) {
                        direct = "left";
                    }
                    move(e.type, direct)
                });

                function move(eventType, direct) {
                    if (eventType == "mouseenter") {
                        switch (direct) {
                            case "down":
                                div.css({
                                    "left": "0px",
                                    "top": h
                                }).stop(true, true).animate({
                                    "top": "0px"
                                }, 500);
                                break;
                            case "up":
                                div.css({
                                    "left": "0px",
                                    "top": -h
                                }).stop(true, true).animate({
                                    "top": "0px"
                                }, 500);
                                break;
                            case "right":
                                div.css({
                                    "left": w,
                                    "top": "0px"
                                }).stop(true, true).animate({
                                    "left": "0px"
                                }, 500);
                                break;
                            case "left":
                                div.css({
                                    "left": -w,
                                    "top": "0px"
                                }).stop(true, true).animate({
                                    "left": "0px"
                                }, 500);
                                break;
                        }
                    } else {
                        switch (direct) {
                            case "down":
                                div.stop(true, true).animate({
                                    "top": h
                                }, 500);
                                break;
                            case "up":
                                div.stop(true, true).animate({
                                    "top": -h
                                }, 500);
                                break;
                            case "right":
                                div.stop(true, true).animate({
                                    "left": w
                                }, 500);
                                break;
                            case "left":
                                div.stop(true, true).animate({
                                    "left": -w
                                }, 500);
                                break;
                        }
                    }
                }
            }
        });
    })(jQuery)

    $(".star_wrap").each(function(i){
        $(this).showa($(".star_inner").eq(i));
    });

    // 加盟合作品牌
    $(".join_br_a").each(function(i){
        $(this).showa($(".join_br_a_sp").eq(i));
    });

    $(".menuall a").mouseover(function(){
        $(this).addClass('active').siblings().removeClass("active");
    })
    $(".menuall1").mouseover(function(){
        $(this).addClass('active');
        $(".stystar_one").show();
        $(".stystar_two").hide();
    })
    $(".menuall2").mouseover(function(){
        $(this).addClass('active');
        $(".stystar_two").show();
        $(".stystar_one").hide();
    })
});
// 明星设计师- END----

// 菜单栏
$(function(){
    $(".menu_other").each(function(){
        $(this).hover(function(){
            $(this).find("div").stop().show().animate({opacity: 1}, 1000);
            $(this).addClass("menu_other1");
        },function(){
            $(this).find("div").stop().hide().animate({opacity: 0}, 100);;
            $(this).removeClass("menu_other1");
        })
    });

    $("#menu li").each(function(){
        var menuWidth = $(this).width();
        $(this).hover(function(){
            var index = $(this).index();
            var menuLeftCsa;
            var menuLeft = $(this).offset().left - $("#menu").offset().left;
            if (index == 1) {
                menuLeftCsa = - 4;
            }else{
                menuLeftCsa = menuLeft + 29.2;
            }
            $(".scrollBottom").stop().animate({width: menuWidth, left: menuLeftCsa,paddingLeft: 4, paddingRight: 4}, 300);
        },function(){
            $(".scrollBottom").stop().animate({width: 0, left: 0,paddingLeft: 0,paddingRight: 0}, 300);
        });
    })
})
// 菜单栏 END---

// 预约
$(function(){
    function formQuote(data){
        if(data['data'] == 1){
            alert("提交成功！");
            $("input[type='text']").val("");
            $(".login1,.login-bg,.login").hide();
        }else{
            alert("非常抱歉，预约失败！如您有任何问题可以咨询客服，感谢！");
        }
    }

    $(".allArea").blur(function(){
        var sarea = $("#mytender8 input[name='area']").val();
        if(!isDigit(sarea.replace(/\s+/g, ""))){
            $("#mytender8 input[name='area']").val('');
            alert("面积只能为数字！");
            return false;
        }
    });

    function formArea2(fc){
        var sarea = $(fc).find("input[name='area']");
        if(!isDigit(sarea.val().replace(/\s+/g, ""))){
            $("#mytender8 input[name='area']").val('');
            $(".sub_p_area").show();
            return false;
        }
        return true;
    }

    function formName(fc){
        var sna = $(fc).find("input[name='name']").val();
        if($.trim(sna)==""){
            alert("请填写您的姓名");
            return false;
        }
        return true;
    }

    function formName2(fc){
        var qna = $(fc).find("input[name='name']").val();
        if($.trim(qna)==""){
            $(".sub_p_name").show();
            return false;
        }
        return true;
    }

    function formMobile(fc){
        var smo = $(fc).find("input[name='mobile']").val();
        if(!(smo.length!=11||!(/^1[3|4|5|7|8][0-9]\d{4,8}$/.test(smo)))){
            return true;
        }else{
            alert("请输入正确的11位手机号码");
            return false;
        }
    }

    function formMobile2(fc){
        var qmo = $(fc).find("input[name='mobile']").val();
        if(!(qmo.length!=11||!(/^1[3|4|5|7|8][0-9]\d{4,8}$/.test(qmo)))){
            return true;
        }else{
            $(".sub_p_mobile").show();
            return false;
        }
    }

    function formMobile3(fc){
        var qmo = $(fc).find("input[name='mobile']").val();
        if(!(qmo.length!=11||!(/^1[3|4|5|7|8][0-9]\d{4,8}$/.test(qmo)))){
            return true;
        }else{
            $(".sub_p_mobile").show();
            return false;
        }
    }

    function formWork(fc){
        var sre = $(fc).find("input[name='addres']").val();
        if (sre == "") {
            alert("请选择地区");
            return false;
        }
        return true;
    }

    function formWork2(fc){
        var sre = $(fc).find("input[name='addres']").val();
        if (sre == "") {
            $(".sub_p_rema").show();
            return false;
        }
        return true;
    }

    function subHint(fc){
        $(fc).find("input").focus(function() {
            $(this).siblings('p').hide();
        });
    }

    // 其他页面
    $(".allBtn").click(function(){
        if (formName("#mytender8")){ 
            if(formMobile("#mytender8")){
                wind.ajaxPost("/home/sg/postuser", $('#mytender8').serialize(), wind.succBack);
            }
        }
    });

    // 首页
    $(".indexBtn").click(function(){
        if (formWork("#mytender8")){ 
            if(formMobile("#mytender8")){
                wind.ajaxPost("/home/sg/postuser", $('#mytender8').serialize(), wind.succBack);
            }
        };
    })

    // 报价
    $(".quoteBtn").click(function(){
        subHint("#mytender8");
        if (formWork2("#mytender8")){
            if (formName2("#mytender8")) {
                if (formArea2("#mytender8")) {
                    if (formMobile2("#mytender8")){
                        wind.ajaxPost("/home/hd/quote", $('#mytender8').serialize(), formQuote);
                        var resu =  $("#mytender8 input[name='area']").val()*868*1.2;
                        $(".quote_num span").text(resu.toFixed(1));
                    }
                }
            }
        }
    })

    // 设计
    $(".desiBtn").click(function(){
        subHint("#mytender8");
        if (formWork2("#mytender8")){
            if (formName2("#mytender8")) {
                if (formArea2("#mytender8")) {
                    if(formMobile3("#mytender8")){
                        wind.ajaxPost("/home/sg/postuser", $('#mytender8').serialize(), formQuote);
                    }
                }
            }
        }
    })

    // 其他表单-效果图
    $(".publicBtn").click(function(){
        subHint("#mytender9");
        if (formWork2("#mytender9")){
            if (formName2("#mytender9")) {
                if (formArea2("#mytender9")) {
                    if(formMobile3("#mytender9")){
                        wind.ajaxPost("/home/sg/postuser", $('#mytender9').serialize(), formQuote);
                    }
                }
            }
        }
    })

    // 其他表单-效果图
    $(".publicBtn2").click(function(){
        subHint("#mytender10");
        if (formWork2("#mytender10")){
            if (formName2("#mytender10")) {
                if (formArea2("#mytender10")) {
                    if(formMobile3("#mytender10")){
                        wind.ajaxPost("/home/sg/postuser", $('#mytender10').serialize(), formQuote);
                    }
                }
            }
        }
    })

    // input placeholder兼容ie
    function isPlaceholer(){
        var input = document.createElement('input');
        return "placeholder" in input;
    }
    if(!isPlaceholer()){
        var index = $(this);
        $(".placeholdSpan").css({
            display:'block'
        })
        $("#mytender8 input").keydown(function(){
            $(this).siblings('.placeholdSpan').css({
                display:'none'
            })                    
        })
        $(".sub_area li").click(function(){
            $("#mytender8 input[name='addres']").siblings('.placeholdSpan').css({
                display:'none'
            })
        })
        $("#mytender8 input").blur(function(){
            if($(this).val()==""){
                $(this).siblings('.placeholdSpan').css({
                    display:'block'
                })                      
            }
        })
    }
         
    $(".h_p_b_bg").height($(document).height());

    // 698预约
    $(".pro_subs").click(function() {
        $(".stages_subs,.h_p_b_bg,.h_p_b_fix").animate({
            opacity: 'toggle', 
            height: 'toggle'
        });
    });

    $(".stages_sBtn,.dt_subscribe,.hp_close,.calcuarea_btu,.stages_close").click(function(){
        $(".stages_subs,.h_p_b_bg,.h_p_b_fix").animate({
            opacity: 'toggle',
             height: 'toggle'
        });
    })

    // 底部获取报价
    $(".calcuarea_btu").click(function(){
        var h_txt = $(".calcuarea_p_area").val();
        if(!h_txt || !isDigit(h_txt)){
            $(".calcuarea_p_area").val('');
            alert("请填写您需要报价的建筑面积并且只能为整数！");
            return;
        }
        $(".h_p_area").val(h_txt);
    })

    var thewidth = $(document).width();
    $(".foot_fix").animate({"left":0,"width":"100%"},500);
    $(".f_fix_close").click(function(){
        $(".foot_fix").animate({"left":"-"+(thewidth-25)},500);
        $(this).hide();
        $(".f_fix_open").show();
    })

    $(".f_fix_open").click(function(){
        $(".foot_fix").animate({"left":0},500);
        $(this).hide();
        $(".f_fix_close").show();
    })
    // 底部获取报价 END---
})

// 首页轮播海报
$(function(){
    var len = $(".banner_bd_ul li").size();
    var clickFlag = true;//判断是否走完
    var index = 0,
        bannTimer,//自动轮播时间
        docuWidth,//当前屏幕宽度
        bannerWidth;//获取当前图片的宽度

    // 设置轮播li的宽度为当前屏幕的宽度，必须在前面，否则后面的定义bannerWidth获取不到宽度
    function bannWidth(){
        docuWidth = document.body.offsetWidth;
        $(".banner_bd_ul li").css({width: docuWidth});
    }
    bannWidth();
    bannerWidth = $(".banner_bd_ul li").eq(0).width();
    window.onresize = function(){
        clearInterval(bannTimer);
        bannWidth();
        bannerWidth = $(".banner_bd_ul li").eq(0).width();//窗口改变后重新获取当前图片的宽度
        tab();
        bannTimer = setInterval(autoBanner,5000);
    }

    $(".banner_hd_ul li").mouseover(function(){
        index = $(this).index();
        tab();
    })

    //克隆第一张图片
    $(".banner_bd_ul li").eq(0).clone().appendTo($(".banner_bd_ul"));
    // $(".banner_bd_ul li").eq(len-1).clone().prependTo($(".banner_bd_ul")).hide();

    function tab(){
        $(".banner_bd_ul").stop().animate({
            left: - bannerWidth * index
        },function(){
            clickFlag = true;
            
            if (index == len) {
                $(".banner_bd_ul").css("left",0)
                index = 0;
            }
        })
        if (index == len) {
            $(".banner_hd_ul li").eq(0).addClass("active").siblings().removeClass("active");
        }else{
            $(".banner_hd_ul li").eq(index).addClass("active").siblings().removeClass("active");
        }
    }

    function autoBanner(){
        index++;
        if (index > len) {
            index = 0;
        };
        tab();
    }
    
    function autoBannerPrev(){
        index--;
        if (index < 0) {
            index = len - 1;
            $(".banner_bd_ul").css("left", -bannerWidth * (len - 1))
        };
        tab();
    }

    $(".banner_next").on('click', function() {
        clearInterval(bannTimer);
        autoBanner();
    });
    $(".banner_prev").on('click', function() {
        clearInterval(bannTimer);
        autoBannerPrev();
    });

    bannTimer = setInterval(autoBanner,5000);
    $(".banner_bd_ul li,.banner_hd_ul").hover(function() {
        clearInterval(bannTimer);
    }, function() {
        bannTimer = setInterval(autoBanner,5000);
    });
})
// 首页轮播海报--END


// 首页效果
$(function(){
    
    // 地区选择
    $(".subWork").click(function() {
        $(".sub_area").slideDown();
        return false;
    });
    $(".sub_area li").click(function() {
        $(".sub_area").slideUp();
        $(".subWork").val($(this).text());
        return false;
    });
    $(document).click(function(){
        $(".sub_area").slideUp();
    })

    $(".banner_sub").each(function(){
        var getwlist = [];
        var wlistName, wlistDtae;

        wind.ajaxGet("/home/hd/wlist.html?act=c96bnT3s",{}, function(res){
            for(var i = 0; i < 10; i++){
                
                wlistName = res.data[i].slice(0, res.data[i].indexOf("&"));
                wlistDtae = res.data[i].slice(res.data[i].indexOf(";") + 1,res.data[i].indexOf("日") + 1);

                getwlist += '<li class="clearfix"><span>'+ wlistName +'</span><span>'+ wlistDtae +'</span><span>成功申请</span></li>';
            }
            $(".banner_sub").append(getwlist);
            // 滚动播放
            jQuery(".subdes").slide({mainCell:".bd ul",autoPlay:true,effect:"topMarquee",vis:3,interTime:50,trigger:"click"});
        });
    })

    // 品牌主材
    // $(".coop_bra a").hover(function() {
    //     $(this).find("div").stop().animate({opacity: 0.9}, 500);
    // }, function() {
    //     $(this).find("div").stop().animate({opacity: 0}, 500)
    // });

    $(".coop_btn a").click(function() {
        var index = $(this).parent().index();
        $(this).parent().addClass('active').siblings().removeClass('active');
        $(".coop_bra li").eq(index).addClass('active').siblings().removeClass('active');
    });

    // 客户说
    $(".client_r_br .bd li").click(function(){
        var index = $(this).index();
        if (index > 12) index = index - 12;
        
        $(this).removeClass('active').siblings().addClass('active');
        $(".client_r_br .fhd li").eq(index-1).addClass('active').siblings().removeClass('active');
        //局部延时加载方式
        $(".client_r_br .fhd img[data-src]").lazyload({effect: "show"});
    });

})
// 效果图动画效果--END--

// 名家访谈-----
$(function(){
    var len = $(".sty_bd a").size();
    var clickFlag = true;
    var picWidth = $(".sty_bd a").eq(0).width() + 60;
    var index = 0;
    $(".sty_bd a").clone().appendTo($(".sty_bd"));
    
    function tab(){
        $(".sty_bd").stop().animate({
            left:-picWidth * index
        },function(){
            clickFlag = true;
            if (index == len) {
                $(".sty_bd").css("left",0)
                index = 0;
            }
        })
    }
    $(".left_but").on("click",function(){
        if (clickFlag) {
            index--;
            if (index < 0) {
                index = len - 1;
                $(".sty_bd").css({
                    left: - picWidth * len
                })
            }
            tab();
            clickFlag = false;
        }
    })
    function nextA(){
        index++;
        tab();
        clickFlag = false;
    }
    $(".right_bBut").on("click",function(){
        if (clickFlag) {
            index++;
            tab();
            clickFlag = false;
        }
    })
    var timer = setInterval(nextA,2000);
    $(".sty_ten>div").hover(function(){
        clearInterval(timer);
    },function(){
        timer = setInterval(nextA,2000);
    })
})
// 名家访谈 END-----

// 返回顶部
$(window).scroll(function () {
    if ($(window).scrollTop() > 250 ) {
        $(".go_top").slideDown();
    }else{
        $(".go_top").slideUp();
    }
});
$(function(){
    $('.go_top').click(function(){
        $('html,body').animate({"scrollTop": 0}, 500);
    });
})
// 返回顶部 END


// ----------------
$(function(){
    var localist = $(".news_loca li");
    var index = '',num = '',snum = '',anum = '';
    for(var i = 0; i < localist.length; i++){
        index++;
        $(".news_loca li i").eq(i).text("0" + index);
    }

    for(var j = 0; j < $(".set_speak_box").length; j++){
        num++;
        $(".set_speak_num b").eq(j).text("0" + num);
    }

    for(var k = 0; k < $(".prefecture").length; k++){
        snum++;
        $(".prefecture h1").eq(k).text(snum + "F/");
    }

    for(var a = 0; a < $(".mater_dl dd").length; a++){
        anum++;
        $(".mater_dl dd").eq(0).addClass('active');
        $(".mater_dl dd").eq(a).prepend(anum + "、");
        if (a < 3) {
            $(".mater_dl dd").eq(a).css({
                color: '#eb6100'
            });
        }
    }
})
// ----------------

// 设计师下午茶-----
$(function(){
    var len = $(".exce_text li").size();
    var clickFlag = true;
    var picWidth = $(".exce_text li").eq(0).width();
    var index = 0;
    $(".exce_text li").eq(0).clone().appendTo($(".exce_text"));
    
    $(".exce_img a").eq(0).find("span").removeClass('active');
    function tab(){
        $(".exce_text").stop().animate({
            left:-picWidth * index
        },function(){
            clickFlag = true;
            if (index == len) {
                $(".exce_text").css("left",0);
                index = 0;
            }
        })
        if (index == len) {
            $(".exce_tab p a").eq(0).addClass("active").siblings().removeClass("active");
            $(".exce_img a").find("span").eq(0).removeClass("active").parent().siblings().find("span").addClass("active");
        }else{
            $(".exce_tab p a").eq(index).addClass("active").siblings().removeClass("active");
            $(".exce_img a").find("span").eq(index).removeClass("active").parent().siblings().find("span").addClass("active");
        }
    }
    $(".exce_img a").mouseover(function(){
        index = $(this).index();
        tab();
    })
    $(".exce_tab p a").on("click",function(){
        index = $(this).index();
        tab();
    })
    $(".exce_prev").on("click",function(){
        if (clickFlag) {
            index--;
            if (index < 0) {
                index = len - 1;
                $(".exce_text").css({
                    left: - picWidth * len
                })
            }
            tab();
            clickFlag = false;
        }
    })
    $(".exce_next").on("click",function(){
        if (clickFlag) {
            index++;
            tab();
            clickFlag = false;
        }
    })
})
// 设计师下午茶- END----
// 

// 建材商城
$(function(){
    $(".spistar").each(function(i){
        $(this).css({width : $(".starnum").eq(i).text() * 10 + "%"});
    });
    $(".mater_dl dd").each(function(){
        $(this).mouseover(function(){
            $(this).addClass("active").siblings().removeClass("active");
        })
    });
})






