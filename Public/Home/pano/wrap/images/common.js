var krpano = document.getElementById("krpanoSWFObject");
function replaceAll(str){
	if(str!=null){		
		str = str.replace(/\$/g, '&');		
		return str;
	}
}
function openIframe(thisw,thish,path,type){
	var w = parseInt(thisw);
	var h = parseInt(thish);
	if(type == "0"){
		w = parseInt(thisw) - 248;
	};
	var path = replaceAll(path);
	var openhtml="<div id='iframeBoxFlash' style='position:absolute;left:50%;top:50%;z-index: 9001; visibility: visible; opacity: 1;margin-left:-"+(w/2)+"px;margin-top:-"+(h/2)+"px;width:"+w+"px;height:"+h+"px;background-color:#fff;'>"
	openhtml += "<iframe name='panoramaPlugin' frameborder='0' scrolling='no' src='"+path+"' width='"+w+"' height='"+thish+"' style='background:url(./images/fbloader.gif) no-repeat center center #fff;' allowtransparency='true'></iframe>";
	openhtml += "</div>";
	$("body").append(openhtml);
}
function openLink(linkarr){
	linkarr=replaceAll(linkarr);
	window.open(linkarr);
}
function closeIframe(){
	$("#iframeBox,#iframeBoxFlash").remove();
}
function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + "; " + expires;
}
function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) != -1) return c.substring(name.length, c.length);
    }
    return "";
}
function clearCookie(name) {  
    setCookie(name, "", -1);  
}  

function jsrun_cms_zan(domainlink,pano_id)
{
	$.ajax({
		type:"get",
		url:domainlink+"/index.php?s=/Member/Panoapi/zan",
		data:{"pano_id":pano_id},
		dataType:'jsonp',
		jsonp: "jsonpCallback",
		jsonpCallback:"success_jsonpCallback",
		success:function(data){
			if(data.status){
				var nums = parseInt(data.data);
				krpano.set("layer[cms_zan_html].html",nums);
				krpano.set("layer[cms_zan].crop","0|441|63|63");
			}
		}
	});
}

function zlqj(gourl,w,h)
{
	var gourl = replaceAll(gourl);
	$.fancybox.open({
		href : gourl,
		type : 'iframe',
		padding : 0
	});
}