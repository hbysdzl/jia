/* 
* @Author: Marte
* @Date:   2017-01-07 08:45:13
* @Last Modified by:   Marte
* @Last Modified time: 2017-11-07 10:20:44
*/
$(function(){
    var d = {};
    var mobFa = false, passFa = false, passFa2 = false, nameFa = false, capFa = false;
    var logmob = $("#logina input[name='mobile']");
    var logpass = $("#logina input[name='password']");

    $(logmob).blur(function() {
        $(".login_hint span").hide().text("");
        if ((logmob.val().length != 11 || !(regAmob.test(logmob.val())))) {
            $(".login_hint span").show();
            if (logmob.val() == "") {
                $(".login_hint span").text("请填写登陆手机号！");
            }else{
                $(".login_hint span").text("请输入正确的11位手机号码！");
            }
        }
    });
    $(logpass).blur(function() {
        var passVal = logpass.val();
        $(".login_hint span").hide().text("");
        if (passVal == "") {
            $(".login_hint span").show().text("请输入密码！");
        }
    });

    // 登陆
    $(".loginBtn").click(function() {
        if ((logmob.val() != "") && (logpass.val() != "")) {
            wind.ajaxPost("/home/sg/postuser",d);
        }else{
            $(".login_hint span").show().text("请输入正确的手机号和密码！");
            return false;
        }

        // if ((logmob.val() == "") || (logpass.val() == "")) {
        //     $(".login_hint span").show().text("请输入正确的手机号和密码！");
        //     return false;
        // }
    });

    //刷新验证码
    
    $(".refrVerify1").click(verifyChange);

    function verifyChange(){
        var refreshImg = $(".refreshImg").attr("src");
        if( refreshImg.indexOf('?')>0){
            $(".refreshImg").attr("src", refreshImg+'&random='+Math.random());
        }else{
            $(".refreshImg").attr("src", refreshImg.replace(/\?.*$/,'')+'?'+Math.random());
        }
    }

    // ---------------注册----------------------
    var regname = $("#register input[name='name']");
    var regmob = $("#register input[name='mobile']");
    var regpass = $("#register input[name='password']");
    var regpass2 = $("#register input[name='password2']");
    var regcap = $("#cap");
    var regver = $("#verify");

    var regAname = /^[A-Za-z0-9_\-\u4e00-\u9fa5]{4,8}$/;
    var regAmob = /^1[3|4|5|7|8][0-9]\d{4,8}$/;
    var regApass = /^[A-Za-z0-9_\-?\-!\-,\-.\/]{6,14}$/;


    // 注册用户名
    function succLoginNa(data){
        if (data['data'] == -1) {
            $(".register_name span").show();
            $(".register_name span").text("用户名已注册，换一个吧！");
            nameFa = false;
        }else{
            nameFa = true;
        }
    }

    $(regname).focus(function() {
        $(".register_name span").show().css({color: '#abcd03'}).text("用户名仅支持4-8个中文、数字和字母！");
    });

    $(regname).blur(function() {
        $(".register_name span").hide().css({color: '#dc0000'});
        verifyName();
    });

    // 验证用户名
    function verifyName(){
        if (regAname.test($.trim(regname.val()))) {
            wind.ajaxPost("/home/member/vaname",regname,succLoginNa);
        }else{
            $(".register_name span").show().text("用户名格式不正确！");
            return false;//注册提交时不再向下执行
        }
        return true;
    }

    // 注册手机号
    function succLoginMob(data){
        if (data['data'] == -1) {
            $(".register_mob span").show();
            $(".register_mob span").text("该号码已注册，请检查号码是否有误！");
            mobFa = false;
        }else{
            mobFa = true;
        }
    }
    // 手机号
    $(regmob).focus(function() {
        $(".register_mob span").show().css({color: '#abcd03'}).text("请填写大陆手机号！");
    });
    $(regmob).change(function() {
        countNum = 60;
        clearInterval(timer);
        regver.removeAttr("disabled");
        verifyChange();
    })
    $(regmob).blur(function(ev) {
        $(".register_mob span").hide().css({color: '#dc0000'});
        verifyMobile();
    });

    function verifyMobile() {
        if (regmob.val().length != 11 || !(regAmob.test(regmob.val()))) {
            mobile(regmob);
            return false;//注册提交时不再向下执行
        }else{
            wind.ajaxPost("/home/member/va",regmob,succLoginMob);
        }
        return true;
    }

    // 判断手机号是否正确
    function mobile(argument) {
        $(".register_mob span").show();
        if (argument.val() == "") {
            $(".register_mob span").text("请填写手机号！");
        }else{
            $(".register_mob span").text("请输入正确的11位手机号码！");
        }
    }

    // 密码
    $(regpass).focus(function() {
        $(".register_pass span").show().css({color: '#abcd03'}).text("长度为6-14位！支持数字、大小写字母和标点符号");
    });
    $(regpass).blur(function() {
        $(".register_pass span").hide().css({color: '#dc0000'});
        verifyPassword();
    });

    function verifyPassword() {
        if (!(regApass.test($.trim(regpass.val())))) {
            $(".register_pass span").show().text("密码格式不正确！");
            return false;//注册提交时不再向下执行
        }
        return true;
    }

    // 确认密码
    $(regpass2).blur(function() {
        $(".register_pass2 span").hide();
        verifyPassword2();
    });

    function verifyPassword2() {
        if (regpass.val() != regpass2.val()) {
            $(".register_pass2 span").show().text("两次密码不一致！");
            return false;//注册提交时不再向下执行
        }
        return true;
    }

    // 验证码
    $(regver).focus(function(){
        $(".refreshImg").show();
    })

    // 返回验证码
    function succLoginVer(data){
        var mobileAll = $("#mobile");
        if (data['data'] == -1) {
            // 刷新验证码
            verifyChange();
            regver.val("");
            $(".register_ver span").show().text("验证码错误！");
            return false;
        }else if(data['data'] == 1 || countFas == true){

            // 发送短信验证码
            if (mobileAll.val().length != 11 || !(regAmob.test(mobileAll.val()))){
                verifyChange();
                $(".register_mob span").show();
                $(".register_mob span").text("请输入正确的11位手机号码！");
            }else{
                regver.attr("disabled","disabled").css({background: '#fff'});
                $(".refreshImg").hide();
                wind.ajaxPost("/home/member/smstel",mobileAll);
                $(".refrVerify2").addClass('regCountDown');
                timer = setInterval(countDownTime, 1000);
                verFal = true;
            }
            return true;
        }
    }


    var verFal = false;//判断点击“注册”时图片验证码是否通过
    $(regver).blur(function() {
        verifyVerimg();
    });

    function verifyVerimg() {
        if (regver.val() == "") {
            $(".register_ver span").show().text("请填写验证码！");
            return false;//注册提交时不再向下执行
        }else{
            $(".register_ver span").hide();
            wind.ajaxPost("/home/member/vacap",regver,succLoginVer);
        }
    }

    // 获取短信验证码 
    function succGainNoteCap(data){
        if(data['data'] == 1){
            clearInterval(timer);
            $(".regCountDown").text("60s后重发");
            countNum = 61;
            timer = setInterval(countDownTime, 1000);
        }else if(data['data'] == -1){
            $(".register_note span").show().text("系统繁忙，请稍后再发！")
        }
    }

    function succNoteCap(data){
        if (data['data'] == 1) {
            $(".register_note span").hide();
            capFa = true;
            forgcapFa = true;
        }else{
            $(".register_note span").show().text("验证码错误！");
            capFa = false;
            forgcapFa = false;
        }
    }

    var countNum = 60;
    var timer,countFas = false;
    function countDownTime(){
        if (countNum == 0) {
            $(".regCountDown").text("重新获取");
            clearInterval(timer);
            $(".regCountDown").click(function(){
                wind.ajaxPost("/home/member/smstel",regmob,succGainNoteCap);
            })
        }else{
            countNum--;
            $(".regCountDown").text(countNum + "s后重发");
        }
    }

    // 注册短信验证码
    $(regcap).blur(function(){
        verifyCap();
    })

    // 验证短信验证码
    function verifyCap() {
        var mobileAll2 = $("#mobile");
        wind.ajaxPost("/home/member/vasms","mobile=" + mobileAll2.val() + "&cap=" + regcap.val(),succNoteCap);
    }
    
    // 注册
    $(".registerBtn").click(function() {
        // nameFa,mobFa防止用户名或手机号重复时ajax成功的回调函数里不能用作判断的条件
        if(verifyName() && nameFa == true){
            if(verifyMobile() && mobFa == true){
                if (verifyPassword()) {
                    if (verifyPassword2()) {
                        if (verFal == true) {
                            if (capFa == true) {
                                $("#register").submit();
                            }else{
                                $(".register_note span").show().text("验证码错误！");
                            }
                        }else{
                            $(".register_ver span").show().text("验证码错误！");
                        }
                    }
                }
            }
        }
    });
    
    // -----------重置密码-------------------
    var forgmob = $("#forgdet input[name='mobile']");
    var forgpass = $("#forgdet input[name='password']");
    var forgver = $("#forgdet input[name='verify']");
    var forgmobFa = false;

    //重置密码一密码 
    $(forgpass).focus(function() {
        $(".register_pass span").show().css({color: '#abcd03'}).text("长度为6-14位！支持数字、大小写字母和标点符号");
    });
    $(forgpass).blur(function() {
        $(".register_pass span").hide().css({color: '#dc0000'});
        amendPassword();
    });

    function amendPassword(){
        if (!(regApass.test($.trim(forgpass.val())))) {
            $(".register_pass span").show().text("密码格式不正确！");
            return false;
        }
        return true;
    }

    function succLoginName(data){
        if (data['data'] == -1) {
            $(".forgdetBtn").attr("disabled","disabled");
            $(".register_mob span").show();
            $(".register_mob span").text("该号码已注册，请检查号码是否有误！");
        }else {
            $(".forgdetBtn").removeAttr("disabled");
            countFas = true; 
        }
    }

    // 重置密码一手机号
    function succforgMob(data) {
        // 号码已注册
        if (data['data'] == -1) {
            $(".register_mob span").hide();
            forgmobFa = true;
        }else{
            forgmobFa = false;
            $(".register_mob span").show().text("该号码未注册！请检查号码是否有误！");
        }
    }

    $(forgmob).blur(function(){
        amendMobile();
    })

    function amendMobile() {
        if(forgmob.val().length != 11 || !(regAmob.test(forgmob.val()))){
            mobile(forgmob);
            return false;
        }else{
            wind.ajaxPost("/home/member/va",forgmob,succforgMob);
        }
        return true;
    }

    // 下一步
    $(".forgdetBtn").click(function(){
        if (amendMobile() && forgmobFa == true) {
            if (verFal == true) {
                if (capFa == true) {
                    $("#forgdet").submit();
                }else{$(".register_note span").show().text("验证码错误！"); }
            }else{$(".register_ver span").show().text("验证码错误！"); }
        }
    })
    
    // 修改
    $(".repwdBtn").click(function(){
        if (amendPassword()) {
            $("#forgdet").submit();
        }
    })

})


$(function(){
    //input标签placeholder兼容性
    function isPlaceholer(){
        var input = document.createElement('input');
        return "placeholder" in input;
    }
    
    if(!isPlaceholer()){
        $(".placeholderA").css({
            display:'block'
        })
        $("#register input, #logina input, #forgdet input").keydown(function(){
            $(this).siblings('.placeholderA').css({
                display:'none'
            })
        })
        $("#register input, #logina input, #forgdet input").blur(function(){
            if($(this).val()==""){
                $(this).siblings('.placeholderA').css({
                    display:'block'
                })                      
            }
        })
    }
});