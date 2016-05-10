<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><div id="foot">
	<div class="foot">
    	<ul>
        	<li><h3><a href="#">产品</a></h3></li>
            <li><a href="<?php echo APP_PATH;?>/index.php?m=content&c=index&a=lists&catid=56">随e飞</a></li>
            <li><a href="http://www.weixiuke.com.cn/"  target="_blank">维修客</a></li>
            <li><a href="http://114.215.188.97:8080/OMMTest/"  target="_blank">航服务</a></li>
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
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=c1ddb0191801c28ba8f0d9c9bfa6905c&action=lists&catid=28&num=12\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'28','limit'=>'12',));}?>
			<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
          	<li><a href="<?php echo $r['url'];?>"><?php echo $r['title'];?></a></li>
			<?php $n++;}unset($n); ?>
			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
        </ul>
    </div>
    <div class="foot_nav">
        <a href="<?php echo APP_PATH;?>/index.php?m=content&c=index&a=lists&catid=56">随e飞</a>
        <a href="http://www.weixiuke.com.cn/"  target="_blank">维修客</a>
        <a href="http://114.215.188.97:8080/OMMTest/"  target="_blank">运行控制</a>
        <a  href="<?php echo APP_PATH;?>index.php?m=content&c=index&a=lists&catid=9">通航供需平台</a>
        <p>Copyright©2013-2016通航云 tonghangyun.com.cn 版板所有 京ICP备14013104号-5</p>
    </div>

</div>
</body>
</html>
