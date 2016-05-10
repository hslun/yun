<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php $diquyun = $_GET["diquyun"];?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET;?>" />
<meta http-equiv="X-UA-Compatible" content="IE=7" />
<title>会员注册 - 通航云</title>
<meta name="keywords" content="<?php echo $SEO['keyword'];?>会员注册,通航云登录,通用航空">
<meta name="description" content="<?php echo $SEO['description'];?>通航云普通会员注册页面，企业会员注册请联系通航云客服开通账号！">
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

<script type="text/javascript" src="<?php echo JS_PATH;?>jquery.min.js"></script>
<script type="text/javascript" src="<?php echo JS_PATH;?>member_common.js"></script>
<script type="text/javascript" src="<?php echo JS_PATH;?>formvalidator.js" charset="UTF-8"></script>
<script type="text/javascript" src="<?php echo JS_PATH;?>formvalidatorregex.js" charset="UTF-8"></script>
<script type="text/javascript" src="<?php echo JS_PATH;?>dialog.js"></script>

<script language="JavaScript">
<!--
$(function(){
	$.formValidator.initConfig({autotip:true,formid:"myform",onerror:function(msg){}});

	$("#username").formValidator({onshow:"<?php echo L('input').L('username');?>",onfocus:"<?php echo L('username').L('between_2_to_20');?>"}).inputValidator({min:2,max:20,onerror:"<?php echo L('username').L('between_2_to_20');?>"}).regexValidator({regexp:"ps_username",datatype:"enum",onerror:"<?php echo L('username').L('format_incorrect');?>"}).ajaxValidator({
	    type : "get",
		url : "",
		data :"m=member&c=index&a=public_checkname_ajax",
		datatype : "html",
		async:'false',
		success : function(data){
            if( data == "1" ) {
                return true;
			} else {
                return false;
			}
		},
		buttons: $("#dosubmit"),
		onerror : "<?php echo L('deny_register').L('or').L('user_already_exist');?>",
		onwait : "<?php echo L('connecting_please_wait');?>"
	});
	$("#password").formValidator({onshow:"<?php echo L('input').L('password');?>",onfocus:"<?php echo L('password').L('between_6_to_20');?>"}).inputValidator({min:6,max:20,onerror:"<?php echo L('password').L('between_6_to_20');?>"});
	$("#pwdconfirm").formValidator({onshow:"<?php echo L('input').L('cofirmpwd');?>",onfocus:"<?php echo L('passwords_not_match');?>",oncorrect:"<?php echo L('passwords_match');?>"}).compareValidator({desid:"password",operateor:"=",onerror:"<?php echo L('passwords_not_match');?>"});
	$("#email").formValidator({onshow:"<?php echo L('input').L('email');?>",onfocus:"请输入正确的邮箱",oncorrect:"<?php echo L('email').L('format_right');?>"}).inputValidator({min:2,max:32,onerror:"邮箱格式错误"}).regexValidator({regexp:"email",datatype:"enum",onerror:"<?php echo L('email').L('format_incorrect');?>"}).ajaxValidator({
	    type : "get",
		url : "",
		data :"m=member&c=index&a=public_checkemail_ajax",
		datatype : "html",
		async:'false',
		success : function(data){	
            if( data == "1" ) {
                return true;
			} else {
                return false;
			}
		},
		buttons: $("#dosubmit"),
		onerror : "<?php echo L('deny_register').L('or').L('email_already_exist');?>",
		onwait : "<?php echo L('connecting_please_wait');?>"
	});
	$("#nickname").formValidator({onshow:"<?php echo L('input').L('nickname');?>",onfocus:"<?php echo L('nickname').L('between_2_to_20');?>"}).inputValidator({min:2,max:20,onerror:"<?php echo L('nickname').L('between_2_to_20');?>"}).regexValidator({regexp:"ps_username",datatype:"enum",onerror:"<?php echo L('nickname').L('format_incorrect');?>"}).ajaxValidator({
			type : "get",
			url : "",
			data :"m=member&c=index&a=public_checknickname_ajax",
			datatype : "html",
			async:'false',
			success : function(data){
				if( data == "1" ) {
					return true;
				} else {
					return false;
				}
			},
			buttons: $("#dosubmit"),
			onerror : "<?php echo L('already_exist').L('already_exist');?>",
			onwait : "<?php echo L('connecting_please_wait');?>"
		});

	$(":checkbox[name='protocol']").formValidator({tipid:"protocoltip",onshow:"<?php echo L('read_protocol');?>",onfocus:"<?php echo L('read_protocol');?>"}).inputValidator({min:1,onerror:"<?php echo L('read_protocol');?>"});
	
	<?php if($member_setting['mobile_checktype']=='2' && $sms_setting['sms_enable']=='1') { ?>
	$("#mobile").formValidator({onshow:"请输入手机号码",onfocus:"请输入手机号码"}).inputValidator({min:1,max:11,onerror:"请输入正确的手机号码"});
	<?php } ?>
	$("#mobile_verify").formValidator({onshow:"请输入手机收到的验证码",onfocus:"请输入手机收到的验证码"}).inputValidator({min:1,onerror:"请输入手机收到的验证码"}).ajaxValidator({
					type : "get",
					url : "api.php",
					data :"op=sms_idcheck&action=id_code",
					datatype : "html",
					<?php if($member_setting['mobile_checktype']=='2') { ?>
					getdata:{mobile:"mobile"},
					<?php } ?>
					async:"false",
					success : function(data){
						if( data == "1" ) {
							return true;
						} else {
  							return false;
						}
					},
					buttons: $("#dosubmit"),
					onerror : "验证码错误",
					onwait : "请稍候..."
				});

	<?php echo $formValidator;?>

	<?php if(!isset($_GET['modelid']) && !isset($_GET['t']) && !empty($member_setting['showregprotocol'])) { ?>
		show_protocol();
	<?php } ?>
});

function show_protocol() {
	art.dialog({lock:false,title:'<?php echo L('register_protocol');?>',id:'protocoliframe', iframe:'?m=member&c=index&a=register&protocol=1',width:'500',height:'310',yesText:'<?php echo L('agree');?>'}, function(){
		$("#protocol").attr("checked",true);
	});
}

//-->
</script>
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
<?php if($_username) { ?>
 <a href="<?php echo APP_PATH;?>index.php?m=member&siteid=<?php echo $siteid;?>&diquyun=<?php echo $diquyun;?>" target="_blank"><?php echo get_nickname();?></a>
 <a href="<?php echo APP_PATH;?>index.php?m=member&c=index&a=logout&forward=<?php echo urlencode($_GET['forward']);?>&siteid=<?php echo $siteid;?>" target="_top">退出</a>&nbsp;&nbsp;
 <?php } else { ?> 
            <a href="<?php echo APP_PATH;?>index.php?m=member&c=index&a=login&diquyun=<?php echo $diquyun;?>">登录</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
            <a href="<?php echo APP_PATH;?>index.php?m=member&c=index&a=register&diquyun=<?php echo $diquyun;?>">注册</a>
<?php } ?>
        </div>
    
    </div>
</div>
<!--
<div id="menu">
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
        <div class="search">
       	  <form autocomplete="off">
            <input class="search_txt" type="text">
            <input type="submit" class="search_bt" value="&nbsp;">
          </form>
        </div>
    </div>
</div>-->
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
<div id="main_login" style="background:url(<?php echo IMG_PATH;?>thy_img/zhuce_bg.jpg) no-repeat center -200px #244676; overflow:hidden; height:700px;">
    <div class="main_login">
    	<div class="main_login_l"></div>
        <div class="main_login_r">
			<h3>会员注册</h3>
            <div class="denglu">
<?php if(!isset($_GET['t'])) { ?>
<form method="post" action="" id="myform" autocomplete="off">
	<input type="hidden" name="siteid" value="<?php echo $siteid;?>" />

	<div class="col-left form-login form-reg">

		<?php if($member_setting['choosemodel'] && count($modellist)>1) { ?>
		<!--是否开启选择会员模型选项-->
    	<div class="point">
            <div class="content">
				<strong class="title"><?php echo L('notice');?></strong>
				<p><?php echo L('register_notice');?></p>
				<p><?php echo $description;?></p>
            </div>
            <span class="o1"></span><span class="o2"></span><span class="o3"></span><span class="o4"></span>
        </div>

		<p><label><?php echo L('member_model');?>：</label>
			<?php $n=1; if(is_array($modellist)) foreach($modellist AS $k => $v) { ?>
			<label class="type"><input name="modelid" type="radio" value="<?php echo $k;?>" <?php if($k==$modelid) { ?>checked<?php } ?> onclick="changemodel($(this).val())" /><?php echo $v['name'];?></label>
			<?php $n++;}unset($n); ?>
		</p>
		<?php } else { ?>
			<?php $n=1; if(is_array($modellist)) foreach($modellist AS $k => $v) { ?>
			<input name="modelid" type="hidden" value="<?php echo $k;?>"/>
			<?php $n++;}unset($n); ?>
		<?php } ?>

    	<p><input class="name phone" type="text" id="username" name="username" size="36" nullmsg="您必须提供一个用户名" placeholder="用户名"></p>
        <p><input class="pwd" type="password" style="background: url(<?php echo IMG_PATH;?>thy_img/ico_pwd.png) 5px center no-repeat #FFF;" id="password" name="password" size="36" nullmsg="您必须提供一个密码" placeholder="密   码"></p>
        <p><input class="pwd" type="password" style="background: url(<?php echo IMG_PATH;?>thy_img/ico_pwd.png) 5px center no-repeat #FFF;" name="pwdconfirm" id="pwdconfirm" size="36" nullmsg="您必须再次确认您的密码" placeholder="确认密码"></p>
        <p><input class="name" type="text" id="email" name="email" size="36" nullmsg="您必须提供您的电子邮箱" datatype="e" placeholder="请输入常用电子邮箱"></p>
		
		<?php if($sms_setting['sms_enable']=='1') { ?>
		<p><label><?php echo L('checkcode');?>：</label><input type="text" id="code" name="code" size="10" class="input-text"><?php echo form::checkcode('code_img', '5', '14', 120, 26);?></p>

		<p><label> 手机号码：</label><div class="form"><div id="mobile_div"><input type="text" name="mobile" id="mobile" value="" size="15" class="input-text" title="此服务免费,验证码将以短信免费发送到您的手机"> 
			<div class="submit"><button onclick="get_verify()" type="button" class="hqyz">获取短信验证码</button></div> <span id="mobileTip"></span>
			<br>
			</div>
			<div id="mobile_send_div" style="display:none">此服务免费,验证码已发送到<span id="mobile_send"></span>，<span id="edit_mobile" style="display:none"><a href="javascript:void();" onclick="edit_mobile()">修改号码</a>，</span> 如果超过120秒未收到验证码，您可以免费重新获取。<br><br>
			<div class="submit"><button type="button" id="GetVerify" onclick="get_verify()" class="hqyz">重获短信验证码</button></div> <br><br></div> 
			<script language="JavaScript">
			<!--
				var times = 120;
				var isinerval;
				function get_verify() {
					var session_code = $('#code').val();
					if(session_code=='') {
						alert('请输入验证码');
						$('#code').focus();
						return false;
					}
					var mobile = $("#mobile").val();
					var partten = /^1[3-9]\d{9}$/;
					if(!partten.test(mobile)){
						alert("请输入正确的手机号码");
						$('#mobile').focus();
						return false;
					}
					
					$.get("api.php?op=sms",{ mobile: mobile,session_code:session_code,random:Math.random()}, function(data){
						if(data=="0") {
							$("#mobile_send").html(mobile);
							$("#mobile_div").css("display","none");
							$("#mobile_send_div").css("display","");
							times = 120;
							$("#GetVerify").attr("disabled", true);
							isinerval = setInterval("CountDown()", 1000);
						} else if(data=="-1") {
							alert("你今天获取验证码次数已达到上限");
						} else if(data=="-100") {
							$('#code').val('');
							alert("验证码已失效，请点击图片验证码获取新的验证码！");
							$('#code').focus();
						} else if(data=="-101") {
							alert("验证码错误！");
							$('#code').focus();
						} else {
							alert("短信发送失败");
						}
					});
					
				}
				function CountDown() {
					if (times < 1) {
						$("#GetVerify").html("获取短信验证码").attr("disabled", false);
						$("#edit_mobile").css("display","");
						clearInterval(isinerval);
						return;
					}
					$("#GetVerify").html(times+"秒后重获验证码");
					times--;
				}
				function edit_mobile() {
					$("#mobile_div").css("display","");
					$("#mobile_send_div").css("display","none");
				}
			//-->
			</script>
		    </div></p>
			<p><label>短信校验码：</label><input type="text" name="mobile_verify" id="mobile_verify" value="" size="14" class="input-text"></p>
		
		<?php } ?>
		
		<?php if($member_setting['enablcodecheck']=='1' && $sms_setting['sms_enable']!='1') { ?>
		<p><label><?php echo L('checkcode');?>：</label><input type="text" id="code" name="code" size="10" class="input-text"><?php echo form::checkcode('code_img', '5', '14', 120, 26);?></p>
		<?php } ?>
		
		
		<!-- 注释验证码
        
		-->
        <p style="width:60%; margin:0px auto; padding:5px 15px;"><input name="protocol" type="checkbox" id="protocol" value="" checked="checked"><a href="javascript:void(0);" onclick="show_protocol();return false;" class="blue">阅读并同意</a></p>
                <div class="submit"><input type="submit" class="dlbt" name="dosubmit" style="width:85%" value="注册"></div><br />
        </div>
</form>
<?php } elseif (isset($_GET['t']) && $_GET['t']==2) { ?>
<p><?php $emailurl = param::get_cookie('email') ? str_replace('@', '',strstr(param::get_cookie('email'), '@')) : '';?></p>
<p><?php echo param::get_cookie('_username');?> <?php echo L('hellow');?>，</p>
<p><?php echo L('login_email_authentication');?> <?php if($emailurl) { ?> <?php echo L('please_click');?><a href="http://mail.<?php echo $emailurl;?>"><?php echo L('login_email');?></a></p>
<p>如果没有收到邮件，请点击<a onclick="$('#send_newemail').show()" href="javascript:;">这里</a>更换邮箱试试</p>
<p style="display:none" id="send_newemail">
<input type="text" id="newemail" name="newemail" size="36" class="input-focus"> 
<input type="submit" name="dosubmit" value="重新发送新邮箱验证" onclick="javascript:send_newmail();" style=" border:none; height:30px; line-height:30px; background:#428bca; border-radius:5px; color:#FFF; font-size:16px; margin:5px auto; font-family:"微软雅黑";"></p></div>
<script language="JavaScript">
function send_newmail() {
	//var mail_type = $('input[checkbox=mail_type][checked]').val();
	var newemail = $('#newemail').val();
 $.post('?m=member&c=index&a=send_newmail&newemail='+newemail,{},function(data){
 	if(data=='1'){alert('发送成功，请查看验证！');}else if(data=='-1'){alert('邮箱已被占用！');}else{alert('发送错误，请联系管理员！');}
	});
} 
</script>
<?php } ?>
</div>
<?php } elseif (isset($_GET['t']) && $_GET['t']==3) { ?>
<div class="col-left form-login form-reg">
<?php echo param::get_cookie('_username');?> <?php echo L('hellow');?>，<?php echo L('please_wait_administrator_verify');?>
</div>
<?php } else { ?>
<script language="JavaScript">
<!--
	redirect("<?php echo APP_PATH;?>index.php?m=member&c=index&a=login");
//-->
</script>
<?php } ?>

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
</div>
<style type="text/css">
.aui_inner { background:#FFF; }
.aui_outer { border-radius:3px; }
.aui_border { border-radius:2px; }
.aui_titleBar { position:relative; height:100%; }
.aui_title { height:28px; line-height:27px; padding:0 28px 0 10px; text-shadow:0 1px 0 rgba(18, 91, 167, .7); background-color:#edf5f8; font-weight:bold; color:#95a7ae; font-family: Tahoma, Arial/9!important; background-color:#bdc6cd; background: linear-gradient(top, #2673c4, #75a6da); background: -moz-linear-gradient(top, #2673c4, #75a6da); background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#2673c4), to(#75a6da)); filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#2673c4', endColorstr='#75a6da'); border-top:1px solid #1e6bbc; border-bottom:1px solid #699bd1; }
.aui_state_focus .aui_title { color:#fff; font-size:14px}
.aui_state_drag .aui_title { background: linear-gradient(top, #3580cf, #85b2e3); background: -moz-linear-gradient(top, #3580cf, #85b2e3); background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#3580cf), to(#85b2e3)); filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#3580cf', endColorstr='#85b2e3'); box-shadow:none; }
.aui_state_drag .aui_titleBar { box-shadow:none; }
.aui_close { position:absolute; padding:0; top:3px; right:3px; width:21px; height:21px; line-height:21px; font-size:18px; color:#fff; text-align:center; font-family: Helvetica, STHeiti; _font-family: '\u9ed1\u4f53', 'Book Antiqua', Palatino; text-shadow:0 1px 0 rgba(18, 91, 167, .9); }
.aui_close:hover { color:#C72015; }
.aui_close:active { box-shadow: none; }
.aui_content { color:#666; }
.aui_state_focus .aui_content { color:#000; }
.aui_state_highlight{width:200px; height:30px; line-height:30px; background:#428bca; border-radius:5px; color:#FFF; font-size:16px; margin:15px auto; font-family:"微软雅黑"; display:block; border:none;}
pre{ font-family:"微软雅黑"; }

</style>

<?php include template('content', 'footer'); ?>