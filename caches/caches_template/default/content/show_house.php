<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php include template('content', 'header'); ?>
<!--main-->

<div id="main">
    <div class="gongqiu_list">
    	<div class="mbx"><a href="<?php echo siteurl($siteid);?>">首页</a><span> > </span><a href="<?php echo $CATEGORYS['9']['url'];?>"><?php echo $CATEGORYS['9']['catname'];?></a><span> > </span><a href="<?php echo $CATEGORYS[$catid]['url'];?>"><?php echo $CATEGORYS[$catid]['catname'];?></a></div>
        <h1><?php echo $title;?>&nbsp;&nbsp;&nbsp;</h1>
        <div class="gongqiu_list_l gongqiu_show">
            <dl class="dl">
            	<dt class="gongqiu_name" id="gongqiu_show_name">
                	<span class="gongqiu_tt"></span>
                    <span class="gongqiu_ren" style="width:180px; float:left;">时间：<?php echo $inputtime;?></span>
                    <span class="gongqiu_ren" onclick="add_favorite('<?php echo $title;?>');"><img src="<?php echo APP_PATH;?>statics/images/thy_img/shoucang.jpg" /></span></dt>
            	<dd>
                	<h2 style=" color:rgb(83, 184, 235); font-weight:bold;">具体需求：</h2>
                    <h2>供需类型：<?php echo $rent_mode;?></h2>
                    <h2>所在地：<?php echo $address;?></h2>
                    <h2>说明:</h2>
                    <p>
                        <?php echo $content;?>
                    </p>
                    	<?php if($rs[map]) { ?>
                        <h5 style="margin-left:20px; font-size:16px; border-bottom:1px solid #ccc;">位置：</h5>
                        <?php echo $map;?>
						<style type="text/css">
						#mapObj{margin-left:80px;}
						</style>
                        <?php } ?>
                    <?php $a=$_GET["a"];?>
                    <?php if($a=="public_preview") { ?>
                    	 <p class="lianxi">发布人：<?php echo $contact;?><br>联系电话：<?php echo $phone;?></p>
					<?php } else { ?>
                    <p class="lianxi">如果对该需求有兴趣，可以联系我们详细了解！<br>
					<a href="javascript:" onclick="ShowDiv('MyDiv','fade')">联系通航云</a></p>
                    <?php } ?>
        			<dl class="user" style="padding-top:15px;">
                    </dl>
                </dd>
            </dl>


        </div>
        <div class="gongqiu_list_r">
            <dl class="dl index_zhanhui">
            	<dt><a href="#" class="dt_tt">航油航材</a></dt>
            	<dd><ul>
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=5ed480e61034bf237cf15ef85eeb4a86&action=lists&catid=%24catid&where=%24sql&num=15&order=listorder+DESC%2Cinputtime+DESC&page=%24page&moreinfo=1&cache=%24cachetime&urlrule=%24urlrule\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$pagesize = 15;$page = intval($page) ? intval($page) : 1;if($page<=0){$page=1;}$offset = ($page - 1) * $pagesize;$content_total = $content_tag->count(array('catid'=>$catid,'where'=>$sql,'order'=>'listorder DESC,inputtime DESC','moreinfo'=>'1','limit'=>$offset.",".$pagesize,'action'=>'lists',));$pages = pages($content_total, $page, $pagesize, $urlrule);$data = $content_tag->lists(array('catid'=>$catid,'where'=>$sql,'order'=>'listorder DESC,inputtime DESC','moreinfo'=>'1','limit'=>$offset.",".$pagesize,'action'=>'lists',));}?>
			<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
			<?php $photos_num = count(string2array($r[photos]))?>
		            <li> <a href="<?php echo $r['url'];?>"><?php echo str_cut($r['title'], 40);?></a></li>
			<?php $n++;}unset($n); ?>
			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
                </ul></dd>
            </dl>
        </div>
        <div class="gongqiu_bt">
            <dl class="dl">
            	<dt><a href="#" class="dt_tt">飞行器租凭/包机/托管</a></dt>
            	<dd><ul>
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=e0fbbfc62e8d7179d73de4a821f08b52&action=lists&catid=%24catid&where=%24sql&num=4&order=listorder+DESC%2Cinputtime+DESC&page=%24page&moreinfo=1&cache=%24cachetime&urlrule=%24urlrule\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$pagesize = 4;$page = intval($page) ? intval($page) : 1;if($page<=0){$page=1;}$offset = ($page - 1) * $pagesize;$content_total = $content_tag->count(array('catid'=>$catid,'where'=>$sql,'order'=>'listorder DESC,inputtime DESC','moreinfo'=>'1','limit'=>$offset.",".$pagesize,'action'=>'lists',));$pages = pages($content_total, $page, $pagesize, $urlrule);$data = $content_tag->lists(array('catid'=>$catid,'where'=>$sql,'order'=>'listorder DESC,inputtime DESC','moreinfo'=>'1','limit'=>$offset.",".$pagesize,'action'=>'lists',));}?>
			<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
			<?php $photos_num = count(string2array($r[photos]))?>
						<li><a href="<?php echo $r['url'];?>">
                        	<p class="gongqiu_tt"><?php echo str_cut($r['title'], 50);?></p>
                            <p class="gongqiu_city"><p class="gongqiu_ren"><p class="gongqiu_ren"><?php echo $r['contact'];?></p></a>
                        </li>
			<?php $n++;}unset($n); ?>
			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
                </ul></dd>
            </dl>
        </div>
        
  </div>
</div>
<script language="JavaScript">
<!--
	function add_favorite(title) {
		$.getJSON('<?php echo APP_PATH;?>api.php?op=add_favorite&title='+encodeURIComponent(title)+'&url='+encodeURIComponent(location.href)+'&'+Math.random()+'&callback=?', function(data){
			if(data.status==1)	{
				alert('收藏成功');
			} else {
				alert('请登录后收藏');
			}
		});
	}
//-->
</script>
<script type="text/javascript" src="<?php echo APP_PATH;?>api.php?op=count&id=<?php echo $id;?>&modelid=<?php echo $modelid;?>"></script>
<script type="text/javascript">
	//弹出隐藏层
	function ShowDiv(show_div,bg_div)
		{
			document.getElementById(show_div).style.display='block';
			document.getElementById(bg_div).style.display='block' ;
			var bgdiv = document.getElementById(bg_div);
			bgdiv.style.width = document.body.scrollWidth;
			// bgdiv.style.height = $(document).height();
			$("#"+bg_div).height($(document).height());
		};
	//关闭弹出层
	function CloseDiv(show_div,bg_div)
		{
			document.getElementById(show_div).style.display='none';
			document.getElementById(bg_div).style.display='none';
		};
</script>
    <div id="fade" class="black_overlay">
    </div>
    <div id="MyDiv" class="white_content" style="background:url(<?php echo APP_PATH;?>statics/images/thy_img/form_bg.png) no-repeat">
        <div style="text-align: right; cursor: default; height: 40px;">
        	<span style="float:left; color:"></span>
            <span style="font-size: 16px; background:url(<?php echo APP_PATH;?>statics/images/thy_img/close.png) no-repeat; display: block; float: right; height: 41px;width: 40px;" onclick="CloseDiv('MyDiv','fade')">&nbsp;&nbsp;</span>
        </div>
	<script language="javascript" type="text/javascript" src="<?php echo APP_PATH;?>statics/js/dialog.js"></script>
    <link href="<?php echo APP_PATH;?>statics/css/table_form.css" rel="stylesheet" type="text/css">
    <link href="<?php echo APP_PATH;?>statics/css/dialog.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="<?php echo APP_PATH;?>statics/js/dialog.js"></script>    
    <div class="form_div">    
    <form method="post" action="<?php echo APP_PATH;?>index.php?m=formguide&amp;c=index&amp;a=show&amp;formid=23&amp;siteid=1" name="myform" id="myform"> 
    <p><span class="form_c">姓&nbsp;&nbsp;氏：&nbsp;</span><em><input type="text" name="info[name]" style="width:200px;height:28px; font-size:14px; border-radius:5px; line-height:28px;"  id="name" size="10" value="" class="input-text"> </em>    </p>
    <p><span class="form_c"> &nbsp;</span><em><input name="info[sex]" type="radio" id="sex_1" value="1" checked> 先生<input type="radio" name="info[sex]" id="sex_2" value="2"> 女士</em>    </p>
    <p><span class="form_c">手机号：&nbsp;</span><em><input type="text" name="info[phone]" id="phone" style="width:200px;height:28px; font-size:14px; border-radius:5px; line-height:28px;" value="" size="" class="input-text"> </em>    </p>
    <input type="hidden" name="info[xuqiu]" id="xuqiu" size="50" value="<?php echo $title;?>" class="input-text">
    <input type="hidden" name="info[lianjie]" id="lianjie" size="50" value="<?php echo $url;?>" class="input-text"> 
    <input type="hidden" name="info[leixing]" id="lianjie" size="50" value="<?php echo $CATEGORYS[$catid]['catname'];?>" class="input-text"> 
    <p><input type="submit" name="dosubmit" id="dosubmit" style="margin-top: 64px; margin-left: 118px; padding: 10px 20px; font-size: 18px; font-family: '微软雅黑'; color: #FFF; background: none;  display: block; text-align: center; border: none;" value=" 提&nbsp;&nbsp;交 "> </form>  </p>  
    </div>
    </div>
    </div>
<style>
.black_overlay{
	display: none;
	position: absolute;
	top: 0%;
	left: 0%;
	width: 100%;
	height: 100%;
	background-color: black;
	z-index:1001;
	-moz-opacity: 0.8;
	opacity:.80;
	filter: alpha(opacity=80);
}
.white_content {
	display: none;
	position:fixed;
	top: 40%;
	margin-top:-150px;
	left: 50%;
	margin-left:-250px;
	width: 500px;
	height: 300px;
	background-color: white;
	padding:20px;
	border-radius:5px;
	z-index:1002;
	overflow: auto;
}
.white_content_small {
	display: none;
	position: absolute;
	top: 20%;
	left: 30%;
	width: 40%;
	height: 50%;
	border: 16px solid lightblue;
	background-color: white;
	z-index:1002;
	overflow: auto;
}
#myform{width:360px; margin:0px auto;}
#myform p{ margin:10px;}
#myform p span{display:block; font-size:22px; color:#006dbf; width:100px; float:left;}
#myform p em{ font-style:normal; display:block;}
</style>

<?php include template('yp', 'footer'); ?>