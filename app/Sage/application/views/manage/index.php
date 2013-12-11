<?php $cache = true;?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php if(!$cache):?>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<meta http-equiv="pragma" content="no-cache" />
<meta http-equiv="Cache-Control" content="no-cache, must-revalidate"/>
<meta http-equiv="expires" content="Wed, 26 Feb 1997 08:21:57 GMT"/>
<?php endif;?>
<title><?php echo $site['title']?></title>

<script type="text/javascript" src="<?php echo base_url().'material/js/jquery/jquery-1.7.1.min.js';?>"></script>
<script type="text/javascript" src="<?php echo base_url().'material/js/swipe.js';?>"></script>

<style type="text/css">
body, h1, h2, h3, h4, h5, h6, hr, p, blockquote, dl, dt, dd, ul, ol, li, pre, form, fieldset, legend, button, input, textarea, th, td {
    margin: 0;
    padding: 0;
}
ul,ol,li{list-style:none;}

body{
	padding:0;
	margin:0; 
	text-align:center;
	font-size:14px; 
	font-family:tahoma,arial,'Microsoft Yahei',宋体,sans-serif;
	min-width: 960px;
}

.swipe {
  overflow: hidden;
  visibility: hidden;
  position: relative;
}
.swipe-wrap {
  overflow: hidden;
  position: relative;
}
.swipe-wrap div {
  float:left;
  width:100%;
  position: relative;
}
.swipe,.swipe-wrap{height:auto}
.frame{ overflow:hidden;}
.frame iframe{border:none; }
.frame .gt{ position:absolute; right:0; top:50%; width:25px; height:50px; background:#333; color:#fff; margin-top:-25px; cursor:pointer; line-height:50px; font-size:20px;}
.frame .gt:hover{ background:#005eac;}
.frame .lt{ position:absolute; left:0; top:50%; width:25px; height:50px; background:#333; color:#fff; margin-top:-25px; cursor:pointer; line-height:50px; font-size:20px;}
.frame .lt:hover{ background:#005eac;}
</style>

</head>

<body scroll="no">
<div id="slider" class="swipe">
	<div class="swipe-wrap">
		<div class="frame">
			<div style="position:relative;">
			 	<iframe src="<?php echo site_url('admin/manage/import').'?'.date('YmdHis')?>" id="dashboard" name="dashboard" scrolling="auto" width="100%" height="100%"></iframe>
			</div>
		</div>
		<div class="frame">
			<div style="position:relative;">
				<iframe src="" id="main" name="main" scrolling="auto" width="100%" height="100%"></iframe>
				<div class="lt">&lt;</div>
			</div>
		</div>
		<div class="frame">
			<div style="position:relative;">
				<iframe src="" id="expand" name="expand" scrolling="auto" width="100%" height="100%"></iframe>
				<div class="lt">&lt;</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
$(document).ready(function(){
	var speed = 550;
	if(!+[1,]){
		speed = 250;
	}
	window.mySwipe = new Swipe($('#slider')[0],{
		startSlide: 0,
		disableScroll:true,
		speed: speed,
		callback: function(index, e) {
			switch(index){
				case 0:{
					
					break;
				}
				case 1:{
					
					break;
				}
				case 2:{
					
					break;
				}
				case 3:{
					/*$('.datagrid').html('');
					if(localStorage['loginId'] == ''){
						mySwipe.slide(1);
						jpro._msg('请先登录');
					}else{
						jpro.initText();
						jpro.sum();
					}*/
					break;
				}
				case 4:{
					
					break;
				}
				default:{
					break;
				}
			}
		}
	});

	$('.lt').click(function(){prev();});
	$('.gt').click(function(){next();});
	
	wSize();

	$(window).resize(function(){
		wSize();
	});
});
if(!Array.prototype.map){
	Array.prototype.map = function(fn,scope) {
	  var result = [],ri = 0;
	  for (var i = 0,n = this.length; i < n; i++){
		if(i in this){
		  result[ri++]  = fn.call(scope ,this[i],i,this);
		}
	  }
	return result;
	};
}
var getWindowSize = function(){
	return ["Height","Width"].map(function(name){
	  return window["inner"+name] ||
		document.compatMode === "CSS1Compat" && document.documentElement[ "client" + name ] || document.body[ "client" + name ]
	});
}
function wSize(){
	//这是一字符串
	var str=getWindowSize();
	var strs= new Array(); //定义一数组
	strs=str.toString().split(","); //字符分割
	var heights = strs[0];
	$('.frame').height(heights);
	
	dyniframesize('dashboard');
	dyniframesize('main');
	dyniframesize('expand');
}
function dyniframesize(down) {
	$('#'+down).css('height',$('#'+down).parent().parent().css('height'));
}
function prev(){
	mySwipe.prev();
}
function next(){
	mySwipe.next();
}
</script>

</body>
</html>