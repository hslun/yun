<?php
return '<!--expiretime:1447664172-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=7" />
<title>品牌正品 商城保障 - PHPCMS演示站</title>
<meta name="keywords" content="C2C,购物平台,正品保障">
<meta name="description" content="亚洲最大网上购物网站——打造的在线B2C购物平台（B2C，Business to Customer）。在商城购物，享受100%正品保障、7天退换货、提供发票的服务。加入商城，将为全新的B2C事业创造更多的奇迹。">
<link href="http://tonghangyun.com/statics/css/reset.css" rel="stylesheet" type="text/css" />
<link href="http://tonghangyun.com/statics/css/default_yp_blue.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript" src="http://tonghangyun.com/statics/js/jquery.min.js"></script>
<script language="javascript" type="text/javascript" src="http://tonghangyun.com/statics/js/jquery.sGallery.js"></script>
<script language="javascript" type="text/javascript" src="http://tonghangyun.com/statics/js/yp_common.js"></script>
<link rel="stylesheet" type="text/css" href="http://tonghangyun.com/statics/css/thy_css/common.css">
<link rel="stylesheet" type="text/css" href="http://tonghangyun.com/statics/css/thy_css/slide.css"/>

<script type="text/javascript" src="http://tonghangyun.com/statics/js/thy_js/jquery.min.js"></script>
<script type="text/javascript" src="http://tonghangyun.com/statics/js/thy_js/slide.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$(".slideInner").slide({
		slideContainer: $(\'.slideInner a\'),
		effect: \'easeOutCirc\',
		autoRunTime: 5000,
		slideSpeed: 1000,
		nav: true,
		autoRun: true,
		prevBtn: $(\'a.prev\'),
		nextBtn: $(\'a.next\')
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
<script type="text/javascript" src="http://tonghangyun.com/statics/js/thy_js/api"></script>
</head>
<body>
<div id="top">
	<div class="top">
    	<div class="diqu">
        	东北区<a href="#">[切换管理局]</a>
        </div>
        <div class="tianqi">
        	<a href="#">财湖机场 <img src="http://tonghangyun.com/statics/images/thy_img/tianqi.png" width="19" height="18" alt=""/> 21-23℃ <span>优</span></a>
        </div>
        <div class="top_help">
        	<a href="#">帮助中心</a><a href="#">联系我们</a>
        </div>
        <div class="index_login">
            <a href="http://tonghangyun.com/index.php?m=member&c=index&a=login">登录</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<a href="http://tonghangyun.com/index.php?m=member&c=index&a=register">注册</a>
        </div>
    
    </div>
</div>
<div id="menu">
    <div class="menu">
    	<a href="../index.html"><h1 class="logo">通航云</h1></a>
        <ul>
            <li><a href="{siteurl($siteid)}">首页</a></li>
    	{pc:content action="category" catid="0" num="25" siteid="$siteid" order="listorder ASC"}
			{loop $data $r}
			<li><a href="{$r[url]}">{$r[catname]}</a></li>
			{/loop}
        {/pc}        	
        </ul>
        <div class="search">
       	  <form>
            <input class="search_txt" type="text">
            <input type="submit" class="search_bt" value="&nbsp;">
          </form>
        </div>
    </div>
</div>
<div class="main clear">
    <div class="col-left">
    	<div class="category-main box generic">
        	<div class="title"><strong>商机分类</strong></div>
            <div class="cat-content">
			                <div class="cat-item ib">
                    <h4><a href="http://tonghangyun.com/index.php?m=yp&c=index&a=lists&catid=12">包机飞行</a></h4>
					                </div>
				                <div class="cat-item ib">
                    <h4><a href="http://tonghangyun.com/index.php?m=yp&c=index&a=lists&catid=13">飞行器静态租赁</a></h4>
					                </div>
				                <div class="cat-item ib">
                    <h4><a href="http://tonghangyun.com/index.php?m=yp&c=index&a=lists&catid=14">飞行器托管</a></h4>
					                </div>
				                <div class="cat-item ib">
                    <h4><a href="http://tonghangyun.com/index.php?m=yp&c=index&a=lists&catid=15">航油</a></h4>
					                </div>
				                <div class="cat-item ib">
                    <h4><a href="http://tonghangyun.com/index.php?m=yp&c=index&a=lists&catid=16">航材</a></h4>
					                </div>
				                <div class="cat-item ib">
                    <h4><a href="http://tonghangyun.com/index.php?m=yp&c=index&a=lists&catid=17">飞行执照</a></h4>
					                </div>
							</div>
        </div>
    </div>
    <div class="col-auto">
    	<div class="box box-tab fillet fillet-blue">
        	<ul class="tab clear swap-tab cu-li">
            	<li class="on">推荐产品</li>
                <li>最新产品</li>
            </ul>
			<div class="swap-content">
										<ul class="list-num">
									<li><em class="n1">1</em><a href="" class="blue">[]</a> <a href="http://tonghangyun.com/index.php?m=yp&c=index&a=show&catid=12&id=1">澳大利亚包机飞...</a></li>
								</ul>
										<ul class="list-num" style="display:none;">
								</ul>
						</div>
            <span class="o1"></span><span class="o2"></span><span class="o3"></span><span class="o4"></span>
        </div>
    	<div class="bk10"></div>
        <div class="box box-tab fillet fillet-blue">
        	<ul class="tab clear swap-tab cu-li">
            	<li class="on">24小时热点商机</li>
                <li>周热点商机</li>
            </ul>
			<div class="swap-content">
						         	<ul class="list-num">
				            </ul>
			                        <ul class="list-num" style="display:none;">
									<li><em class="n1">1</em><a href="http://tonghangyun.com/index.php?m=yp&c=index&a=lists&modelid=76&page=" class="blue" target="_blank">[供应]</a> <a href="http://tonghangyun.com/index.php?m=yp&c=index&a=show&catid=12&id=1">澳大利亚包机飞行...</a></li>
				            </ul>
						</div>
            <span class="o1"></span><span class="o2"></span><span class="o3"></span><span class="o4"></span>
        </div>
    </div>
</div>
<div id="foot">
	<div class="foot">
    	<ul>
        	<li><h3><a href="#">产品</a></h3></li>
            <li><a href="#">随e飞</a></li>
            <li><a href="#">维修客</a></li>
            <li><a href="#">航服务</a></li>
            <li><a href="#">大数据可视化</a></li>
        </ul>
    	<ul>
        	<li><h3><a href="#">支持中心</a></h3></li>
          <li><a href="#">产品文档</a></li>
            <li><a href="#">常见问题</a></li>
            <li><a href="#">学习资料</a></li>
            <li><a href="#">联系我们</a></li>
        </ul>
    	<ul>
        	<li><h3><a href="#">关于通航云</a></h3></li>
            <li><a href="#">招聘信息</a></li>
            <li><a href="#">用户协议</a></li>
            <li><a href="#">信息举报</a></li>
            <li><a href="#">了解通航云</a></li>
        </ul>
    	<ul class="hezuo">
        	<li style="width:330px;"><h3><a href="#">合作伙伴</a></h3></li>
            <li><a href="#">AOPA航空协会</a></li>
            <li><a href="#">首都通航研究院</a></li>
            <li><a href="#">华彬天星</a></li>
            <li><a href="#">海慧通航</a></li>
            <li><a href="#">中瑞通航</a></li>
          	<li><a href="#">临云行</a></li>
            <li><a href="#">极飞网</a></li>
            <li><a href="#">中航协通航委</a></li>
            <li><a href="#">民航安全管理网</a></li>
            <li><a href="#">飞行者联盟</a></li>
        </ul>
    </div>
    <div class="foot_nav">
        <a href="#">机场检索</a><a href="#">随e飞</a><a href="#">维修客</a><a href="#">通航供需平台</a><a href="#">气象情报</a>
        <p>Copyright©2013-2015通航云 tonghangyn.com 版板所有 京ICP备13040109号-2</p>
    </div>

</div>
</body>
</html>
';
?>