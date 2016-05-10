<?php

//插入分类信息联动菜单
$linkage_db = pc_base::load_model('linkage_model');

$keyid = $linkage_db->insert(array('name'=>'分类信息','style'=>1,'parentid'=>0,'child'=>0,'arrchildid'=>'','keyid'=>0,'listorder'=>0,'description'=>0,'siteid'=>0),TRUE);

$cityid = $linkage_db->insert(array('name'=>'北京','style'=>1,'parentid'=>0,'child'=>0,'arrchildid'=>'','keyid'=>$keyid,'listorder'=>0,'description'=>0,'siteid'=>0),TRUE);

$areaid = $linkage_db->insert(array('name'=>'朝阳','style'=>1,'parentid'=>$cityid,'child'=>0,'arrchildid'=>'','keyid'=>$keyid,'listorder'=>0,'description'=>0,'siteid'=>0),TRUE);

$linkage_db->insert(array('name'=>'国贸','style'=>1,'parentid'=>$areaid,'child'=>0,'arrchildid'=>'','keyid'=>$keyid,'listorder'=>0,'description'=>0,'siteid'=>0));

$linkage_db->insert(array('name'=>'CBD','style'=>1,'parentid'=>$areaid,'child'=>0,'arrchildid'=>'','keyid'=>$keyid,'listorder'=>0,'description'=>0,'siteid'=>0));


//插入数据模型

$sitemodel_db = pc_base::load_model('sitemodel_model');

$tablename = $sitemodel_db->table_exists('house') ? 'house_new' : 'house';

$modelid = $sitemodel_db->insert(array('siteid'=>'1','name'=>'房产信息','description'=>'','tablename'=>$tablename,'setting'=>'','addtime'=>'0','items'=>'0','enablesearch'=>'1','disabled'=>'0','default_style'=>'default','category_template'=>'category_info','list_template'=>'list_house','show_template'=>'show_house','js_template'=>'','sort'=>'0','type'=>'0'),TRUE);

$model_field_database = file_get_contents(PATH.'database'.DIRECTORY_SEPARATOR.'phpcms_model_field.sql');
$model_field_database = str_replace(array('VALUES(64','3398'),array('VALUES('.$modelid,$keyid),$model_field_database);
sql_execute($model_field_database);

//插入栏目数据
$category_db = pc_base::load_model('category_model');

$category_setting = array ('workflowid' => '','ishtml' =>0,'content_ishtml' =>0,  'create_to_html_root' =>0,  'template_list' => 'default',  'category_template' => 'category_info',  'list_template' => 'list_house',  'show_template' => 'show_house',  'meta_title' => '',  'meta_keywords' => '',  'meta_description' => '',  'presentpoint' =>1,  'defaultchargepoint' =>0,  'paytype' =>0,  'repeatchargedays' => 1,  'category_ruleid' => 6,  'show_ruleid' =>16);

$top_parentid = $category_db->insert(array('siteid'=>'1', 'module'=>'content', 'type'=>'0', 'modelid'=>$modelid, 'parentid'=>'0', 'arrparentid'=>'', 'child'=>'', 'arrchildid'=>'', 'catname'=>'分类信息',  'catdir'=>'fenlei', 'setting'=>array2string($category_setting), 'ismenu'=>'0', 'sethtml'=>'0'),TRUE);

$parentid = $category_db->insert(array('siteid'=>'1', 'module'=>'content', 'type'=>'0', 'modelid'=>$modelid, 'parentid'=>$top_parentid, 'arrparentid'=>'', 'child'=>'', 'arrchildid'=>'', 'catname'=>'房产信息', 'catdir'=>'fangchan', 'setting'=>array2string($category_setting), 'ismenu'=>'1', 'sethtml'=>'0'),TRUE);

$category_db->insert(array('siteid'=>'1', 'module'=>'content', 'type'=>'0', 'modelid'=>$modelid, 'parentid'=>$parentid, 'arrparentid'=>'', 'child'=>'', 'arrchildid'=>'', 'catname'=>'租房','catdir'=>'zufang', 'setting'=>array2string($category_setting), 'ismenu'=>'1', 'sethtml'=>'0'));

//创建数据表

$category_demo_database = file_get_contents(PATH.'database'.DIRECTORY_SEPARATOR.'phpcms_category_demo.sql');
$category_demo_database = str_replace('phpcms_house','phpcms_'.$tablename,$category_demo_database);
sql_execute($category_demo_database);

//插入推荐位数据

$position_db = pc_base::load_model('position_model');

$extention_setting = "get_linkage({zone},getinfocache(\'info_linkageid\'), \'_\',4)";

$city_posid = $position_db->insert(array('modelid'=>$modelid, 'catid'=>'0', 'name'=>'城市置顶', 'maxnum'=>'20', 'extention'=>$extention_setting, 'siteid'=>'1'),TRUE);

$zone_posid = $position_db->insert(array('modelid'=>$modelid, 'catid'=>'0', 'name'=>'区域置顶', 'maxnum'=>'20', 'extention'=>$extention_setting, 'siteid'=>'1'),TRUE);

$district_posid = $position_db->insert(array('modelid'=>$modelid, 'catid'=>'0', 'name'=>'商圈置顶', 'maxnum'=>'20', 'extention'=>$extention_setting, 'siteid'=>'1'),TRUE);

//插入搜索分类数据

$type_db = pc_base::load_model('type_model');

$type_db->insert(array('siteid'=>1, 'module'=>'search', 'modelid'=>$modelid, 'name'=>'房产信息'));

//插入扩展数据
$extend_setting_db = pc_base::load_model('extend_setting_model');

$charset_arr = pc_base::load_config('database', 'default');

$extend_setting_db->query("ALTER TABLE `phpcms_extend_setting` DEFAULT CHARACTER SET $charset_arr[charset] ");
$extend_setting_db->query("ALTER TABLE `phpcms_extend_setting` CHANGE `key` `key` CHAR( 30 ) CHARACTER SET $charset_arr[charset] ");
$extend_setting_db->query("ALTER TABLE `phpcms_extend_setting` CHANGE `data` `data` TEXT  CHARACTER SET $charset_arr[charset]");



$info_setting = array('info_linkageid'=>$keyid,'info_cachetime'=>0,'img_contact'=>1,'multi_city'=>0,'info_catid'=>$top_parentid,'info_modelid'=>$modelid,'top_city'=>'10','top_city_posid'=>$city_posid,'top_zone'=>8,'top_zone_posid'=>$zone_posid,'top_district'=>5,'top_district_posid'=>$district_posid);

$info_city_setting = array('name'=>'北京','pinyin'=>'beijing','linkageid'=>$cityid);


$extend_setting_db->insert(array('key'=>'info_setting','data'=>array2string($info_setting)));

$extend_setting_db->insert(array('key'=>'info_city','data'=>array2string($info_city_setting)));


//更新扩展数据缓存
$extend_setting_db = pc_base::load_model('extend_setting_model');
$info = $extend_setting_db->get_one(array('key'=>'info_setting'));

$setting = string2array($info['data']);
setcache('info_setting', $setting,'commons');
$info_citys = $extend_setting_db->select(array('key'=>'info_city'));

foreach ($info_citys as $c) {
	$city_data = string2array($c['data']);
	$city_data['id'] = $c['id'];
	$citys[$city_data['pinyin']] = $city_data;
	$_citys[$city_data['linkageid']] = $city_data;
}

setcache('info_citys', $citys,'commons');
setcache('info_citys_id', $_citys,'commons');

	
//以下为函数部分	
function sql_execute($data) {
	$sqls = _sql_split($data);
	if(is_array($sqls)) {
		foreach($sqls as $sql) {
			if(trim($sql) != '') {
				mysql_query($sql);
			}
		}
	} else {
		mysql_query($sqls);
	}	
}

function _sql_split($sql) {
	$dbsetting = pc_base::load_config('database','default');
	$dbcharset = $dbsetting['charset'];
	$tablepre = $dbsetting['tablepre'];
	if(mysql_get_server_info > '4.1' && $dbcharset)
	{
		$sql = preg_replace("/TYPE=(InnoDB|MyISAM|MEMORY)( DEFAULT CHARSET=[^; ]+)?/", "ENGINE=\\1 DEFAULT CHARSET=".$dbcharset,$sql);
	}
	$sql = str_replace('phpcms_', $tablepre, $sql);
	$sql = str_replace("\r", "\n", $sql);
	$ret = array();
	$num = 0;
	$queriesarray = explode(";\n", trim($sql));
	unset($sql);
	foreach($queriesarray as $query)
	{
		$ret[$num] = '';
		$queries = explode("\n", trim($query));
		$queries = array_filter($queries);
		foreach($queries as $query)
		{
			$str1 = substr($query, 0, 1);
			if($str1 != '#' && $str1 != '-') $ret[$num] .= $query;
		}
		$num++;
	}
	return $ret;
}
?>