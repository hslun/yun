<?php
defined('IN_PHPCMS') or exit('No permission resources.');
pc_base::load_app_class('admin','admin',0);
class info extends admin {
	private $db;
	function __construct() {
		parent::__construct();
		$this->db = pc_base::load_model('extend_setting_model');
		$this->sites = pc_base::load_app_class('sites');
		pc_base::load_sys_class('form', '', 0);
	}
	
	/**
	 * 信息模型配置
	 */
	public function init() {
		if(isset($_POST['dosubmit'])) {
		$setting = $city_default = array();
		//信息模型基本配置
		$setting = array(
					'info_linkageid' => intval($_POST['setting']['info_linkageid']),
					'info_cachetime' => intval($_POST['setting']['info_cachetime']),
					'img_contact' => intval($_POST['setting']['img_contact']),
					'multi_city' => intval($_POST['setting']['multi_city']),
					'info_catid' => intval($_POST['setting']['info_catid']),
					'info_modelid' => addslashes(trim($_POST['setting']['info_modelid'])),
					'top_city' => intval($_POST['setting']['top_city']),
					'top_city_posid' => intval($_POST['setting']['top_city_posid']),
					'top_zone' => intval($_POST['setting']['top_zone']),
					'top_zone_posid' => intval($_POST['setting']['top_zone_posid']),
					'top_district' => intval($_POST['setting']['top_district']),
					'top_district_posid' => intval($_POST['setting']['top_district_posid']),
					);					
			
		$setting = array2string($setting);				

		//更新基本配置记录	
		$this->db->update(array('data'=>$setting), array('key'=>'info_setting')); 
		$this->_cache();		
		showmessage(L('setting_succ').$snda_error, HTTP_REFERER);
		
		} else {
			$info = $citys = $city = array();
			$info = $this->db->get_one(array('key'=>'info_setting'));			
			extract(string2array($info['data']));			
	
			if($citys = $this->db->select(array('key'=>'info_city'))) {
				foreach ($citys as $c) {
					$city[$c[id]] = string2array($c['data']);
				}
			}		
			$show_header = 1;
			include $this->admin_tpl('info_setting');
		}
	}	
	
	/**
	 * 删除城市
	 */
	public function delete_city() {
		$id = intval($_GET['id']);
		if($this->db->count(array('key'=>'info_city')) <= 1) {
			exit('less_than_1');
		}
		if($this->db->delete(array('id'=>$id))) {
			$this->_cache();
			exit('1');
		} else {
			exit('0');
		}
		
	}
	
	/**
	 * 保存城市
	 */
	public function save_city() {
		pc_base::load_sys_func('iconv');
		$id = intval($_POST['id']);
		$city['name'] = iconv('utf-8', CHARSET, addslashes($_POST['name']));
		
	     //没有填写拼音默认将城市中文名称转化为拼音
		if($_POST['pinyin'] == '') {
			if(strtolower(CHARSET) == 'utf-8') {
				$str_py = gbk_to_pinyin(iconv(CHARSET, gbk, $city['name']));				
				$city['pinyin'] = strtolower(implode('', $str_py));
			} else {
				$city['pinyin'] = strtolower(implode('', gbk_to_pinyin($city['name'])));
			}
		} else {
			$city['pinyin'] = trim($_POST['pinyin']);
		}
		$city['linkageid'] = $_POST['linkageid'];
		if($city['name'] == '' || $city['pinyin']==''){
			exit('post_error');
		}
		$city = array2string($city);
		if($id == 0) {	
			$insertid = $this->db->insert(array('key'=>'info_city','data'=>$city),TRUE);
			$this->_cache();
			if($insertid) { echo $insertid; exit; }
			else { exit('0');}
		} else {
			$this->db->update(array('data'=>$city), array('key'=>'info_city','id'=>$id)); 
			$this->_cache();
			exit('1');
		}
	}
	
	function public_rewriteurl() {
		$modelid = $_GET['modelid'];
		$modelids = strpos($modelid,',') === FALSE && is_numeric($modelid) ? array($modelid) : explode(',',$modelid);
		$apache_rewriteurl  = '';
		if(is_array($modelids)) foreach($modelids as $m) {
			$rewriteurl_1 = 'list-([0-9]+)-(.*)-';
			$rewriteurl_2 = 'index.php?m=content&c=index&a=lists&catid=$1&$city=$2';			
			$num = 3;
			$fields = getcache('model_field_'.$m,'model');
			if(is_array($fields) && !empty($fields)) {
				ksort($fields);
				foreach ($fields as $_v=>$_k) {
					if($_k['filtertype'] || $_k['rangetype']) {
						$rewriteurl_1 .='(.*)-';
						$rewriteurl_2 .= '&'.$_v.'=$'.$num ;
						$num ++;
					}
				}
				$rewriteurl_1 .='([0-9]+).html';
				$rewriteurl_2 .= '&page=$'.$num;
				$apache_rewriteurl .= 'RewriteRule ^'.$rewriteurl_1.'   '.$rewriteurl_2."\n";										
			}			
		}
		$ng_rewriteurl .= "if (!-e \$request_filename) {\n\treturn 404;\n}";
		$show_header = 1;
		include $this->admin_tpl('info_setting');
	}
	private function _cache() {
		$info = $this->db->get_one(array('key'=>'info_setting'));
		$setting = string2array($info['data']);
		setcache('info_setting', $setting,'commons');
		$info_citys = $this->db->select(array('key'=>'info_city'));
		foreach ($info_citys as $c) {
			$city_data = string2array($c['data']);
			$city_data['id'] = $c['id'];
			$citys[$city_data['pinyin']] = $city_data;
			$_citys[$city_data['linkageid']] = $city_data;
		}
		setcache('info_citys', $citys,'commons');
		setcache('info_citys_id', $_citys,'commons');
	}
}
?>