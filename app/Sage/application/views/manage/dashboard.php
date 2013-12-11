<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<meta http-equiv="pragma" content="no-cache" />
<meta http-equiv="Cache-Control" content="no-cache, must-revalidate"/>
<meta http-equiv="expires" content="Wed, 26 Feb 1997 08:21:57 GMT"/>
<title><?php echo $site['title']?></title>

<link href="<?php echo base_url().'material/css/manage/index.css';?>" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="<?php echo base_url().'material/js/jquery/jquery-1.7.1.min.js';?>"></script>
<script type="text/javascript" src="<?php echo base_url().'material/js/swipe.js';?>"></script>

</head>

<body>
<iframe src="" id="hideiframe" name="hideiframe" scrolling="no" style="border:none" width="0" height="0"></iframe>

<div style="z-index:0;position:absolute;background:url(<?php echo base_url().'material/images/1.png'?>); width:120px; height: 120px; margin:-60px 0 0 -60px; top:50%; left: 50%;">
<div id="loading" style="z-index:0;position:absolute;background:url(<?php echo base_url().'material/images/2.png'?>) left bottom; width:120px; height: 20px; bottom:0; left: 0;">

</div>
</div>

<div class="wrapper opacity" style="opacity:0;">
	<!-- <div class="component background-color-greenLight tile" id="Dreg" url="<?php echo site_url('admin/main/index')?>"></div>
	<div class="component background-color-orange tile" id="Dticket"></div>
	<div class="component background-color-grayDark tile double"></div> -->
</div>

<input id="xmlurl" type="hidden" value="<?php echo site_url('admin/manage/xmlrequest').'?tar=dashboard'?>"/>

<script type="text/javascript">
var loadingtimer;

$(document).ready(function(){
	$('.component').click(function(){
		loading();
		$('#main',parent.document).attr('src',$(this).attr('url'));
	});

	$(window).resize(function(){
		_initsize();
	});

	$('#hideiframe').attr('src',$('#xmlurl').val());
});

function showdata(key,data){
	switch(key){
		default:
			var tar = $('#'+key);
			$.each(data,function(i,each){
				tar.append('<p>'+key+'</p>');
				$.each(each,function(j,v){
					tar.append('<p>'+j+':'+v+'</p>');
				});
			});
			break;
	}
}
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
function init(){
	_initsize();
	$('.wrapper').animate({'opacity':1},function(){$('#loading').parent().hide();});
}
function _initsize(){
	var str=getWindowSize();
	var strs= new Array(); //定义一数组
	strs=str.toString().split(","); //字符分割
	var heights = strs[0] - 40;
	$('.wrapper').height(heights);
}

function loading(st,handle){
	if(st == undefined){st = true;}
	if(handle == undefined){handle = function(){};}
	
	if(st){
		$('.wrapper').animate({'opacity':0},function(){$(this).hide();});
		$('#loading').parent().show();

		loadingtimer = setInterval(function(){
			if($('#loading').height() == 120){
				$('#loading').animate({'height':0},2000);
			}else{
				$('#loading').animate({'height':120},2000);
			}
			},2500);
	}else{
		clearInterval(loadingtimer);
		$('#loading').parent().hide();
		$('.wrapper').animate({'opacity':1},function(){$(this).show('fast',handle);});
	}
}
</script>
</body>
</html>