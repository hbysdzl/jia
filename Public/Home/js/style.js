$(function(){
	// $(".proc_state li").each(function (){
	// 	$(this).hover(function () {
	// 		$(this).find("span").css({"background-position-y":"-256px"});
	// 	},function(){
	// 		$(this).find("span").css({"background-position-y":"-127px"});
	// 	})
	// })

	$(".rankList_img a").each(function (){
		$(this).hover(function () {
			$(this).find(".rankList_data").stop().animate({"bottom":-30},500);
		},function(){
			$(this).find(".rankList_data").stop().animate({"bottom":-305},500);
		})
	})

	$(".sty_div2").each(function(){
		$(this).hover(function(){
			$(this).find("span").stop().animate({"top":168},700);
		},function(){
			$(this).find("span").stop().animate({"top":218},700);
		})
	})

	var turn = function(target,time,opts){
		target.find('a').hover(function(){
			$(this).find('img').stop().animate(opts[0],time,function(){
				$(this).hide().next().show();
				$(this).next().animate(opts[1],time);
			})
		},function(){
			$(this).find('.sty_tes').animate(opts[0],time,function(){
				$(this).hide().prev().show();
				$(this).prev().animate(opts[1],time);
			})
		})
	}

	var vertics = [{'width':0},{'width':'234px'}];
	turn($('.sty_move'),500,vertics);
})

// stydata.php------------
$(function(){
	$(".more_btn").click(function(){
		$(".serve_list").show();
		$(".more_btn").hide();
	})
})
// stydata.php END----------

// 下一页--------------------
$(function(){

    $.fn.pager = function(options) {
        var opts = $.extend({}, $.fn.pager.defaults, options);
        return this.each(function() {
            $(this).empty().append(renderpager(parseInt(options.pagenumber), parseInt(options.pagecount), options.buttonClickCallback));
            $('.pages li').mouseover(function() { document.body.style.cursor = "pointer"; }).mouseout(function() { document.body.style.cursor = "auto"; });
        });
    };
    function renderpager(pagenumber, pagecount, buttonClickCallback) {
        var $pager = $('<ul class="pages"></ul>');
        $pager.append(renderButton('首页', pagenumber, pagecount, buttonClickCallback)).append(renderButton('上一页', pagenumber, pagecount, buttonClickCallback));

        var startPoint = 1;
        var endPoint = 9;
        if (pagenumber > 4) {
            startPoint = pagenumber - 4;
            endPoint = pagenumber + 4;
        }
        if (endPoint > pagecount) {
            startPoint = pagecount - 8;
            endPoint = pagecount;
        }
        if (startPoint < 1) {
            startPoint = 1;
        }
        for (var page = startPoint; page <= endPoint; page++) {
            var currentButton = $('<li class="page-number">' + (page) + '</li>');
            page == pagenumber ? currentButton.addClass('pgCurrent') : currentButton.click(function() { buttonClickCallback(this.firstChild.data); });
            currentButton.appendTo($pager);
        }
        $pager.append(renderButton('下一页', pagenumber, pagecount, buttonClickCallback)).append(renderButton('尾页', pagenumber, pagecount, buttonClickCallback));
        return $pager;
    }
    function renderButton(buttonLabel, pagenumber, pagecount, buttonClickCallback) {
        var $Button = $('<li class="pgNext">' + buttonLabel + '</li>');
        var destPage = 1;
        switch (buttonLabel) {
            case "首页":
                destPage = 1;
                break;
            case "上一页":
                destPage = pagenumber - 1;
                break;
            case "下一页":
                destPage = pagenumber + 1;
                break;
            case "尾页":
                destPage = pagecount;
                break;
        }
        if (buttonLabel == "首页" || buttonLabel == "上一页") {
            pagenumber <= 1 ? $Button.addClass('pgEmpty') : $Button.click(function() { buttonClickCallback(destPage); });
        }
        else {
            pagenumber >= pagecount ? $Button.addClass('pgEmpty') : $Button.click(function() { buttonClickCallback(destPage); });
        }
        return $Button;
    }
    $.fn.pager.defaults = {
        pagenumber: 1,
        pagecount: 1
    };
})

// 下一页  END-----------------


// ------筛选
$(function(){
	$(".eff_screen a").click(function(){
		$(this).addClass("active").siblings().removeClass("active");
	})
})
// --

// ------ 测试风格
$(".teststyle>div").each(function(){
    var _din = $(this).index() + 1;
    var _this = $(this);
    var hasac = false;
    var arr = ["美式风格","中式风格","现代简约","地中海风格","欧式风格"];

    $(this).find(".tests_warp li div").click(function(){
        var _index = $(this).parent().index() + 1;
        switch (_din){
            case 1:
                $(".tinput_1").val(_index);
                break;
            case 2:
                $(".tinput_2").val(_index);
                break;
            case 3:
                $(".tinput_3").val(_index);
                break;
        }
        $(this).parent().addClass("active").siblings().removeClass("active");
        hasac = true;
    })
    
    $(this).on("click",".test_next",function(){
    // $(this).find(".test_next").click(function(){
        switch (_din){
            case 1:
                hasac ? _this.next().addClass("active").siblings().removeClass("active") : alert("请选择房子面积");
                break;
            case 2:
                hasac ? _this.next().addClass("active").siblings().removeClass("active") : alert("请选择图片");
                break;
            case 3:
                hasac ?( _this.next().addClass("active").siblings().removeClass("active"),$(".tests_resu span").text(arr[$(".tinput_2").val()]), $(".tests_form").show(), testImg()) : alert("请选择装修预算");
                break;
        }
    })
    $(this).find('.test_prev').click(function(){
        _this.prev().addClass("active").siblings().removeClass("active")
    })

})

function testImg(){
    for(var i = 1; i < 6; i++){
       var imgList = '<li class="poster-item"><img src="/Public/Home/img/subscribe/test/'+ $(".tinput_2").val() +'/'+ i +'.jpg"></li>';
    $(".test_ul").append(imgList);
    }
    // 轮播
    Caroursel.init($('.caroursel'));
}

// 推广来源
function urlForm(){
    var name,value = "",value2 = ""; 
    var url = location.href; //获取url
    var num = url.indexOf("?") 
    url = url.substr(num + 1); //取得所有参数
    var arr = url.split("&"); //各个参数放到数组里
    // console.log(arr);
         
    for(var i = 0; i < arr.length; i++){ 
        num = arr[i].indexOf("=");

        if(num > 0){
            name = arr[i].substring(0,num);
            if (name == "unit") {
                // console.log(i);
                // return value = decodeURI(arr[i].substr(num+1));
                // value = decodeURI(arr[i]);
                value = "u=" + decodeURI(arr[i].substr(num+1));
            }

            if (name == "keyword") {
                // value2 = decodeURI(arr[i]);
                value2 = "k=" + decodeURI(arr[i].substr(num+1));
            }
        }
    }
    return  value + value2;
}
$("#mytender8 input[name='from']").val(urlForm());





