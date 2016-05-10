<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET;?>" />
<meta http-equiv="X-UA-Compatible" content="IE=7" />
<title>通用航空云服务平台 - <?php if(isset($SEO['title']) && !empty($SEO['title'])) { ?><?php echo $SEO['title'];?><?php } ?><?php echo $SEO['site_title'];?></title>
<meta name="keywords" content="<?php echo $SEO['keyword'];?>">
<meta name="description" content="<?php echo $SEO['description'];?>">
<script language="javascript" type="text/javascript" src="<?php echo JS_PATH;?>jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo CSS_PATH;?>thy_css/common.css">
<link rel="stylesheet" type="text/css" href="<?php echo CSS_PATH;?>thy_css/slide.css"/>

<script type="text/javascript" src="<?php echo JS_PATH;?>thy_js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo JS_PATH;?>thy_js/slide.js"></script>
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
			<li><a href="<?php echo APP_PATH;?>index.php?m=content&c=index&a=lists&catid=59">数据检索</a></li>
            <li><a href="<?php echo APP_PATH;?>index.php?m=content&c=index&a=lists&catid=56">随e飞</a></li>
			<li><a href="<?php echo APP_PATH;?>index.php?m=content&c=index&a=lists&catid=58">产品</a></li>
           <!--  <li><a href="http://www.weixiuke.com.cn/" target="_blank">维修客</a></li>
            <li><a href="http://114.215.188.97:8080/OMMTest" style="width:80px;" target="_blank">运行控制</a></li>      --> 
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


<script type="text/javascript">
$(document).ready(function() {
	$('.menu_first a').attr('id','cur');
});
</script>
            <?php if($catid==30) { ?>
            	<?php $i=46?>
            	<?php $city="3385"?>
            <?php } ?>
            <?php if($catid==31) { ?>
            	<?php $i=47?>
            	<?php $city="3392,3389,3390,3391,3393"?>
            <?php } ?>
            <?php if($catid==32) { ?>
            	<?php $i=48?>
            	<?php $city="3379,3380,3381,3382,3383"?>
            <?php } ?>
            <?php if($catid==33) { ?>
            	<?php $i=49?>
            	<?php $city="3384,3386,3388,3387"?>
            <?php } ?>
            <?php if($catid==34) { ?>
            	<?php $i=50?>
            	<?php $city="3394,3395,3396"?>
            <?php } ?>
            <?php if($catid==35) { ?>
            	<?php $i=51?>
            	<?php $city="3372,3374,3375,3376,3377,3398,3399"?>
            <?php } ?>
            <?php if($catid==36) { ?>
            	<?php $i=52?>
            	<?php $city="3366,3368,3369,3370,3371,3378,397"?>
            <?php } ?>
    
<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=da1534638dd83897fa30d99da73c60bb&action=lists&catid=%24i&num=20&order=id+ASC&return=info\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$info = $content_tag->lists(array('catid'=>$i,'order'=>'id ASC','limit'=>'20',));}?>
<?php if($info) { ?>    
	<div id="header">
      <div class="slides">
            <div class="slideInner">
<?php $n=1;if(is_array($info)) foreach($info AS $r) { ?>
                 <a href="#" style="background:url(<?php echo $r['thumb'];?>) center center no-repeat rgb(16, 82, 179);">

                </a>
<?php $n++;}unset($n); ?>  
            </div>
            <div class="nav">
                <a class="prev" href="javascript:;"></a>
                <a class="next" href="javascript:;"></a>
            </div>
        </div>
    </div>
<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>   
<?php } ?>
<div class="index_jianjie">
    	<div class="jianjie_ditu">
        	<img src="img/ditu.png" width="429" height="353" alt="全国地图"/>
        </div>
        <div class="jianjie_font">
        	<img src="img/2.png" width="151" height="36" alt=""/>
        	<p>国内第一家服务于通用航空的公有云计算平台，旨在为通航管理者、通航运营人、私人飞机拥有者、航空器材销售代理商、飞行爱好者等通用航空产业链相关人员提供一体化的通航资源、信息、应用等服务，搭建具有信息资源共享、产业资源共享、服务资源共享及行业产品资源共享的公共服务平台。</p>
            <!--<ul>
                <li><a href="#">弹性扩展，负载均衡智能应对大数据处理请求</a></li>
                <li><a href="#">无需运维管理与架构设计</a></li>
                <li><a href="#">99.95%SLA，首批可信云认证</a></li>
                <li><a href="#">弹性扩展，负载均衡智能应对大数据处理请求</a></li>
                <li><a href="#">无需运维管理与架构设计</a></li>
                <li><a href="#">99.95%SLA，首批可信云认证</a></li>
            </ul>-->
            
        </div>
    </div>
    <div class="main"></div>
<?php include template('content', 'footer'); ?>