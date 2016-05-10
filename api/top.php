<?php
defined('IN_PHPCMS') or exit('No permission resources.'); 
/**
 * 清理过期推荐位
 */
$pos_data ='';
$pos_data = pc_base::load_model('position_data_model');
$sql = '`expiration` < \''.SYS_TIME.'\' AND `expiration` > 0';
$pos_data->delete($sql);
?>
