<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET;?>" />
<meta http-equiv="X-UA-Compatible" content="IE=7" />
<title><?php if(isset($SEO['title']) && !empty($SEO['title'])) { ?><?php echo $SEO['title'];?><?php } ?><?php echo $SEO['site_title'];?></title>
<meta name="keywords" content="<?php echo $SEO['keyword'];?>">
<meta name="description" content="<?php echo $SEO['description'];?>">
<script language="javascript" type="text/javascript" src="<?php echo JS_PATH;?>jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo CSS_PATH;?>thy_css/common.css">
<link rel="stylesheet" type="text/css" href="<?php echo CSS_PATH;?>thy_css/slide.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo CSS_PATH;?>chanpin.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo CSS_PATH;?>index/index.css"/>

<script type="text/javascript" src="<?php echo JS_PATH;?>thy_js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo JS_PATH;?>thy_js/slide.js"></script>
<script type="text/javascript" src="<?php echo JS_PATH;?>index/index.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$(".slideInner").slide({
		slideContainer: $('.slideInner a'),
		effect: 'easeOutCirc',
		autoRunTime: 5000,
		slideSpeed: 1000,
		nav: true,
		autoRun: true,
		prevBtn: $('a.prev'),
		nextBtn: $('a.next')
	});
});
</script>
<script>	
	$(document).ready(function(){
				if( navigator.userAgent.match(/Android/i)
				|| navigator.userAgent.match(/webOS/i)
				|| navigator.userAgent.match(/iPhone/i)
				|| navigator.userAgent.match(/iPad/i)
				|| navigator.userAgent.match(/iPod/i)
				|| navigator.userAgent.match(/BlackBerry/i)
				|| navigator.userAgent.match(/Windows Phone/i)
				)
				{
					$("body").addClass("min");
				}
	})
</script>
<?php session_start();?>
<?php $diquyun = $_SESSION['diquyun'];?>
</head>
<body>
<div id="top">
	<div class="top">
    	<!--<div class="diqu">
        	<?php if($diquyun) { ?><?php echo $CATEGORYS[$diquyun]['catname'];?><a href="<?php echo APP_PATH;?>">[切换管理局]</a><?php } else { ?><a href="<?php echo APP_PATH;?>">[选择管理局]</a><?php } ?>
        </div>-->
        <div class="tianqi">

        </div>
        <div class="index_login">
<?php if($_userid) { ?>
 <a href="<?php echo APP_PATH;?>index.php?m=member&siteid=<?php echo $siteid;?>" target="_blank"><?php echo get_nickname();?></a>
 <a href="<?php echo APP_PATH;?>index.php?m=member&c=index&a=logout&forward=<?php echo urlencode($_GET['forward']);?>&siteid=<?php echo $siteid;?>" target="_top">退出</a>&nbsp;&nbsp;
 <?php } else { ?> 
            <a href="<?php echo APP_PATH;?>index.php?m=member&c=index&a=login&diquyun=<?php echo $diquyun;?>">登录</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
            <a href="<?php echo APP_PATH;?>index.php?m=member&c=index&a=register&diquyun=<?php echo $diquyun;?>">注册</a>
<?php } ?>
        </div>
    
    </div>
</div>
<div id="menu">
    <div class="menu">
    	<a href="<?php echo APP_PATH;?>"><h1 class="logo">通航云</h1></a>
        <ul>
            <li  class="menu_first"><a href="<?php echo APP_PATH;?>">首页</a></li>
			<li class="menu_jiansuo"><a href="<?php echo APP_PATH;?>index.php?m=content&c=index&a=lists&catid=59">数据检索</a></li>
            <li class="menu_suiefei"><a href="<?php echo APP_PATH;?>index.php?m=content&c=index&a=lists&catid=56">随e飞</a></li>
			<li class="menu_chanpin"><a href="<?php echo APP_PATH;?>index.php?m=content&c=index&a=lists&catid=58">产品</a></li> 
          <!--   <li><a href="http://www.weixiuke.com.cn/" target="_blank">维修客</a></li>
            <li><a href="http://114.215.188.97:8080/OMMTest" style="width:80px;" target="_blank">运行控制</a></li>   -->    
            <li><a  href="<?php echo APP_PATH;?>index.php?m=content&c=index&a=lists&catid=9">通航供需平台</a></li>  	
        </ul>
        <div class="search">
       	  <form>
            <input class="search_txt" type="text">
            <input type="submit" class="search_bt" value="&nbsp;">
          </form>
        </div>
    </div>
</div>
