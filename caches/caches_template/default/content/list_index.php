<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php include template("content","header"); ?>
<script type="text/javascript">
$(document).ready(function() {
	$('.menu_jiansuo').children().attr('id','cur');
});
</script>
	
	<div class="index_box">
		<div>&nbsp;</div>
		<form action="" method="post">
		<div class="content">
			<img src="<?php echo IMG_PATH;?>index/logo.png" alt="" />
			<br />
				<div class="index_search">
			
					<div class="jichang_title">
						机场
					</div>
					<div class="qiye_title">
						企业
					</div>
					<div style="clear:both;"></div>
					<input type="text" name="jichang" class="jichang" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;请输入机场名称"/>
					<input type="text" name="qiye" class="qiye" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;请输入企业名称" style="display:none;"/>
					<input type="submit" class="tijiao" value="搜索" />
				</div>
			
		</div>
		</form>
	</div>
 <?php include template('content', 'footer'); ?>