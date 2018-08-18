window.onload=function(){
        //获取表单元素
        var form=document.getElementById('register');
        var userName=document.getElementById('name');
        var mobile=document.getElementById('mobile');
        var password1=document.getElementById('password');
        var password2=document.getElementById('password2');
        var verify=document.getElementById('verify');
        var span=document.getElementsByTagName('span');

         //submit事件

        $('form').submit(function(){
               var username=checkUserName();
               if(!username){
                   return false;
               }
             
               var tel=checkTel();;
               if(!tel){
                   return false;
               }

               var pwd1=checkPassWord();
               if(!pwd1){
                   return false;
               }

               var pwd2=checkPassword2();
               if(!pwd2){
                   return false;
               }

               var co=checkCode();
               if(!co){
                   return false;
               }

            //实现使用jqueryForm的方式ajax提交
            $(this).ajaxSubmit({
                 url:"http://www.dzl.com/index.php/Home/Member/registr.html", //指定表单的提交地址
                 type:'post',//表示具体的请求类型 post/get
                 dataType:'json',//指定数据交互格式
                 success:function(msg){
                     if(msg.status==0){
                        $('#e').html(msg.error); 
                     }else if (msg.status==1) {
                        $('#e').html('');
                        $('#cap').html(msg.error);
                     }else if (msg.status==2) {
                        $('#cap').html(msg.error);
                     }else if (msg.status==3) {
                        alert(msg.error);
                     }else{
                        $('#cap').html('');
                        $('#e').html('');
                        alert(msg.ok);
                     }
                 }
            
            });   
            //阻止当前的表单默认的提交
            return false;
        });

        //失去焦点事件
        userName.onblur=function(){
            checkUserName();
        };

        mobile.onblur=function(){
            checkTel();
        }

        password1.onblur=function(){
            checkPassWord();
        }

        password2.onblur=function(){
            checkPassword2();
        }

    verify.onblur=function(){
        checkCode();
    }

    //验证用户名
    function checkUserName(){
         if (userName.value.length==0) {
             span[0].innerHTML='用户名不能为空';
             span[0].className='danger';
             return false;
         }

         var reg=/^[a-zA-Z]\w{6,10}$/;
         if (userName.value.match(reg)===null) {
            span[0].innerHTML='用户名格式错误,请重新输入';
            span[0].className='danger';
            return false;
         }

            span[0].innerHTML='恭喜您!该用户名可用';
            span[0].className='success';
            return true;
    }  

    //验证手机号
    function checkTel(){
        if (mobile.value.length==0) {
            span[1].innerHTML='请填写手机号码';
            span[1].className='danger';
            return false;
        }

        var reg=/^1[34578]\d{9}$/;
        if(mobile.value.match(reg)===null) {
            span[1].innerHTML='手机号码格式错误，请重新输入';
            span[1].className='danger';
            return false;
        }

        var tel=mobile.value;
        $.ajax({
             url: "http://www.dzl.com/index.php/Home/Member/checkTel.html",
             type: "post",
             data: {mobile:tel},
             dataType: "json",
             success: function(msg){
                 if (msg.status==0) {
                     span[1].innerHTML=msg.error;
                     span[1].className='danger';
                     return false;
                 }
             }
        });

        span[1].innerHTML='恭喜您!手机号正确';
        span[1].className='success';
        return true;    
    }

    //验证密码
    function checkPassWord(){
        if (password1.value.length==0) {
            span[2].innerHTML='请填写密码';
            span[2].className='danger';
            return false;
        }

        var reg=/^[a-zA-Z]\w{6,16}$/;
        if(password1.value.match(reg)===null) {
            span[2].innerHTML='密码格式，请重新输入';
            span[2].className='danger';
            return false;
        }
        span[2].innerHTML='恭喜您!密码正确';
        span[2].className='success';
        return true;    
    }

    //重复密码验证
    function checkPassword2(){
        if (password2.value.length==0) {
            span[3].innerHTML='请再次输入密码';
            span[3].className='danger';
            return false;
        }
        if (password2.value!=password1.value) {
            span[3].innerHTML='两次输入的密码不一致，请重新输入';
            span[3].className='danger';
            return false;
        }
        span[3].innerHTML='密码正确';
        span[3].className='success';
        return true;
    }

    //验证字母验证码
    function checkCode(){
        if (verify.value.length==0) {
            span[4].innerHTML='请输入验证码';
            span[4].className='danger';
            return false;
        }
        
        span[4].innerHTML='';
        $('.regNoteVerify').attr('style','display:block');
        return true;
    }

    $("#btn").click(function(){
        countdown=60; //设置为全局变量
        var obj = $(this);
        //执行ajax发送短信
        var tel=$("#register input[name='mobile']").val();   
        $.ajax({
             url: "http://www.dzl.com/index.php/Home/Member/send.html",
             type: "post",
             data: {mobile:tel},
             dataType: "json",
             success: function(msg){
                 if (msg.status==0) {
                     //发送失败
                     $('#cap').html(msg.error);
                     $('#cap').attr('class','danger');
                 }else{
                     //发送成功
                       settime(obj);
                       $('#cap').html('');
                 }
             }
        });
    });

    function settime(obj) { //发送验证码倒计时
        if (countdown == 0) { 
            obj.attr('disabled',false); 
            //obj.removeattr("disabled"); 
            obj.html("重新获取");
            countdown = 60; 
            return;
        } else { 
            obj.attr('disabled',true);
            obj.html("发送中(" + countdown + ")");
            countdown--; 
        } 
    setTimeout(function() { 
        settime(obj) }
        ,1000) 
    }
}