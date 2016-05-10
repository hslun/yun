<?php 
define('PHPCMS_PATH', dirname(__FILE__).DIRECTORY_SEPARATOR.'../');
define('PATH', dirname(__FILE__).DIRECTORY_SEPARATOR);
include PHPCMS_PATH.'/phpcms/base.php';
pc_base::load_sys_class('param','','','0');

//升级程序配置
$configs = include PATH.'config.php';

$op = isset($_GET['op']) && trim($_GET['op']) ? trim($_GET['op']) : 'index';
$configs['steps'][] = 'index';
if (!in_array($op, $configs['steps'])) {
	showmessage('错误的操作流程，无法进行操作。');
}

//版本文件地址
$version_filepath = CACHE_PATH.'configs'.DIRECTORY_SEPARATOR.'version.php';

if ($configs['from_release'] <= '20101022') {
	include PHPCMS_PATH.'phpcms'.DIRECTORY_SEPARATOR.'libs'.DIRECTORY_SEPARATOR.'data'.DIRECTORY_SEPARATOR.'pc_version.php';
	$now_version = PC_VERSION;
	$now_release = PC_RELEASE;
} else {
	$now_version = pc_base::load_config('version', 'pc_version');
	$now_release = pc_base::load_config('version', 'pc_release');
}

//对补丁版本进行验证
if ($op != 'index' && isset($configs['version_check']) && $configs['version_check'] == 1) {
	if ($now_release < $configs['from_release']) {
		showmessage('本模型对版本要求严格!!<br/>请确定您的版本最后更新日期：<strong>'.$configs['from_release'].'</strong> 以上。');
	}
}

switch ($op) {
	case 'index':
		break;
		
	case 'ext':
		$file_list = glob(PATH.'ext'.DIRECTORY_SEPARATOR.'*');
		foreach ($file_list as $k=>$v) {
			if(in_array(strtolower(substr($v, -3, 3)), array('php', 'sql'))) {
				$file_list[$k] = $v;
			} else {
				unset($file_list[$k]);
			}
		}

		if (isset($_GET['step'])) {
			$num = isset($_GET['num']) && intval($_GET['num']) ?  intval($_GET['num']) : 0;
			$filename = isset($_GET['filename']) && trim($_GET['filename']) ?  trim($_GET['filename']) : '';
			$base_filename = basename($file_list[$num]);
			if ( empty($filename) || !isset($file_list[$num]) || $base_filename != $filename || !file_exists($file_list[$num])) {
				exit;
			}

			if (strtolower(substr($file_list[$num], -3, 3)) == 'sql' && $data = file_get_contents($file_list[$num])) {

				$model_name = substr($base_filename, 0, -4);
				if (!$db = pc_base::load_model($model_name.'_model')) {
					exit;
				}
				$mysql_server_version = $db->version();
				$dbcharset = pc_base::load_config('database','default');
				$dbcharset = $dbcharset['charset'];


				$sqls = explode(';', $data);
				foreach ($sqls as $v) {
					if (empty($v)) continue;
					if(mysql_get_server_info > '4.1' && $dbcharset) {
						$sql = preg_replace("/TYPE=(InnoDB|MyISAM|MEMORY)( DEFAULT CHARSET=[^; ]+)?/", "ENGINE=\\1 DEFAULT CHARSET=".$dbcharset,$v);
					}
					$db->query($v);
				}
			} elseif (strtolower(substr($file_list[$num], -3, 3)) == 'php' && file_exists($file_list[$num])) {
				include $file_list[$num];
			}

			echo $filename.'执行完成！';
			exit;
		} else {
			$str = '{';
			foreach ($file_list as $k=>$v) {
				$str .= ($k>0 ? ',' : '').basename($k).':\''.basename($v).'\'';
			}
			$str .='}';
			$num = count($file_list);
		}
		break;
		
	case 'version':
					
		break;
}
include PATH.'template'.DIRECTORY_SEPARATOR.'index.php';
?>