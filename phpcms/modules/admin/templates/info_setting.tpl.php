<?php
defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header');
if(ROUTE_A=='public_rewriteurl') {
?>
<div class="pad-10">
<div class="explain-col">
<strong><?php echo L('explain')?>：</strong><br />
<?php echo L('notice')?><?php echo L('info_notice','','info')?>
</div>
<div class="bk10"></div>
<fieldset>
<legend>Apache Web Server</legend>
<pre>
RewriteEngine on
RewriteRule ^content-([0-9]+)-([0-9]+)-([0-9]+).html  index.php?m=content&c=index&a=show&catid=$1&id=$2&page=$3
RewriteRule ^show-([0-9]+)-([0-9]+)-([0-9]+).html  index.php?m=content&c=index&a=show&catid=$1&id=$2&page=$3
RewriteRule ^list-([0-9]+)-([0-9]+).html  index.php?m=content&c=index&a=lists&catid=$1&page=$2
RewriteRule ^list-([0-9]+)-([a-zA-Z_]+)-([0-9]+).html  index.php?m=content&c=index&a=lists&catid=$1&city=$2&page=$3
<?php echo $apache_rewriteurl?>
</pre>
</fieldset>
<div class="bk10"></div>
</div>
<?php } else { ?>
<form action="?m=admin&c=info&a=init" method="post" id="myform">
<div class="pad-10">
<div class="col-tab">
<ul class="tabBut cu-li">
            <li id="tab_setting_1" class="on" onclick="SwapTab('setting','on','',5,1);"><?php echo L('setting_basic_cfg')?></li>
            <li id="tab_setting_2" onclick="SwapTab('setting','on','',5,2);"><?php echo L('city_setting','','info')?></li>
</ul>
<div id="div_setting_1" class="contentList pad-10">
<table width="100%"  class="table_form">
  <tr>
    <th width="150"><?php echo L('info_linkageid')?></th>
    <td class="y-bg"><input type="text" class="input-text" name="setting[info_linkageid]" id="info_linkageid" size="10" value="<?php echo $info_linkageid?>"/></td>
  </tr>
  <tr>
    <th width="150"><?php echo L('info_cachetime')?></th>
    <td class="y-bg"><input type="text" class="input-text" name="setting[info_cachetime]" id="info_cachetime" size="10" value="<?php echo $info_cachetime?>"/></td>
  </tr>  
  <tr>
    <th width="150"><?php echo L('img_contact')?></th>
    <td class="y-bg">
    <input name="setting[img_contact]" value="1" type="radio" <?php echo ($img_contact=='1') ? ' checked' : ''?>> <?php echo L('setting_yes')?>&nbsp;&nbsp;&nbsp;&nbsp;
	  <input name="setting[img_contact]" value="0" type="radio" <?php echo ($img_contact=='0') ? ' checked' : ''?>> <?php echo L('setting_no')?>
	 </td>
  </tr>        
   <tr>
   <th width="150"><?php echo L('multi_city')?></th>
    <td class="y-bg">
    <input name="setting[multi_city]" value="1" type="radio" <?php echo ($multi_city=='1') ? ' checked' : ''?>> <?php echo L('setting_yes')?>&nbsp;&nbsp;&nbsp;&nbsp;
	  <input name="setting[multi_city]" value="0" type="radio" <?php echo ($multi_city=='0') ? ' checked' : ''?>> <?php echo L('setting_no')?>
	</td>
  </tr>
  <tr>
    <th width="150"><?php echo L('info_catid')?></th>
    <td class="y-bg"><input type="text" class="input-text" name="setting[info_catid]" id="info_catid" size="10" value="<?php echo $info_catid?>"/></td>
  </tr>   
  <tr>
    <th width="150"><?php echo L('info_modelid')?></th>
    <td class="y-bg"><input type="text" class="input-text" name="setting[info_modelid]" id="info_modelid" size="10" value="<?php echo $info_modelid?>"/> <?php echo L('info_modelid_tips')?> <a href="?m=admin&c=info&a=public_rewriteurl&modelid=<?php echo $info_modelid?>" target="_blank" class="blue">[<?php echo L('info_apacherw')?>]</a></td>
  </tr> 
  <tr>
    <th width="150"><?php echo L('info_top_setting')?></th>
    <td class="y-bg"> 
	<?php echo L('top_city').L('info_top_cost')?>：<input type="text" class="input-text" name="setting[top_city]" id="top_city" size="5" value="<?php echo $top_city?>"/><?php echo L('info_top_jifen')?> <?php echo L('info_posid')?><input type="text" class="input-text" name="setting[top_city_posid]" id="top_city_posid" size="5" value="<?php echo $top_city_posid?>"/><div class="bk10"></div>
	<?php echo L('top_zone').L('info_top_cost')?>：<input type="text" class="input-text" name="setting[top_zone]" id="top_zone" size="5" value="<?php echo $top_zone?>"/><?php echo L('info_top_jifen')?> <?php echo L('info_posid')?><input type="text" class="input-text" name="setting[top_zone_posid]" id="top_zone_posid" size="5" value="<?php echo $top_zone_posid?>"/><div class="bk10"></div>
	<?php echo L('top_district').L('info_top_cost')?>：<input type="text" class="input-text" name="setting[top_district]" id="top_district" size="5" value="<?php echo $top_district?>"/><?php echo L('info_top_jifen')?> <?php echo L('info_posid')?><input type="text" class="input-text" name="setting[top_district_posid]" id="top_district_posid" size="5" value="<?php echo $top_district_posid?>"/>
	</td>
  </tr> 
  
</table>
<div class="bk15"></div>
<input name="dosubmit" type="submit" value="<?php echo L('submit')?>" class="button">
</div>
<div id="div_setting_2" class="contentList pad-10 hidden">
  <table width="100%"  class="table_form">
  <tr>
    <th width="150"><?php echo L('city_setting')?></th>
    <td class="y-bg">
		 <input type="button" class="button" onclick="add_city(this);" value="<?php echo L('add_city')?>">
     </td>
  </tr> 
  <?php if(is_array($city) && !empty($city)) { foreach ($city as $k =>$c) {?> 
	<tr>
	<th width="150"></th>
	<td class="y-bg">
	
	<?php echo L('info_city_name')?> <input type="text" class="input-text" name="name"  size="20" value="<?php echo $c['name']?>"/> 
	<?php echo L('info_city_pinyin')?> <input type="text" class="input-text" name="pinyin" size="20" value="<?php echo $c['pinyin']?>"/>  
	<?php echo L('info_city_posid')?> <input type="text" class="input-text" name="linkageid" size="10" value="<?php echo $c['linkageid']?>"/> <span onclick="save_city(this,'<?php echo $k?>')" class="cu"><?php echo L('edit')?></span> <span onclick="del_city(this,'<?php echo $k?>')" class="cu"><?php echo L('delete')?></span></td></tr>  
  <?php }}?>
</table>
</div>

</div>
</div>
</form>
<?php } ?>
</body>
<script type="text/javascript">

function SwapTab(name,cls_show,cls_hide,cnt,cur){
    for(i=1;i<=cnt;i++){
		if(i==cur){
			 $('#div_'+name+'_'+i).show();
			 $('#tab_'+name+'_'+i).attr('class',cls_show);
		}else{
			 $('#div_'+name+'_'+i).hide();
			 $('#tab_'+name+'_'+i).attr('class',cls_hide);
		}
	}
}

function add_city(obj){
	var table = $('#div_setting_2 .table_form');	
	table.append('<tr><th width="150"></th><td class="y-bg"><?php echo L('info_city_name')?> <input type="text" class="input-text" name="name"  size="20" value=""/> <?php echo L('info_city_pinyin')?> <input type="text" class="input-text" name="pinyin" size="20" value=""/>  <?php echo L('info_city_posid')?> <input type="text" class="input-text" name="linkageid" size="10" value=""/> <span onclick="save_city(this)" class="cu"><?php echo L('submit')?></span> <span onclick="del_city(this)" class="cu"><?php echo L('delete')?></span></td></tr>');
}

function del_city(obj,id) {
	var topparent = $(obj).parent().parent();
	 window.top.art.dialog({content:'<?php echo L('info_city_confirm_del')?>', fixed:true, style:'confirm', id:'att_delete'}, 
		function(){
				$.get('?m=admin&c=info&a=delete_city&id='+id+'&pc_hash=<?php echo $_SESSION['pc_hash']?>',function(data){
					if(isNaN(data) && data=='less_than_1') alert('<?php echo L('info_city_not_be_del')?>'); 
					else if(data == 1) topparent.fadeOut("slow");
				})
					 	
					 }, 
		function(){});	
	
}

function save_city(obj,edit) {
	var name = $(obj).siblings("input[name='name']").val();
	var pinyin = $(obj).siblings("input[name='pinyin']").val();
	var linkageid = $(obj).siblings("input[name='linkageid']").val();
	var edit =  edit ? edit : 0;
	 window.top.art.dialog({content:'<?php echo L('info_city_confirm_save')?>', fixed:true, style:'confirm', id:'att_delete'}, 
				function(){
				$.post('?m=admin&c=info&a=save_city&pc_hash=<?php echo $_SESSION['pc_hash']?>', {name: name,pinyin: pinyin,linkageid: linkageid,id: edit},function(data){
					if(isNaN(data)) {
						alert('<?php echo L('info_city_name_empty')?>');
					} else if(data != 0) {
						var js = 'save_city(this,\''+data+'\')';
						var newclick = eval("(function(){"+js+"});");
						$(obj).attr("onclick",'').click(newclick);
						$(obj).html("<?php echo L('edit')?>");
					}
				})					 	
					 }, 
				function(){});	
}

</script>
</html>