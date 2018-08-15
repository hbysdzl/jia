(function(){
    //微信小号及城市
    var city_Obj = {
        '深圳' : 'placeholder',
        '东莞' : 'placeholder',
        '广州' : 'http://static.to8to.com/img/to8to_img/wx_xh/wx_add_code/wx_code_gz.png',
        '合肥' : 'http://static.to8to.com/img/to8to_img/wx_xh/wx_add_code/wx_code_hf.png',
        '南京' : 'http://static.to8to.com/img/to8to_img/wx_xh/wx_add_code/wx_code_nj.png',
        '无锡' : 'http://static.to8to.com/img/to8to_img/wx_xh/wx_add_code/wx_code_wx.png',
        '武汉' : 'http://static.to8to.com/img/to8to_img/wx_xh/wx_add_code/wx_code_wh.png',
        '长沙' : 'http://static.to8to.com/img/to8to_img/wx_xh/wx_add_code/wx_code_cs.png',
        '苏州' : 'http://static.to8to.com/img/to8to_img/wx_xh/wx_add_code/wx_code_sz.jpg'
    },
        bH = jq(document).height(),
        outWrapDiff = bH - jq('#gloWrap').height(),
        browerObj = checkBrowser(),
        ie6 = false,
        bindFlag = false,
        wechatError = false,
        qrcodeData = {},
        qrcodeTimer = 0,
        hotad_res, // 热点返回结果
        number_time = 0;

    var zxbj_index = {
        init: function() {
            //初始化客服弹窗
            popCustSrvWin && popCustSrvWin.init();

            initEvent();
        }
    };
    var golbalYYID,
        countDesign = 0,
        countCompany = 0,
        designInfo = [],
        companyInfo = [],
        repeatFlag = false,  //重复入库标志
        repeatGetMobileYz = true,
        agineRuku = 0,
        workTime = '15分钟',
        fabiao_flag = false,//发标状态
        wegitFlag = false,
        ptagsize = ['1_4_11_2041','1_4_11_2042','1_4_11_2043','1_4_11_2044','1_4_11_2045','1_4_11_2046','1_4_11_2047'],// 审核的ptag
        checkrepeat = false,
        hasupload = false,
        checkverify = 0,
        check_info = {};
    changeNum(200); // 0.2秒改次数字

    if (jq('#windbox').val() == 'boxhref') {
        wegitFlag = true;
    }
    var username = getCookie('to8to_username');
    if (username) {
        jq('.zxbj_read_box').hide();
    }
    jq('.blo_bd').css('display','none');
    //查看报价明细按钮
    jq('.res_btn_box').on('click','a.res_btn',function(){
        if (jq('.res_btn').hasClass('active')) {
            jq('.blo_bd').css('display','block');
            jq(document).scrollTop(1050);
            (typeof clickStream !== 'undefined') && clickStream.getCvParams('1_4_19_424');
        };
    })
    jq('.ele_b').on('click','i',function(){
        jq(this).parent().find('i').removeClass('ele_bt_on');
        jq(this).parent().find('input').attr('value','');
        jq(this).addClass('ele_bt_on');
        jq('#zxtype').attr('value',jq(this).text());
    })
    var squareRemind = null;
    //根据面积显示户型
    jq('#square').on('keyup', function(){

        selectDoorModle(jq(this).val(), this);
    })
    jq('#square').on('keyup', function(){
        if (squareRemind) {
            clearTimeout(squareRemind);
        };
        var square = Number(jq(this).val());

        if (square + '' == 'NaN' || jq(this).val() == '' || square >= 30) {
            jq('.text_area').hide();
            return
        };
        squareRemind = setTimeout(function(){
            if (square >= 5 && square< 30) {
               jq('.text_area').show();
            };
        },300)
    });
    //表单效果
    jq('.text_wrap > input').val("");
    jq('.text_wrap > .text_lbl').click(function () {
        jq(this).parent().find('input').focus().trigger('click');
    });
    jq('.text_wrap > input').on('keydown', function () {
        jq(this).parent().find('.text_lbl').hide();
    });
    jq('.text_wrap > input').blur(function () {
        if (jq(this).val() == '') jq(this).parent().find('.text_lbl').show();
    });
    jq('div.con_bj_cal').on('click', '#calc_btn', function(){
        //获取当前ptag
        var ptag = jq('input[name="ptag"]').val();
        //百度统计函数
        if(typeof _hmt == "object"){
            _hmt.push(['_trackEvent', 'zb', 'submit', ptag]);
        }
        if (validData()) {
            jq('.bj_res_con .tip').hide();
            if (!username && !wegitFlag) {
                if (jq('#myPtag').val() == "1_4_7_1") {
                    jq('#myPtag').val('1_4_2_3');
                    (typeof clickStream !== 'undefined') && clickStream.getCvParams("1_4_2_3");
                }
                getTotalDetailInfo('detail');
            } else {
                jq('#myPtag').val('1_4_7_1');
                getTotalDetailInfo('detail');

            }
            (typeof clickStream !== 'undefined') && clickStream.getCvParams('1_4_19_423');
            jq('#endprice').css('display','block');
            detailedDisplay();
        }
    })

    //房屋类型
    jq(':radio').on('click', function () {
        console.log(jq('.houseType input[type=radio]:checked').val());
    })

    // 房屋户型
    jq('.huxing_show').on('click', function (e) {
        jq('.huxing').toggle();
        e.stopPropagation();
    })
    jq('body').on('click', function () {
        jq('.huxing').hide();
    })
    jq('.huxing').on('click', function (e) {
        jq('.huxing').show();
        e.stopPropagation();
    })
    jq('.huxing li').on('click', function (e) {
        if(e.target.nodeName.toLowerCase() === 'a') {
            var index = jq(this).index();
            switch(index) {
                case 0: 
                    jq('.huxing li:eq(0) a').removeClass('active');
                    jq(e.target).addClass('active');
                    var text = jq(e.target).text();
                    jq('.huxing_show span:eq(0)').text(text);
                    break;
                case 1: 
                    jq('.huxing li:eq(1) a').removeClass('active');
                    jq(e.target).addClass('active');
                    var text = jq(e.target).text();
                    jq('.huxing_show span:eq(1)').text(text);
                    break;
                case 2: 
                    jq('.huxing li:eq(2) a').removeClass('active');
                    jq(e.target).addClass('active');
                    var text = jq(e.target).text();
                    jq('.huxing_show span:eq(2)').text(text);
                    break;
                case 3: 
                    jq('.huxing li:eq(3) a').removeClass('active');
                    jq(e.target).addClass('active');
                    var text = jq(e.target).text();
                    jq('.huxing_show span:eq(3)').text(text);
                    break;
                case 4: 
                    jq('.huxing li:eq(4) a').removeClass('active');
                    jq(e.target).addClass('active');
                    var text = jq(e.target).text();
                    jq('.huxing_show span:eq(4)').text(text);
                    break;
            }
        }
    })
     /*vedio*/
    var buttomVideo = jq('#priceBtnVideo');
    buttomVideo.on('click',function(){
        //城市要为深圳
        if (jq('#User_City').val() == '深圳' || jq('#User_City').val() == '东莞') {
            jq('#tender-video-form').addClass('zxbj-weixin-box');
        }else{
            jq('#tender-video-form').removeClass('zxbj-weixin-box');
        }
        jq('#tender-video-view').hide();
        jq('#tender-video-form').show();
    });
    // 微信小号报价结果态
    jq('#result_hotad_calc').on('click',function(){
        jq('.result-wechat-hotad').hide();
        jq('#tender-video-form').show();
    });
    //改变城市则改变文案
    jq('#new_base_info').on('change','#User_City',function(){
        var inputValue = jq(this).val();//选择的城市信息
        var city = jq('#User_City').val();
        if (inputValue.length>0) {
            //切换结果态信息
            cityCode(city);
        };

      });
    // 深圳东莞城市可选报价结果控制
    jq('.choosebjway li').on('click',function(){
        jq(this).addClass('blueradio').siblings().removeClass('blueradio');
        var index = jq(this).index();
        jq(this).parents('.element').children('div').eq(index).show().siblings('div').hide();
        if(index == 1){
            jq('.calc-btn').addClass('calc-disabled');
        }else{
            jq('.calc-btn').removeClass('calc-disabled');
        }
    });
    // 禁用点击按钮
    jq('.form_line').on('click','.calc-disabled',function(){
        return false;
    });
    jq('body').click(function(){
        jq('.zxbj-weixin-portrait-right').hide();
    })
    an_arrow('.fruit-show-arrow','113px','93px');//引导扫二维码
    an_arrow('.pre-fruit-show-arrow','175px','185px');

    // 选择信息
    jq('.check-house,.check-time').on('click',function(){
        var ptag = jq(this).data('ptag');
        if(jq(this).hasClass('check-house')){
            check_info.housetype = jq(this).find('input[type=hidden]').val();
        }
        if(jq(this).hasClass('check-time')){
            check_info.zxtime = jq(this).find('input[type=hidden]').val();
        }
        jq(this).addClass('on').siblings().removeClass('on');
        if(!(typeof getCookie('ptagsize') == 'string' && getCookie('ptagsize').search(ptag) > -1)){
            (typeof clickStream !== 'undefined') && clickStream.getCvParams(ptagsize[ptag]);
            ptag = getCookie('ptagsize') + ptag;
            setCookie('ptagsize',ptag,1*24*60*60);
        }
    });
    // 提交审核信息
    jq('.check-upload').on('click',function(e){
        e.stopPropagation();
        if(checkrepeat){
            return;
        }
        // 验证信息
        if(vericheck()){
            checkrepeat = true;
            // 提交信息，置已提交，点击去重
            uploadcheckinfo();
        }
    });
    jq('body').on('click',function(){
        jq('.complate-form').hide();
    });
    jq('.check_grey_layer,.close_check_pop').on('click',function(){
        jq('.check_global_succ').hide();
    });
    //箭头动画
    function an_arrow(target,start,end){
        jq(target).animate({
            'left' : start
        },500,function(){
            jq(target).animate({
                'left' : end
            },500,function(){
                    an_arrow(target,start,end);
            });
         });
    };
    //数据校验
    function validData(){
        var chkArr = [{
            id: jq('.con_bj_cal .element select[name="shen"]')[0],
            className: 'form_error',
            labl: 'em',
            lablClass: 'ico_error',
            info: [{
                reg: [0],
                tip: '请选择所在地'
            }]
        },{
            id: jq('.con_bj_cal .element select[name="city"]')[0],
            parentTip: '.con_bj_cal ',
            className: 'form_error',
            labl: 'em',
            lablClass: 'ico_error',
            info: [{
                reg: [0],
                tip: '请选择所在地'
            }]
        },{
            id: jq('.con_bj_cal  .text_wrap :input[name="square"]')[0],
            className: 'form_error',
            labl: 'em',
            lablClass: 'ico_error',
            info: [{
                reg:[0],
                tip:'请输入建筑面积'
            },{
                reg:[/^\d+(\.[0-9]?[1-9]{1})?jq/],
                tip:'建筑面积不能超过两位小数'
            },{
                reg:[/^[0-4]{1}(\.[0-9]?[1-9]{1})?jq/],
                tip:'建筑面积必须大于5', negate:true
            },{
                reg:[/^[1-9]{1}[0-9]{0,2}(\.[0-9]?[1-9]{1})?jq|^1000jq/],
                tip: '建筑面积必须是1000以内'
            }]
        }];
        var phoneRule = {
            id: jq('.con_bj_cal  .text_wrap :input[name="phone"]')[0],
            className: 'form_error',
            labl: 'em',
            lablClass: 'ico_error',
            info: [{
                reg: [0],
                tip: '请输入手机号码'
            },{
                reg: [/^1{1}[3456789]{1}\d{9}jq/],
                tip: '请输入正确的手机号码'
            }]
        };

        if (jq('#phoneInput').length > 0) {
            chkArr.push(phoneRule);
        };
        return simplifyCheck2(chkArr);
    }
    /*视频点击流标记*/
    //获取所用数据
    function getTotalDetailInfo(type) {

        if (repeatFlag) {
            return;
        }
        if (wegitFlag)
            type = 'wegitFlag';
        repeatFlag = true;
        var mj = jq('.area_text').val(),
            zflag = wegitFlag ? 1 : 0;

        var data = formToJSON(jq('#new_base_info'));
        data.type = type;
        data.nowstep = 1;
        data.shi = parseInt(jq('.huxing_show span:eq(0)').text().slice(0, 1));
        data.ting = parseInt(jq('.huxing_show span:eq(1)').text().slice(0, 1));
        data.chu = parseInt(jq('.huxing_show span:eq(2)').text().slice(0, 1));
        data.wei = parseInt(jq('.huxing_show span:eq(3)').text().slice(0, 1));
        data.yangtai = parseInt(jq('.huxing_show span:eq(4)').text().slice(0, 1));

        if(jq('.houseType input[type=radio]:checked').val() === 'usedHouse') {
            data.shuidian = 1;
        }


        //需要重新定义一个modeltype
        data.modeltype = 9;
        data.onFirstStepEnd = function(data) {
            //去除关注微信小号样式
            jq('#tender-video-form').hide();
            jq('.bj_res_ul').hide();
            jq('#tender-video-view').show();
            jq('body').click(function(){
                window.location.reload();
            })

            // 数据之前，清除变动
            clearInterval(number_time);
            //返回数据模拟
            creatDetailBudget(data);
            fabiao_flag = true;//发标成功
            repeatFlag = false;
            // 存智齿客服所需要的用户信息
            setCookie('tmpYid',data.tmpYid,1000*24*3600*1000);
        };
        data.method = 'baojiaTb';
        var sendMsg = new tender();
        sendMsg.requestURL = 'http://to8tozb.to8to.com/zb/zb.php';
        sendMsg.fields.push('method');
        sendMsg.init(data);

       var player = jwplayer("container").setup({
            flashplayer: "http://img.to8to.com/swf/jwplayer.flash.swf",
            file: "http://video.to8to.com/mpeg4/bjy56.mp4",
            height:200,
            width:347,
            stretching : 'fill',
            streamer:"start",
            provider:"http",
            startparam: "start",
            autostart: true
        });
        var ptagFirst = 1;
        jwplayer().onTime(function(){
            if (data.phone) {
                var time = jwplayer("container").getPosition();
                switch (!!time){
                case 0<time && time<=10 && ptagFirst===1:
                    (typeof clickStream !== 'undefined') && clickStream.getCvParams("1_4_11_1286");
                    ptagFirst = 2;
                    break;
                case 10<time && time<=20 && ptagFirst===2:
                    (typeof clickStream !== 'undefined') && clickStream.getCvParams("1_4_11_1287");
                    ptagFirst = 3;
                    break;
                case 20<time && time<=30 && ptagFirst===3:
                    (typeof clickStream !== 'undefined') && clickStream.getCvParams("1_4_11_1288");
                    ptagFirst = 4;
                    break;
                case 30<time && time<=60 && ptagFirst===4:
                    (typeof clickStream !== 'undefined') && clickStream.getCvParams("1_4_11_1289");
                    ptagFirst = 5;
                    break;
                case 60<time && ptagFirst===5:
                    (typeof clickStream !== 'undefined') && clickStream.getCvParams("1_20_11_1290");
                    ptagFirst = 0;
                    break;
                default:
                    break;
                }
            };
        });
    }
    function formToJSON(formEle) {
        var data = formEle.serializeArray();
        var dataObj = {};
        for (var i in data) {
            dataObj[data[i].name] = data[i].value;
        }
        return dataObj;
    }
    function detailedDisplay(){
        var zxType = jq('.ele_bt_on').text();//房屋类型
        if (zxType == '新房装修') {
            jq('.info_hd>h3>em').text('');
        }else{
            jq('.info_hd>h3>em').text('详细报价清单以新房为准（旧房报价=新房报价+面积*100）');
        }
    }
    //底部二维码
    function createQrcode(data) {
        jq.ajax({
            url: 'http://www.to8to.com/api/weixin/run.php',
            data: {action: 'createQrcode',cookie_id: 'zxbj_qrcode',data: data,type: 7},
            type: "GET",
            dataType: 'jsonp',
            success: function(data) {
                if (data.code == '0') {
                    jq('#zxbj_qrcode_wrap').attr('src', data.url);
                    jq('.bottom_fiexd_box').show();
                    qrcodeData = data;
                    //loopQrcode();
                } else {
                    jq('.bottom_fiexd_box').hide();
                    wechatError = true;
                }
            },
            error: function() {
                wechatError = true;
                jq('.bottom_fiexd_box').hide();
            }
        });
    }

    function createFreeServiceId() {
        var obj = jq('#zxbj_zxbx').parents('.price_item').find('.item_hd');

        obj.attr('id', 'freeService');
    }

    //生成一个房间的数据
    function creatOneProject(obj, i) {
        var len = obj.detail.length,
            str = '<div class="price_item" onclick="(typeof clickStream !== \'undefined\') && clickStream.getCvParams(\'1_4_7_14\');">';

        if(i == 0) {
            str = '<div class="price_item price_item_unfold" onclick="(typeof clickStream !== \'undefined\') && clickStream.getCvParams(\'1_4_7_14\');">';
        }

        str += '<div class="item_hd"><h3><i class="zxbj_ico_arrow"></i>'+obj.name+'</h3><span class="item_price"><em>'+obj.price+'</em>元</span><em class="item_price_tips">提示：该价格仅为估算价格，精准价格以量房为准</em></div><div class="item_bd"><table><tbody><tr class="price_t"><td class="col_1">空间工程</td><td class="col_2">工程项目</td><td class="col_3">工程量</td><td class="col_4">单价</td><td class="col_5">总价</td><td class="col_6">工艺标准</td></tr>';
        for(var key in obj.detail){
            str += creatOneItem(obj.detail[key]);
        }
        if(obj.tipSrc)
        {
            str += '<tr class="item_price_tip"><td colspan="8">土巴兔质检提醒您：<a href="'+obj.tipSrc+'" target="_blank"><em>'+obj.tip+'</em>[更多]</a></td></tr>';
        }
        str += '</table></tbody></div></div>';

        return str;
    }
    //生成列表的一行
    function creatOneItem(obj) {
        var list = obj.list,
            len = list.length,
            str = '';

        str += '<tr><td class="col_1" rowspan="'+len+'">'+obj.name+'</td><td class="col_2">'+list[0].des+'</td><td class="col_3"><span>'+list[0].num+'</span></td><td class="col_4"><span>'+Math.floor(list[0].unitprice)+'</span></td><td class="col_5"><span>'+list[0].total+'</span></td><td class="col_6">'+list[0].note+'</td></tr>';

        for(var i = 1; i < len; i++) {
            str += '<tr><td class="col_2">'+list[i].des+'</td><td class="col_3"><span>'+list[i].num+'</span></td><td class="col_4"><span>'+Math.floor(list[i].unitprice)+'</span></td><td class="col_5"><span>'+list[i].total+'</span></td><td class="col_6">'+list[i].note+'</td></tr>';
        }

        return str;
    }
    //生成详细装修预算表
    //var priceInfo = [{name: '客厅工程1', price: 1111, tipSrc:'http://www.taobao.com', tip:'1整体橱柜装修看好这六点可远离陷阱...', detail: [{name: '墙面1', list: [{des: '铲除墙面腻子层', num: 100, unitprice: 1, total: 3, note: '铲除墙面腻子层（铲到红砖另计）'}, {des: '墙面手刷乳胶漆（多乐士金装五合一，一底两面）', num: 200, unitprice: 2, total: 4, note: '多乐士金装五合一（一底两面）,滚筒,砂皮,刷把等'}]}, {name: '墙面2', list: [{des: '铲除墙面腻子层2', num: 100, unitprice: 1, total: 3, note: '铲除墙面腻子层（铲到红砖另计）2'}]}]}, {name: '客厅工程2', price: 1111, tipSrc:'http://www.taobao.com', tip:'2整体橱柜装修看好这六点可远离陷阱...', detail: [{name: '墙面1', list: [{des: '铲除墙面腻子层', num: 100, unitprice: 1, total: 3, note: '铲除墙面腻子层（铲到红砖另计）'}, {des: '墙面手刷乳胶漆（多乐士金装五合一，一底两面）', num: 200, unitprice: 2, total: 4, note: '多乐士金装五合一（一底两面）,滚筒,砂皮,刷把等'}]}, {name: '墙面2', list: [{des: '铲除墙面腻子层2', num: 100, unitprice: 1, total: 3, note: '铲除墙面腻子层（铲到红砖另计）2'}]}]}, {name: '客厅工程3', price: 1111, tipSrc:'http://www.taobao.com', tip:'3整体橱柜装修看好这六点可远离陷阱...', detail: [{name: '墙面1', list: [{des: '铲除墙面腻子层', num: 100, unitprice: 1, total: 3, note: '铲除墙面腻子层（铲到红砖另计）'}, {des: '墙面手刷乳胶漆（多乐士金装五合一，一底两面）', num: 200, unitprice: 2, total: 4, note: '多乐士金装五合一（一底两面）,滚筒,砂皮,刷把等'}]}, {name: '墙面2', list: [{des: '铲除墙面腻子层2', num: 100, unitprice: 1, total: 3, note: '铲除墙面腻子层（铲到红砖另计）2'}]}]}];
    function creatDetailBudget(data) {
        check_info.city = jq('#User_City').val();
        check_info.tmpYid = data.tmpYid;
        check_info.phone = jq('input[name="phone"]').val();
        check_info.demo = data.demo;
        var total_price = (data.to8to_totle_price/10000).toFixed(1);
        var city = check_info.city;
        getAreaCode(city);
        /*装修贷月供价格*/
        var month_price = (total_price*10000*0.00625+total_price*10000/60).toFixed(2);
        //判断城市
        if (city_Obj[city]){
            //进入判断城市公用方法
            cityCode(city);
            jq('.bj_res_con,.bj_explain').hide();
            jq('.bj_explain').find('p').eq(1).hide();
            jq('.zxbj-weixin2-consult').show();//微信小号显示
            (typeof clickStream !== 'undefined') && clickStream.getCvParams('1_4_11_1291');
            //发标成功加入一个class改变结果态样式
            if (!jq('.con_bj').hasClass('con-bj-new2')) {
                jq('.con_bj').addClass('con-bj-new2').removeClass('con-bj-new1');;
            };
            addHotad(hotad_res,true,city);
        }else{
            jq('.bj_explain').find('p').eq(1).show();
            if (jq('.con_bj').hasClass('con-bj-new')) {
               jq('.con_bj').removeClass('con-bj-new');
            };
            addHotad(hotad_res,false,city);
        }
        jq('.calc-btn').addClass('recalc');
        jq('input[name="phone"]').val('');
        jq('#phoneInput').remove();

        var to8to_rg_price = data.to8to_rg_price;
        var to8to_cl_price = data.to8to_cl_price;
        if(data.to8to_caigai) {
            var to8to_caigai = Math.floor(data.to8to_caigai);
            to8to_rg_price = to8to_rg_price + to8to_caigai;
            total_price = ((to8to_rg_price + to8to_cl_price) / 10000).toFixed(1);
        }
        
        jq('#bprice').html(total_price);
        // jq('.bj_res_t span.bj_res_t_w').html('毛坯房半包装修预估价');
        jq('.bj_res_t span.bj_res_t_y').html('万元');
        jq('#materialPay em').html(to8to_cl_price);
        jq('#artificialPay em').html(to8to_rg_price);
        jq('#designPay').html('<em>0</em>元<del class="to8to_zj">'+ data.normal_sj_price +'元</del>');
        jq('#qualityPay').html('<em>0</em>元<del class="to8to_zj">'+ data.normal_zj_price +'元</del>');
    }

    function priceInDOM(data,ele,homeMsg){
        var shi = 0;
        var ting = 0;
        var chu = 0;
        var wei = 0;
        var yang = 0;
        var qita = 0;
        for(var i = 0; i< homeMsg.length; i++) {
            if(homeMsg[i].key=='shi_arr[]')
            {
                shi += data[i].price;
            }

            if(homeMsg[i].key=='ting_arr[]')
            {
                ting += data[i].price;
            }
            if(homeMsg[i].key=='chu_arr[]')
            {
                chu += data[i].price;
            }
            if(homeMsg[i].key=='wei_arr[]')
            {
                wei += data[i].price;
            }
            if(homeMsg[i].key=='yangtai_arr[]')
            {
                yang += data[i].price;
            }

        }
        jq('#bedroomPay').html(shi + '<em>元</em>');
        jq('#liveroomPay').html(ting+ '<em>元</em>');
        jq('#kitchenPay').html(chu+ '<em>元</em>');
        jq('#washroomPay').html(wei+ '<em>元</em>');
        jq('#balconyPay').html(yang+ '<em>元</em>');
        ele.eq(5).find('strong').html(data[homeMsg.length].price + '<em>元</em>');
    }

    //js解析域名赋值给Ptag
    jq(function(){
       var urlObj =  parseQuery();
       if(typeof urlObj == 'object' && urlObj.ptag && urlObj.ptag != '') {
          jq("#myPtag").val(urlObj.ptag);
       }
       if (typeof urlObj == 'object' && urlObj.to8to_from && urlObj.to8to_from != '') {
            switch(urlObj.to8to_from) {
                case '11_1_3':
                    jq("#myPtag").val('1_22_11_1264');
                break;
                case '58tongcheng1':
                    jq("#myPtag").val('1_22_11_1265');
                break;
                case '58tongcheng5':
                    jq("#myPtag").val('1_22_11_1266');
                break;
                case '11_1_2':
                    jq("#myPtag").val('1_22_11_1267');
                break;
                case '11_1_1':
                    jq("#myPtag").val('1_22_11_1268');
                break;
                case '58tongcheng3':
                    jq("#myPtag").val('1_22_11_1269');
                break;
                case '58tongcheng6':
                    jq("#myPtag").val('1_22_11_1270');
                break;
                case '58tongcheng2':
                    jq("#myPtag").val('1_22_11_1271');
                break;
                case '58tongcheng7':
                    jq("#myPtag").val('1_22_11_1272');
                break;
                case '58tongcheng':
                    jq("#myPtag").val('1_22_11_1273');
                break;
            }
       };
    })
    //解析域名
    function parseQuery(url) {
        var url = url || location.href;
        var query = url ? (url.split('?')[1] || '') : location.search;
        var queryList = query.substr(0).split('&');
        var parseRes = {};
        var flag = '#';

        if (queryList.length > 0) {
            for (var i = 0; i < queryList.length; i++) {
                var kv = queryList[i].split('=');
                parseRes[kv[0]] = decodeURIComponent(kv[1]).split('#')[0];
            }
        }
        return parseRes;
    }

    //根据面积显示户型
    function selectDoorModle(square, squareEle){
        var square = Number(square);
        if (square + '' == 'NaN' || jq(squareEle).val() == '') {
            return;
        };
        if (square < 60) {
            jq('.huxing_show span:eq(0)').text('1室');
            jq('.huxing_show span:eq(1)').text('1厅');
            jq('.huxing_show span:eq(2)').text('1厨');
            jq('.huxing_show span:eq(3)').text('1卫');
            jq('.huxing_show span:eq(4)').text('1阳台');
            jq('.huxing li a').removeClass('active');
            jq('.huxing li:eq(0) a:eq(0)').addClass('active');
            jq('.huxing li:eq(1) a:eq(0)').addClass('active');
            jq('.huxing li:eq(2) a:eq(0)').addClass('active');
            jq('.huxing li:eq(3) a:eq(0)').addClass('active');
            jq('.huxing li:eq(4) a:eq(0)').addClass('active');
        } else if (square >= 60 && square < 90) {
            jq('.huxing_show span:eq(0)').text('2室');
            jq('.huxing_show span:eq(1)').text('1厅');
            jq('.huxing_show span:eq(2)').text('1厨');
            jq('.huxing_show span:eq(3)').text('1卫');
            jq('.huxing_show span:eq(4)').text('1阳台');
            jq('.huxing li a').removeClass('active');
            jq('.huxing li:eq(0) a:eq(1)').addClass('active');
            jq('.huxing li:eq(1) a:eq(0)').addClass('active');
            jq('.huxing li:eq(2) a:eq(0)').addClass('active');
            jq('.huxing li:eq(3) a:eq(0)').addClass('active');
            jq('.huxing li:eq(4) a:eq(0)').addClass('active');
        } else if ( square >= 90 && square < 150) {
            jq('.huxing_show span:eq(0)').text('3室');
            jq('.huxing_show span:eq(1)').text('2厅');
            jq('.huxing_show span:eq(2)').text('1厨');
            jq('.huxing_show span:eq(3)').text('2卫');
            jq('.huxing_show span:eq(4)').text('1阳台');
            jq('.huxing li a').removeClass('active');
            jq('.huxing li:eq(0) a:eq(2)').addClass('active');
            jq('.huxing li:eq(1) a:eq(1)').addClass('active');
            jq('.huxing li:eq(2) a:eq(0)').addClass('active');
            jq('.huxing li:eq(3) a:eq(1)').addClass('active');
            jq('.huxing li:eq(4) a:eq(0)').addClass('active');
        }
        else if (square >= 150) {
            jq('.huxing_show span:eq(0)').text('4室');
            jq('.huxing_show span:eq(1)').text('2厅');
            jq('.huxing_show span:eq(2)').text('1厨');
            jq('.huxing_show span:eq(3)').text('2卫');
            jq('.huxing_show span:eq(4)').text('2阳台');
            jq('.huxing li a').removeClass('active');
            jq('.huxing li:eq(0) a:eq(3)').addClass('active');
            jq('.huxing li:eq(1) a:eq(1)').addClass('active');
            jq('.huxing li:eq(2) a:eq(0)').addClass('active');
            jq('.huxing li:eq(3) a:eq(1)').addClass('active');
            jq('.huxing li:eq(4) a:eq(1)').addClass('active');
        }
    }
    //不同城市微信小号   深圳东莞   与后面加的6个城市微信号加入方式不同
    function cityCode(city){
        // 隐藏广告
        jq('.bj-res-hotad').hide();
        jq('.zxbj-weixin2-consult').removeClass('weixin2-consult-dg');//深圳初始化二维码
        //初始化   两种二维码都隐藏
        jq('.zxbj-weixin2-consult .fruit-show-code,.zxbj-weixin2-consult .zxbj-show-code1').hide();
        if (city == '深圳') {
            jq('.fruit-show-p1-name').text('土巴兔-馨馨');
            jq('.fruit-show-p1-city').text('装修顾问 ');
            jq('.zxbj-weixin2-consult .fruit-show-code').show();
        }else if (city == '东莞'){
            jq('.fruit-show-p1-name').text('土巴兔-蓉蓉');
            jq('.fruit-show-p1-city').text('装修顾问 ');
            jq('.zxbj-weixin2-consult').addClass('weixin2-consult-dg');//东莞切换二维码
            jq('.zxbj-weixin2-consult .fruit-show-code').show();
        }else if (city_Obj[city]){
            jq('.fruit-show-p1-name').text('土巴兔-馨馨');
            jq('.fruit-show-p1-city').text('装修顾问 ');
            //根据城市添加二维码
            jq('.zxbj-show-code1 img').attr('src',city_Obj[city]);
            //显示后加入的城市二维码
            jq('.zxbj-weixin2-consult .zxbj-show-code1').show();
        }else{
            jq('.bj_explain').find('p').eq(1).show();
            if (jq('.con_bj').hasClass('con-bj-new')) {
               jq('.con_bj').removeClass('con-bj-new');
            }
            if (fabiao_flag) {
                if (jq('.con_bj').hasClass('con-bj-new2')) {
                    jq('.con_bj').removeClass('con-bj-new2');
                }
                jq('.zxbj-weixin2-consult').hide();
                jq('.bj_res_con,.bj_explain').show();
                jq('.hotad-contain .bj_explain').hide();
                jq('.hotad_bj_explain').find('p').eq(0).css('color','#ff5200');
            };
        }
    }
    // 获取热点信息
    jq(function(){
        jq('#square').on('keyup',function(){
            if(typeof hotad_res != 'object'){
                hotad_res = null;
                jq.ajax({
                    url : "http://www.to8to.com/api/httpgethot.php?hotid=791&jsonp=ok",
                    type : "GET",
                    dataType : "jsonp",
                    jsonpCallback: "jsonpCallback",
                    success : function(res){
                        // 返回的热点
                        hotad_res = res;
                    }
                });
            }
        });
    });
    // 增加热点广告
    function addHotad(res, wechat, city) {
        jq('.con_bj_res').removeClass('hotad-contain');
        jq('.result-wechat-hotad').hide();
        if (res) {
            var area = parseFloat(jq('#square').val());
            if (wechat) {
                res = res.data ? res.data[5] : '';
                if (res && res.minArea <= area && area <= res.maxArea && res.img_src && res.img_src.search(/\.(?:(?:jpg)|(?:jpeg)|(?:gif)|(?:swf)|(?:png)|(?:bmp))(?:\?[=\w\d]*)?jq/) >= 0 && (res.usedcityname ? res.usedcityname.indexOf(city) > -1 : !0)) {
                    jq('.tender-video').hide();
                    jq('.zxbj-weixin2-consult').find('.bj-res-hotad img').attr('src', res.img_src);
                    jq('.zxbj-weixin2-consult').find('.bj-res-hotad a').attr('href', res.url).data('ptag', res.ptag);
                    jq('.con_bj_res').addClass('hotad-contain');
                    jq('.result-wechat-hotad').show();
                    jq('.bj-res-hotad').width(356).show();
                }else{
                    moreInfo(wechat);
                }
            } else {
                res = res.data ? res.data[4] : '';
                if (res && res.minArea <= area && area <= res.maxArea && res.img_src && res.img_src.search(/\.(?:(?:jpg)|(?:jpeg)|(?:gif)|(?:swf)|(?:png)|(?:bmp))(?:\?[=\w\d]*)?jq/) >= 0 && (res.usedcityname ? res.usedcityname.indexOf(city) > -1 : !0)) {
                    jq('.bj_res_t .bj_res_t_w').text('您家的装修预算约 :');
                    jq('.hotad_bj_explain').find('p').eq(0).html('<b>*</b>报价有疑问？稍后装修管家将来电为您解答').end().eq(1).html('<b>*</b>该报价为毛坯半包价，实际装修报价以量房实测为准');
                    jq('.bj_res_con').find('.bj-res-hotad img').attr('src', res.img_src);
                    jq('.bj_res_con').find('.bj-res-hotad a').attr('href', res.url).data('ptag', res.ptag);
                    jq('.con_bj_res').addClass('hotad-contain');
                    jq('.hotad_bj_explain').find('p').eq(0).css('color','#ff5200');
                    jq('.bj_explain').hide();
                    jq('.bj-res-hotad').width(339).show();
                }else{
                    jq('.bj_explain').show();
        		    moreInfo(wechat);
                }
            };
            jq('.bj-res-hotad a').on('click', function() {
                var ptag = jq('.bj-res-hotad a').data('ptag');
                if(getCookie(ptag) != ptag){
                    setCookie(ptag,ptag,1000*60*60*24);
                    (typeof clickStream !== 'undefined') && clickStream.getCvParams(ptag);
                }
            });
        }else{
            moreInfo(wechat);
        }
    }
    // SEM结果态增加提交信息,优先级比热点低。
    function moreInfo(wechat){
        jq('#tender-video-view').hide();
        jq('.tender-video-wrapper').remove(); // 删除视频
        jq('.con_bj').addClass('con_bj_check');
        if(wechat){
            jq('.zxbj-weixin2-consult').addClass('zxbj-weixin-checkinfo');
            jq('.zxbj-weixin2-point').text('报价短信已发送到您的手机');
        }else{
            jq('.bj_explain').show();
            jq('.bj_res_t .bj_res_t_w').text('您家的装修预算约 :');
            jq('.bj_explain .attention').css({'margin-left':'9px','padding-left':'0px'});
            jq('.bj_explain p:eq(1)').html('<b>*</b>该报价为毛坯半包价，实际装修报价以量房实测为准').css({'margin-left':'9px','padding-left':'0px'});
        }
        // 关闭页面上传数据 因发标后会更改onbeforeunload方法。
        setTimeout(function(){
            window.oldun = window.onbeforeunload ? window.onbeforeunload : null;// 保存原来的动作
            window.onbeforeunload = function(){
                oldun ? oldun() : !1;
                if(!hasupload && (jq('.check-house.on').length>0 || jq('.check-time.on').length>0 || jq('.plot-name').find('input').val().length>0)){
                    uploadcheckinfo(true);
                }
            }
        },3000);
    }
    // 验证审核信息
    function vericheck(){
        clearTimeout(checkverify);
        if(jq('.house-type').find('.on').length == 0){
            jq('.complate-form').find('p').text('请选择您家的房屋现状').end().fadeIn(300);
            checkverify = setTimeout(function(){
                jq('.complate-form').fadeOut(300);
            },700);
            return !1;
        };
        if(jq('.decorate-time').find('.on').length == 0){
            jq('.complate-form').find('p').text('请选择您家的装修时间').end().fadeIn(300);
            checkverify = setTimeout(function(){
                jq('.complate-form').fadeOut(300);
            },700);
            return !1;
        };
        if(jq('.plot-name input').val().length == 0){
            jq('.complate-form').find('p').text('请填写小区名称').end().fadeIn(300);
            checkverify = setTimeout(function(){
                jq('.complate-form').fadeOut(300);
            },700);
            return !1;
        };
        return !0;
    }
    function createGuid () {
        for (var a = "", c = 1; 32 >= c; c++) {
            var b = Math.floor(16 * Math.random()).toString(16),
                a = a + b;
            if (8 == c || 12 == c || 16 == c || 20 == c) a += ""
        }
        return this.guid = a += Math.ceil(1E6 * Math.random())
    }
    // 提交审核信息
    function uploadcheckinfo(autopop){
        var uuid = createGuid(),
            enc = jq.md5(uuid + check_info.phone),
            data_p = "tyid=" + check_info.tmpYid + "&uuid=" + uuid + "&enc=" + enc + "&modeltype=1&invite=2&nowstep=2";
        if(check_info.housetype){
            data_p = data_p + '&demo=' + check_info.housetype + '。' + check_info.demo;
            if(!(typeof getCookie('checkinfo_ptag') == 'string' && getCookie('checkinfo_ptag').search('0') > -1)){
                (typeof clickStream !== 'undefined') && clickStream.getCvParams('1_4_11_2038');
                setCookie('checkinfo_ptag',getCookie('checkinfo_ptag') + '0',1*24*60*60);
            }
        }else{
            data_p = data_p + '&demo=' + check_info.demo;
        };
        if(check_info.zxtime){
            data_p = data_p + '&zxtime=' + check_info.zxtime;
            if(!(typeof getCookie('checkinfo_ptag') == 'string' && getCookie('checkinfo_ptag').search('1') > -1)){
                (typeof clickStream !== 'undefined') && clickStream.getCvParams('1_4_11_2039');
                setCookie('checkinfo_ptag',getCookie('checkinfo_ptag') + '1',1*24*60*60);
            }
        };
        if(jq('.plot-name input').val().length > 0){
            data_p = data_p + '&address=' + jq('.plot-name input').val();
            if(!(typeof getCookie('checkinfo_ptag') == 'string' && getCookie('checkinfo_ptag').search('2') > -1)){
                (typeof clickStream !== 'undefined') && clickStream.getCvParams('1_4_11_2040');
                setCookie('checkinfo_ptag',getCookie('checkinfo_ptag') + '2',1*24*60*60);
            }
        };
        //data_p = encodeURIComponent(data_p);
        jq.ajax({
            type: "GET",
            url: '//to8tozb.to8to.com/zb/zb-index-get.php',
            dataType : "jsonp",//数据类型为jsonp
            jsonpCallback: "jsonpCallback",//服务端用于接收callback调用的function名的参数
            data: data_p,
            success: function (ret) {
                checkrepeat = false;
                hasupload = true;// 已提交过
                jq('.check_pop_tip').css('left',(jq(window).width()-jq('.check_pop_tip').width())/2);
                if(!autopop){
                    /*if((typeof isGroundCity != 'undefined') && isGroundCity(-1,check_info.city)){
                        // 落地城市 改文案
                        //jq('.check_pop_tip').find('.check_pop_recall').eq(0).html('稍后装修管家将致电您，为您提').end().eq(1).text('供免费装修咨询服务。');
                        
                    }*/

                    jq('.check_global_succ').show();
                    jq('.check-upload').text('提交成功').css('background-color','#d8d8d8').off('click');
                }
            }
        });
    }
    /*
     * 产生固定范围的随机数
     */
    function rangeRandom(minnum, maxnum) {
        return Math.floor(minnum + Math.random() * (maxnum - minnum + 1));
    }
    /*
     * time 更改间歇时间
     */
    function changeNum(time) {
        var clf,
            rgf,
            sjf,
            zjf,
            zbj;
        number_time = setInterval(function() {
            clf = rangeRandom(10000, 99999);
            rgf = rangeRandom(10000, 99999);
            sjf = rangeRandom(1000, 10000);
            zjf = rangeRandom(500, 5000);
            zbj = clf + rgf + sjf + zjf;
            jq('#bprice').text(zbj);
            jq('#materialPay em').text(clf);
            jq('#artificialPay em').text(rgf);
            jq('#designPay em').text(sjf);
            jq('#qualityPay em').text(zjf);
        }, time);
    }

    //来电区号调接口获取--根据不同的时间修改发标后的不同的文案
    function getAreaCode(city)
    {
        jq.ajax({
                type: "GET",
                url: '//secure.to8to.com/api/getAreaCode.php',
                dataType : "jsonp",
                jsonpCallback: "jsonpCallback",
                data: 'city=' + city,
                success: function (ret) {
                    if(ret){
                        handleTimeAndTel(ret.time, ret.num);
                    }
                }
            });

    }
    function handleTimeAndTel(time,tel){
        var message,tel_text;
        if (tel === '0755') {
            tel_text = '0755';
        } else {
            tel_text = '0755或' + tel; 
        }
        message = time + '内装修管家将以' + tel_text + '开头固话回电您，免费提供装修咨询服务。';
        messagePop = '<span style="color:#f36f20;">'+time + '内</span>装修管家将以' + '<span style="color:#f36f20;">' + tel_text +'</span>'+ '开头固话';
        jq('.holiday-text .new-bj-text').text(message);
        jq('.attention2.holiday-text').html(message);
        jq('.check_pop_tip').find('.check_pop_recall').eq(0).html(messagePop).end().eq(1).text('回电您，免费提供免费装修咨询服务。');
    }
})(jquery)