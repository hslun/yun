<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8 echo pc_base::load_config('system','charset')?>" />
<title>PHPCMS V9 模型安装程序</title>
<script src="<?php echo JS_PATH?>jquery.min.js"></script>
<style>
*{padding:0; margin:0;font:12px/22px tahoma,arial,\5b8b\4f53,sans-serif; vertical-align:middle; color:#666}
body,html,input{font:12px/1.5 tahoma,arial,\5b8b\4f53,sans-serif;}
table{border-collapse:collapse;border-spacing:0;}
ul,li{list-style-type: none}
a{text-decoration:none;}
a:hover{text-decoration:underline;}
.input-text{border-left:1px solid #e0e0e0;border-top:1px solid #e0e0e0;border-right:1px solid #c5c5c5;border-bottom:1px solid #c5c5c5; height:20px; vertical-align:middle; line-height:20px; padding-left:5px; font-family:"宋体"}
.input-button{ background-color:#2776b9; color:#fff; border:none; font-family:"宋体"; padding:3px 10px; font-weight:700}
.input-button:hover{background-color: #F60;}
.header{background-color:#2776b9; padding:10px; margin-bottom:20px}
.header div{font:18px/18px "MicroSoft YaHei","SimHei"; color:#fff; }
.header div,.container,.footer{width:880px; margin: auto}
.container{}

.guild{ margin-bottom:1px; font-family:Arial, Helvetica, sans-serif}
.guild,.guild li{height:20px; overflow:hidden;font-family:Arial, Helvetica, sans-serif}
.guild li{float:left; margin-left:1px; background-color:#e2e2e2; width:175px; text-align:center; font-size:12px; line-height:20px}
.guild li.on{ background-color:#2776b9; color:#fff}

.help{ border:1px solid #cde1e6; border-bottom:none; padding:8px 10px}
.help h5{font:14px/24px "宋体"; font-weight:700; color:#006fc8;}

.list{}
.list,.list thead tr td,.list tbody td {border:1px solid #cde1e6}
.list thead tr td,.list tbody td{ border-top:none;}
.list tbody td{padding:8px}
.list thead tr{ background-color:#e4eef1;}
.list thead tr td{border-bottom:none;}
.list thead tr td span{ display:block; border:1px solid #fff; border-right:none; border-bottom:none;height:24px; line-height:24px; text-align:center}

h4.title{ background-color:#f0f0f0; padding:3px 5px; font-family:"宋体"; margin:10px 0}
.checkbox label{display:inline-block;display:-moz-inline-stack;zoom:1;*display:inline; width:25%}

.footer{text-align:center; height:34px; line-height:34px}
</style>
</head>

<body>
<div class="header"><div>PHPCMS V9 模型安装程序</div></div>
<div class="container">
	<ul class="guild">
    	<li <?php if($op == 'index'):?>class="on"<?php endif;?> style="margin:0; width:176px">1.准备升级</li>
        <li <?php if($op == 'ext'):?>class="on"<?php endif;?> >2.程序升级</li>
        <li <?php if($op == 'version'):?>class="on"<?php endif;?> >3.升级完成</li>
    </ul>
    <?php if ($op == 'index'):?>
    <div class="help">
    	<h5>升级提示</h5>
    	 <span style="color:red">1.升级前请对数据库和网站程序进行备份。</span><br />
        2.请正确的选择程序版本进行升级<br />
        3.在升级程序运行以前，请确认已经上传了模型安装文件。<br />
        4.在升级程序运行以前，请确认MYSQL数据库连接使用的账号，有足够权限对数据库的数据和结构进行修改。<br />
        <span style="color:red">5.升级完成后，请到后台更新缓存。<br />
       6.升级完成后，请删除模型安装程序。</span>
    </div>
<table class="list" width="100%">
<thead>
  <tr>
    <td width="150"><span>模型名称</span></td>
    <td><span>介绍</span></td>
    <td width="80"><span>开始安装</span></td>
  </tr>
</thead>
<tbody>
  <tr>
    <td><?php echo $configs['modelname']?></td>
    <td><div class="descripton"><?php echo ($configs['version_check'] ? '<span style="color:red">本升级补丁对版本要求严格</span><br />' : '').str_replace("\r\n", "<br />", $configs['version_description'])?></div></td>
    <td>&nbsp;<a href="?op=ext">点击安装</a></td>
  </tr>
</tbody>
</table>
<script type="text/javascript">
$(function(){
	$('.descripton').each(function(i,n){
			if ($(this).height() > 100) {
				$(this).data('oldheight', $(this).height());
				$(this).height('100px').css('overflow', 'hidden');
				$(this).parent().append('<a href="javascript:void(0)" onclick="show_all(this)">↓全部</a>');
			}
		});
})
function show_all(obj) {
	$(obj).parent('td').children('div').height($(obj).parent('td').children('div').data('oldheight')+'px');
	$(obj).parent().append('<a href="javascript:void(0)" onclick="hidden_all(this)">↑隐藏</a>');
	$(obj).remove();
}

function hidden_all(obj) {
	$(obj).parent('td').children('div').height('100px');
	$(obj).parent().append('<a href="javascript:void(0)" onclick="show_all(this)">↓全部</a>');
	$(obj).remove();
}
</script>
<?php elseif ($op == 'ext'):?>
 <div class="help">
</div>
<table class="list" width="100%">
<thead>
  <tr>
    <td width="150"><span class="success">请等待，程序正在安装中...</span></td>
  </tr>
</thead>
</table>
<script type="text/javascript">
var str = eval(<?php echo $str?>);
var allnum = <?php echo $num?>;
var step = 0;
$(function(){
	install();
})

function install() {
	$.ajax({type:"GET",
		cache:false,
		url:"index.php?op=ext&step=1&num="+step+"&filename="+str[step]+"&"+Math.random(),
		beforeSend:function(){$('.help').append("正在执行 "+str[step]+" 中...<br>");},
		success:function(data){$('.help').append(data+"<br>");if(step<allnum){install();}else{$('.success').html("<a href='index.php?op=version' style=\"font-weight:bold\">程序运行完成，进入下一步。</a>");}}
	});
	step++;
}
</script>
<?php elseif ($op == 'version'):?>
    <div class="help">
    	<h5>安装完成 </h5>
        <span style="color:red">1.安装完成后，请到后台更新缓存。<br />
	   2.安装完成后，请到后台更新新增加联动菜单缓存。<br />
       3.安装完成后，请删除模型安装程序。</span>
    </div>
    <table class="list" width="100%">
<thead>
  <tr>
    <td width="150"><span><a href="<?php echo APP_PATH?>admin.php" style="font-weight:bold">恭喜您，安装成功！点此进入后台，记得更新缓存哟。</a></span></td>
  </tr>
</thead>
</table>
<?php endif;?>
</div>

<div class="footer">
Powered by PHPCMS v9
</div>
</body>
</html>
