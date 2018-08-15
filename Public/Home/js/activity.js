/* 
* @Author: Marte
* @Date:   2016-11-03 16:51:56
* @Last Modified by:   Marte
* @Last Modified time: 2016-12-28 10:04:03
*/
function webDate(fn){
    var Htime = new XMLHttpRequest();
    Htime.onreadystatechange = function(){
        Htime.readyState == 4 && (fn(new Date(Htime.getResponseHeader('Date'))))
    };
    Htime.open('HEAD', '/?_=' + (-new Date),false);
    Htime.send(null);
}

function int2time(m){
    m-=(D=parseInt(m/86400000))*86400000;
    m-=(H=parseInt(m/3600000))*3600000;
    S=parseInt((m-=(M=parseInt(m/60000))*60000)/1000);
    
    return ("0" + D.toString()).substr(-2) + ' 天 ' + ("0" + H.toString()).substr(-2) + ' 时 ' + ("0" + M.toString()).substr(-2) + ' 分 ' + ("0" + S.toString()).substr(-2) + ' 秒 ';
}

function getSecondTime(timestr) {
    var reg = /\d+/g;
    var timenums = new Array();
    while ((r = reg.exec(timestr)) != null) {
      timenums.push(parseInt(r));
    }
    var second = 0, i = 0;
    if (timenums.length == 4) {
      second += timenums[0] * 24 * 3600000;
      i = 1;
    }
    second += timenums[i] * 3600000 + timenums[++i] * 60000 + timenums[++i] * 1000;
    return second;
}


function targetTimeA(time) {
    var actdata_bg = document.getElementById("actdata_bg");
    var actdata_salk = document.getElementById("actdata_salk");
    var act_timea_btn = document.getElementById("act_timea_btn");
    var countDown = document.getElementById("act_timea");
    var timec = new Date();
    targetTime = new Date(time);
    webDate(function (webTime){
        timec = webTime;
    })
    
    countDown.innerHTML = int2time(targetTime - timec);
    if (targetTime - timec <= 0) {
        totalSec = 0;
        countDown.innerHTML = int2time(0);
        
             
        clearInterval(tid);
        act_timea_btn.style.backgroundColor = "#cecece";
        act_timea_btn.onclick = function(){
            actdata_bg.style.display = actdata_salk.style.display = "none";
            return false;
        }
        return totalSec;
    }

    var tid = setInterval(function (){
        var countText = countDown.innerHTML;//获取输出的当前时间
        var totalSec = getSecondTime(countText) - 1000;//每秒减1秒
        if (totalSec <= 0) {
            totalSec = 0;
            clearInterval(tid);
            act_timea_btn.style.backgroundColor = "#cecece";
            act_timea_btn.onclick = function(){
                actdata_bg.style.display = actdata_salk.style.display = "none";
                return false;
            }
        }
       countDown.innerHTML = int2time(totalSec);//重新输出时间
    },1000);
}


(function($){
    $.fn.imagezoom = function(options){
        var settings = {
            xzoom: 455,
            yzoom: 455,
            offset: 10,
            position: "BTR",
            preload: 1
        };
        if(options) {
            $.extend(settings, options);
        }
        var noalt = '';
        var self = this;
        $(this).bind("mouseenter", function(ev){

            var imageLeft = $(this).offset().left;//元素左边距
            var imageTop = $(this).offset().top;//元素顶边距

            var imageWidth = $(this).get(0).offsetWidth;//图片宽度
            var imageHeight = $(this).get(0).offsetHeight;//图片高度

            var boxLeft = $(this).parent().offset().left;//父框左边距
            var boxTop = $(this).parent().offset().top;//父框顶边距
            var boxWidth = $(this).parent().width();//父框宽度
            var boxHeight = $(this).parent().height();//父框高度

            noalt= $(this).attr("alt");//图片标题
            var bigimage = $(this).attr("rel");//大图地址
            $(this).attr("alt",'');//清空图片alt

            if($("div.zoomDiv").get().length == 0){
                $(document.body).append("<div class='zoomDiv'><img class='bigimg' src='"+bigimage+"'/></div><div class='zoomMask'>&nbsp;</div>");//放大镜框及遮罩
            }

            if(settings.position == "BTR"){
                //如果超过了屏幕宽度 将放大镜放在右边
                if(boxLeft + boxWidth + settings.offset + settings.xzoom > screen.width){
                    leftpos = boxLeft  - settings.offset - settings.xzoom;
                }else{
                    leftpos = boxLeft + boxWidth + settings.offset;
                }
            }else{
                leftpos = imageLeft - settings.xzoom - settings.offset;
                if(leftpos < 0){
                    leftpos = imageLeft + imageWidth  + settings.offset;
                }
            }

            $("div.zoomDiv").css({ top: boxTop,left: leftpos });
            $("div.zoomDiv").width(settings.xzoom);
            $("div.zoomDiv").height(settings.yzoom);
            $("div.zoomDiv").show();

            $(this).css('cursor','crosshair');
            $(document.body).mousemove(function(e){

                mouse = new MouseEvent(e);
                if(mouse.x<imageLeft || mouse.x>imageLeft+imageWidth || mouse.y<imageTop || mouse.y>imageTop+imageHeight){
                    mouseOutImage();
                    return;
                }

                var bigwidth = $(".bigimg").get(0).offsetWidth;
                var bigheight = $(".bigimg").get(0).offsetHeight;

                var scaley ='x';
                var scalex ='y';

                //设置遮罩层尺寸
                if(isNaN(scalex)|isNaN(scaley)){
                    var scalex = (bigwidth/imageWidth);
                    var scaley = (bigheight/imageHeight);
                    $("div.zoomMask").width((settings.xzoom)/scalex);
                    $("div.zoomMask").height((settings.yzoom)/scaley);
                    $("div.zoomMask").css('visibility','visible');
                }

                xpos = mouse.x- $("div.zoomMask").width()/2 ;
                ypos = mouse.y- $("div.zoomMask").height()/2 ;
                
                xposs = mouse.x- $("div.zoomMask").width()/2 - imageLeft;
                yposs = mouse.y- $("div.zoomMask").height()/2 - imageTop ;
                
                xpos = (mouse.x - $("div.zoomMask").width()/2 < imageLeft ) ? imageLeft : (mouse.x + $("div.zoomMask").width()/2 > imageWidth + imageLeft ) ?  (imageWidth + imageLeft -$("div.zoomMask").width()): xpos;
                ypos = (mouse.y - $("div.zoomMask").height()/2 < imageTop ) ? imageTop : (mouse.y + $("div.zoomMask").height()/2  > imageHeight + imageTop ) ?  (imageHeight + imageTop - $("div.zoomMask").height()) : ypos;

                $("div.zoomMask").css({ top:ypos,left:xpos});
                $("div.zoomDiv").get(0).scrollLeft = xposs * scalex;
                $("div.zoomDiv").get(0).scrollTop  = yposs * scaley;
            });
        });

        function mouseOutImage(){
            $(self).attr("alt",noalt);
            $(document.body).unbind("mousemove");
            $("div.zoomMask").remove();
            $("div.zoomDiv").remove();
        }
        //预加载
        // count = 0;
        // if(settings.preload){
        //     $('body').append("<div style='display:none;' class='jqPreload"+count+"'></div>");
        //     $(this).each(function(){
        //         var imagetopreload= $(this).attr("rel");
        //         var content = jQuery('div.jqPreload'+count+'').html();
        //         jQuery('div.jqPreload'+count+'').html(content+'<img src=\"'+imagetopreload+'\">');
        //     });
        // }
    }
})(jQuery);

function MouseEvent(e) {
    this.x = e.pageX;
    this.y = e.pageY;
}
$(document).ready(function(){
    $(".jqzoom").imagezoom();
    $("#thumblist li").eq(0).addClass("tb-selected");
    $("#thumblist li a").click(function(){
        $(this).parents("li").addClass("tb-selected").siblings().removeClass("tb-selected");
        $(".jqzoom").attr('src',$(this).find("img").attr("mid"));
        $(".jqzoom").attr('rel',$(this).find("img").attr("big"));
    });
    $(".tb-booth a").click(function(){return false;});
});

$(function(){
    var localist = $(".comm_par_gasa li");
    var index = '',num = '',snum = '',anum = '';
    for(var i = 0; i < localist.length; i++){
        index++;
        $(".comm_par_gasa li b").eq(i).text(index);
    }
})