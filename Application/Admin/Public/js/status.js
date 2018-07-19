/**
 * 后台状态操作
 */
//ajax状态操作
function status(URL,c){
	var url=URL;
	if(url.indexOf("delete") != -1){
		//删除操作
		if (confirm('确定要删除吗？')) {
			$.ajax({
		
			type:"get",
			url:URL,
			dataType:"json",
			success:function(msg){
				if(msg.status==1){
					layer.tips('恭喜您！操作成功！', '#'+c, {
						  tips: [1, '#3595CC'],
						  time: 2000
						});
					setTimeout(function(){
						var url = window.location.href; //获取当前页面的url地址
						location.href = url;
					},800);
				}else{
					layer.tips(msg.error, '#'+c, {
						  tips: [1, '#3595CC'],
						  time: 3000
						});
				}
			}
			});
		}
	}else{
		$.ajax({
		
		type:"get",
		url:URL,
		dataType:"json",
		success:function(msg){
			if(msg.status==1){
				layer.tips('恭喜您！操作成功！', '#'+c, {
					  tips: [1, '#3595CC'],
					  time: 2000
					});
				setTimeout(function(){
					var url = window.location.href; //获取当前页面的url地址
					location.href = url;
				},800);
			}else{
				layer.tips(msg.error, '#'+c, {
					  tips: [1, '#3595CC'],
					  time: 3000
					});
			}
		}
		});
	}
	
}

//jqureForm插件提交表单
function actionForm(formUrl,retUrl){
	
	$('form').submit(function(){		
		$(this).ajaxSubmit({			
			type:"post",
			url:formUrl,
			dataType:"json",
			success:function(msg){
				if(msg.status==1){
					layer.msg(msg.ok);
					setTimeout(function(){
						location.href = retUrl;
					},1000);
				}else{
					layer.msg(msg.error);
				}
			}
		});
		//阻止表单提交
	   return false;
	});
}