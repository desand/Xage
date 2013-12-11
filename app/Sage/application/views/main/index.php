<?php $cache = false;?>
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
</head>

<body>
hihihi

<script type="text/javascript">
$(document).ready(function(){
	window.parent.dashboard.window.loading(false,window.parent.next());
});
</script>
</body>
</html>