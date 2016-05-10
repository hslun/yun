<?php
return '<!--expiretime:1447674112-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=7" />
<title>北京黄页大全 - PHPCMS演示站</title>
<meta name="keywords" content="北京黄页大全,企业库,网上商店">
<meta name="description" content="本站是北京地区最大、最全的企业库，欢迎入驻！">
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
<!--main-->
<div class="main clear">
	<div class="top-gg">
    	<ul class="ads-146-60 clear">
						         </ul>
	</div>
    <div class="col-left">
    	<div class="box recom">
        	<h5 class="title-2">市场行情</h5>
            <div class="content">
			                <ul class="list lh22">
				                </ul>
                        </div>
        </div>
        <div class="col-auto">
        	<div class="yp-slide">
                <div class="FocusPic">
                    <div class="content" id="yp-slide">
                        <div class="changeDiv">  
                        <!--  -->
						<!-- 将以下内容用上面碎片替换 -->
						<a href="http://bbs.phpcms.cn" title="黄页Beta 正式发布"><img src="http://tonghangyun.com/statics/images/yp/ad.png" alt="黄页Beta 正式发布" width="447" height="201" /></a>
						<!-- end -->
                        </div>
                    </div>
                </div>
            </div>
        	<div class="process"></div>
        </div>
    </div>
    <div class="col-auto">
				 
        <form method="post" action="http://tonghangyun.com/index.php?m=member&c=index&a=login" id="myform2" name="myform2">
		<input type="hidden" name="forward" id="forward" value="http%3A%2F%2Ftonghangyun.com%2Findex.php%3Fm%3Dyp%26c%3Dindex%26a%3Dinit">
        <div class="yp-login ypbox">
            <div class="title fb">企业登录</div>
            <ul class="login-form">
            	<li><label>用户名：</label><input type="text" size="30" class="input" value="" name="username" id="k_username"></li>
                <li><label>密　码：</label><input type="password" size="30" class="input" name="password" id="k_password"></li>
                <li><label>验证码：</label><input type="text" id="code" name="code" id="code" size="8" class="input"><img id=\'code_img\' onclick=\'this.src=this.src+"&"+Math.random()\' src=\'http://tonghangyun.com/api.php?op=checkcode&code_len=4&font_size=14&width=84&height=24&font_color=&background=\'></li>
                <li><label>&nbsp;</label><input type="submit" name="dosubmit" class="btn" value="">　<a href="http://tonghangyun.com/index.php?m=member&c=index&a=register&siteid=1" class="blue" target="_blank">免费注册</a><span class="line"> | </span><a href="http://tonghangyun.com/index.php?m=member&c=index&a=public_forget_password&siteid=1" class="blue">忘记密码？</a></li>
            </ul>
            <span class="o1"></span><span class="o2"></span><span class="o3"></span><span class="o4"></span>
        </div>
        </form>
				    	<dl class="announce">
        	<dt>公告</dt>
            <dd></dd>
        </dl>
    </div>
    <div class="bk10"></div>
    <div class="col-left">
    	<div class="category-main box">
        	<div class="cat-name"><h4><a href="">所有类目</a></h4></div>
            <div class="cat-top-nav blue">
                         </div>
            <div class="cat-content">
             			</div>
        </div>
        <div class="bk10"></div>
        <div class="box generic">
        	<div class="title"><strong>最新商机</strong> <a href="http://tonghangyun.com/index.php?m=yp&c=index&a=lists&modelid=15&areaid=&catid=0&chengrenshu=&tid=1&page=">供应</a><span> | </span> <a href="http://tonghangyun.com/index.php?m=yp&c=index&a=lists&modelid=15&areaid=&catid=0&chengrenshu=&tid=2&page=">求购</a><span> | </span> <a href="http://tonghangyun.com/index.php?m=yp&c=index&a=lists&modelid=15&areaid=&catid=0&chengrenshu=&tid=3&page=">二手</a><span> | </span> <a href="http://tonghangyun.com/index.php?m=yp&c=index&a=lists&modelid=15&areaid=&catid=0&chengrenshu=&tid=4&page=">促销</a></div>
            <div class="content clear">
            
            
             			              	<div class="sub-box">
                	<h2 class="blue"><a href="http://tonghangyun.com/index.php?m=yp&c=index&a=lists&modelid=15&areaid=&catid=0&chengrenshu=&tid=1&page=">供应信息</a><a href="http://tonghangyun.com/index.php?m=yp&c=index&a=lists&modelid=15&areaid=&catid=0&chengrenshu=&tid=1&page=" class="more">更多>></a></h2>
                    					<div class="pic">
					                    	<a href="http://tonghangyun.com/index.php?m=yp&c=index&a=show&catid=12&id=1" target="_blank"><img src="http://tonghangyun.com/uploadfile/2015/1113/20151113042317689.jpg" width="110" height="80" alt="澳大利亚包机飞行，名额有限，抓紧报名"/></a>
                      <p><a href="http://tonghangyun.com/index.php?m=yp&c=index&a=show&catid=12&id=1" target="_blank">澳大利亚包机飞行，名额有限，抓紧报名</a></p>
					                    </div>
					                    <ul class="list">
                    	                    	<li>·<a href="http://tonghangyun.com/index.php?m=yp&c=index&a=show&catid=12&id=1" target="_blank">澳大利亚包机飞行，名</a></li>
                    	                    </ul>
                </div>                
                             	<div class="sub-box">
                	<h2 class="blue"><a href="http://tonghangyun.com/index.php?m=yp&c=index&a=lists&modelid=15&areaid=&catid=0&chengrenshu=&tid=2&page=">求购信息</a><a href="http://tonghangyun.com/index.php?m=yp&c=index&a=lists&modelid=15&areaid=&catid=0&chengrenshu=&tid=2&page=" class="more">更多>></a></h2>
                    					<div class="pic">
					                    </div>
					                    <ul class="list">
                    	                    </ul>
                </div>                
                             	<div class="sub-box">
                	<h2 class="blue"><a href="http://tonghangyun.com/index.php?m=yp&c=index&a=lists&modelid=15&areaid=&catid=0&chengrenshu=&tid=3&page=">二手信息</a><a href="http://tonghangyun.com/index.php?m=yp&c=index&a=lists&modelid=15&areaid=&catid=0&chengrenshu=&tid=3&page=" class="more">更多>></a></h2>
                    						<div class="pic">
												</div>
					                    <ul class="list">
                    	                    </ul>
                </div>                
                             	<div class="sub-box">
                	<h2 class="blue"><a href="http://tonghangyun.com/index.php?m=yp&c=index&a=lists&modelid=15&areaid=&catid=0&chengrenshu=&tid=4&page=">促销信息</a><a href="http://tonghangyun.com/index.php?m=yp&c=index&a=lists&modelid=15&areaid=&catid=0&chengrenshu=&tid=4&page=" class="more">更多>></a></h2>
                    						<div class="pic">
												</div>
					                    <ul class="list">
                    	                    </ul>
                </div>      
            </div>
        </div>
        <div class="bk10"></div>
        <div class="box generic">
        	<div class="title"><strong>产品推荐</strong> </div>
            <ul class="content news-photo picbig clear">
               
			  
						<li>
			<div class="img-wrap">
			<a title="" href="http://tonghangyun.com/index.php?m=yp&c=index&a=show&catid=12&id=1" target="_blank"><img title="澳大利亚包机飞行，名额有限，抓紧报名" src="http://tonghangyun.com/uploadfile/2015/1113/20151113042317689.jpg" style="height: 85px; width: 61.5132px;"></a>
			</div>
			<a title="澳大利亚包机飞行，名额有限，抓紧报名" href="http://tonghangyun.com/index.php?m=yp&c=index&a=show&catid=12&id=1">澳大利亚fasle</a>
			</li> 
						           </ul>
        </div>
    </div>
    <div class="col-auto">
    	<div class="box box-tab fillet fillet-blue">
        	<ul class="tab clear">
            	<li class="on">最新加盟</li>
                <li></li>
             </ul>
				<ul class="list-num">
					 										<li><em class="n1" >1</em><a href="http://tonghangyun.com/index.php?m=yp&c=com_index&userid=1">test公司</a></li>
 										 
				</ul>
            
            <span class="o1"></span><span class="o2"></span><span class="o3"></span><span class="o4"></span>
        </div>
        <div class="bk10"></div>
        <div class="box box-tab fillet fillet-blue">
        
        	<ul class="tab clear swap-tab cu-li">
            	<li class="on">24小时热点商机</li>
                <li>本周热点商机</li>
            </ul>
        	 <div class="swap-content">
													<ul class="list-num" >
											</ul>
					        					<ul class="list-num" style="display:none;">
											<li><em class="n1">1</em><a href="http://tonghangyun.com/index.php?m=yp&c=index&a=lists&modelid=15&areaid=&catid=0&chengrenshu=&tid=1&page=" class="blue" target="_blank">[供应]</a> <a href="http://tonghangyun.com/index.php?m=yp&c=index&a=show&catid=12&id=1">澳大利亚包机飞行...</a></li>
									</ul>
				             </div>
            
            <span class="o1"></span><span class="o2"></span><span class="o3"></span><span class="o4"></span>
        </div>
        <div class="bk10"></div>
        <div class="box box-tab fillet fillet-blue">
        	<ul class="tab clear swap-tab cu-li">
            	<li class="on">推荐产品</li>
                <li>最新产品</li>
            </ul>
            <div class="swap-content">
                	            <ul class="list-num">
				 		        	            </ul>
	        	<ul class="list-num" style="display:none;">
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