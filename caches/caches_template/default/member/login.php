<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php $diquyun = $_GET["diquyun"];?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET;?>" />
<meta http-equiv="X-UA-Compatible" content="IE=7" />
<title>会员登录 - 通航云</title>
<meta name="keywords" content="<?php echo $SEO['keyword'];?>会员登录,通航云登录,通用航空">
<meta name="description" content="<?php echo $SEO['description'];?>通航云普通会员登录页面，企业会员登录请联系通航云客服开通账号！">
<script type="text/javascript" src="<?php echo JS_PATH;?>jquery.min.js"></script>
<script type="text/javascript" src="<?php echo JS_PATH;?>member_common.js"></script>
<?php if(isset($show_validator)) { ?>
<script type="text/javascript" src="<?php echo JS_PATH;?>formvalidator.js" charset="UTF-8"></script>
<script type="text/javascript" src="<?php echo JS_PATH;?>formvalidatorregex.js" charset="UTF-8"></script>
<?php } ?>
<script language="javascript" type="text/javascript" src="<?php echo JS_PATH;?>jquery.sGallery.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo JS_PATH;?>yp_common.js"></script>
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
<script type="text/javascript" src="<?php echo JS_PATH;?>thy_js/api"></script>
<script language="JavaScript">
<!--
$(function(){
	$.formValidator.initConfig({autotip:true,formid:"myform",onerror:function(msg){}});
	$("#username").formValidator({onshow:"<?php echo L('input').L('username');?>",onfocus:"<?php echo L('between_2_to_20');?>"}).inputValidator({min:2,max:20,onerror:"<?php echo L('between_2_to_20');?>"}).regexValidator({regexp:"ps_username",datatype:"enum",onerror:"<?php echo L('username').L('format_incorrect');?>"});
	$("#password").formValidator({onshow:"<?php echo L('input').L('password');?>",onfocus:"<?php echo L('password').L('between_6_to_20');?>"}).inputValidator({min:6,max:20,onerror:"<?php echo L('password').L('between_6_to_20');?>"});

});
//-->
</script>
</head>
<body>
<div id="top">
	<div class="top">
    	<!--<div class="diqu">
        	<?php if($diquyun) { ?><?php echo $CATEGORYS[$diquyun]['url'];?><a href="<?php echo APP_PATH;?>">[切换管理局]</a><?php } else { ?><a href="<?php echo APP_PATH;?>">[选择管理局]</a><?php } ?>
        </div>-->
        <div class="tianqi">

        </div>
        <div class="index_login">
            <a href="<?php echo APP_PATH;?>index.php?m=member&c=index&a=login&diquyun=<?php echo $diquyun;?>">登录</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
            <a href="<?php echo APP_PATH;?>index.php?m=member&c=index&a=register&diquyun=<?php echo $diquyun;?>">注册</a>
        </div>
    
    </div>
</div>
<!--<div id="menu">
    <div class="menu">
    	<a href="<?php if($diquyun) { ?>/index.php?m=content&c=index&a=lists&catid=<?php echo $diquyun;?><?php } else { ?><?php echo APP_PATH;?><?php } ?>"><h1 class="logo">通航云</h1></a>
        <ul>
            <li><a id="cur" href="<?php if($diquyun) { ?>/index.php?m=content&c=index&a=lists&catid=<?php echo $diquyun;?><?php } else { ?><?php echo APP_PATH;?><?php } ?>">首页</a></li>
            <li><a href="<?php echo APP_PATH;?>hangfuwu/#/">机场检索</a></li>
            <li><a href="#">随e飞</a></li>
            <li><a href="#">维修客</a></li>
            <li><a href="<?php echo APP_PATH;?>index.php?m=content&c=index&a=lists&catid=11">通航供需平台</a></li>
            <li><a href="#">气象情报</a></li>        	
        </ul>
    </div>
</div>
-->
</div>
    <div class="menu">
    	<a href="<?php echo APP_PATH;?>"><h1 class="logo">通航云</h1></a>
         <ul>
            <li><a  href="<?php echo APP_PATH;?>">首页</a></li>
           <!----------- <li><a href="<?php echo APP_PATH;?>hangfuwu/#/">机场检索</a></li>-------------->
            <li><a href="<?php echo APP_PATH;?>index.php?m=content&c=index&a=lists&catid=56">随e飞</a></li>
            <li><a href="http://www.weixiuke.com.cn/" target="_blank">维修客</a></li>
            <li><a href="http://114.215.188.97:8080/OMMTest" style="width:80px;" target="_blank">运行控制</a></li>     
             <li><a href="<?php echo APP_PATH;?>index.php?m=content&c=index&a=lists&catid=9">通航供需平台</a></li>   	
        </ul>
    </div>
<div id="main_login" style="background:url(<?php echo IMG_PATH;?>thy_img/login_bg.jpg) no-repeat center -30px #244676; overflow:hidden; height:550px; background-size: 100%;">
    <div class="main_login">
    	<div class="main_login_l"></div>
        <div class="main_login_r">
			<h3>会员登录</h3>
            <div class="denglu">
<form method="post" action="" onsubmit="save_username();" id="myform" name="myform" autocomplete="off">
<input type="hidden" name="forward" id="forward" value="<?php echo $forward;?>">
                    <p><input type="text" class="name"  name="username" size="22" nullmsg="您必须提供一个用户名" placeholder="用户名"></p>
                    <p><input type="password" class="pwd" style="background: url(<?php echo IMG_PATH;?>thy_img/ico_pwd.png) 5px center no-repeat #FFF;" name="password" size="22" nullmsg="***" placeholder="密  码"></p>
 <p class="yanzheng"><input type="text" class="yzm"  nullmsg="您必须提供一个用户名" placeholder="验证码" name="code"><a href="#"><?php echo form::checkcode('code_img', '5', '14', 110, 30);?></a></p>
                    <p><input type="submit" class="dlbt" name="dosubmit" id="dosubmit" value="<?php echo L('login');?>"></p>
                </form>
            </div>
			<?php if($setting['connect_enable']) { ?>
            <div class="kjdl">
                <h3>第三方账号登录：</h3>
                <p>
                         <?php if($setting['sina_akey'] || $setting['sina_skey']) { ?>
                   <a href="#"><img src="<?php echo IMG_PATH;?>thy_img/kjdl_03.png" width="15%" alt=""></a>
                   		 <?php } ?>
						<?php if($setting['qq_appkey'] || $setting['qq_appid']) { ?>
                   <a href="#"><img src="<?php echo IMG_PATH;?>thy_img/kjdl_05.png" width="15%" alt=""></a>
                         <?php } ?>
                </p>
                <p class="zhuce">没有账号？<a href="<?php echo APP_PATH;?>index.php?m=member&c=index&a=register">注册</a></p>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
<script language="JavaScript">
<!--

	$(function(){
		$('#username').focus();
	})

	function save_username() {
		if($('#cookietime').attr('checked')==true) {
			var username = $('#username').val();
			setcookie('username', username, 3);
		} else {
			delcookie('username');
		}
	}
	var username = getcookie('username');
	if(username != '' && username != null) {
		$('#username').val(username);
		$('#cookietime').attr('checked',true);
	}

	function show_login(site) {
		if(site == 'sina') {
			art.dialog({lock:false,title:'<?php echo L('sina_login');?>',id:'protocoliframe', iframe:'index.php?m=member&c=index&a=public_sina_login',width:'500',height:'310',yesText:'<?php echo L('close');?>'}, function(){
			});
		} else if(site == 'snda') {
			art.dialog({lock:false,title:'<?php echo L('snda_login');?>',id:'protocoliframe', iframe:'index.php?m=member&c=index&a=public_snda_login',width:'500',height:'310',yesText:'<?php echo L('close');?>'}, function(){
			});
		} else if(site == 'qq') {
			art.dialog({lock:false,title:'<?php echo L('qq_login');?>',id:'protocoliframe', iframe:'index.php?m=member&c=index&a=public_qq_login',width:'500',height:'310',yesText:'<?php echo L('close');?>'}, function(){
			});
		}
	}
//-->
</script>

<?php include template('content', 'footer'); ?>