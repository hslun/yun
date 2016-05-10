<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php include template("content","header"); ?>
<script type="text/javascript">
$(document).ready(function() {
	$('.menu_chanpin').children().attr('id','cur');
});
</script>

	<div class="chanpin_box">
		<div class="chanpin_title">
			监视服务
		</div>
		<div class="chanpin_one">
			<img src="<?php echo IMG_PATH;?>jichang.png" alt="" />
			<div class="chanpin_h1">
				<span class="chanpin_head">随e飞</span></br>
				<span class="chanpin_text">移动端飞行器定位</span>
			</div>
			<img src="<?php echo IMG_PATH;?>jichang.png" alt="" />
			<div class="chanpin_h1">
				<span class="chanpin_head">塔台监视系统</span></br>
				<span class="chanpin_text">pc端飞行器定位</span>
			</div>
			<div style="clear:both;"></div>
			<div class="chanpin_title_one">
				运营服务
			</div>
		</div>
		<div class="chanpin_one">
			<img src="<?php echo IMG_PATH;?>jichang.png" alt="" />
			<div class="chanpin_h1">
				<span class="chanpin_head">机务维修管理系统</span></br>
				<span class="chanpin_text">支持网页版、ios移动端</span>
			</div>
			<img src="<?php echo IMG_PATH;?>jichang.png" alt="" />
			<div class="chanpin_h1">
				<span class="chanpin_head">运行控制系统</span></br>
				<span class="chanpin_text">企业定制化</span>
			</div>
			<div style="clear:both;"></div>
			<div class="chanpin_title_one">
				通航基础信息检索
			</div>
		</div>
		<div class="chanpin_one">
			<img src="<?php echo IMG_PATH;?>jichang.png" alt="" />
			<div class="chanpin_h1">
				<span class="chanpin_head">通航机场信息检索</span></br>
			
			</div>
			<img src="<?php echo IMG_PATH;?>jichang.png" alt="" />
			<div class="chanpin_h1">
				<span class="chanpin_head">通航企业信息检索</span></br>
		
			</div>
			<img src="<?php echo IMG_PATH;?>jichang.png" alt="" />
			<div class="chanpin_h1">
				<span class="chanpin_head">飞行器注册号检索</span></br>
		
			</div>
			<div style="clear:both;height:235px;"></div>
			
		</div>
	</div>
 <?php include template('content', 'footer'); ?>