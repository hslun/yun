<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php include template("content","header"); ?>
<?php $info_linkageid = getinfocache('info_linkageid')?><!--  所在地 -->
<?php $city_id = is_numeric($city) ? getcity($city,'pinyin','info_citys_id') : trim($_GET['city'])?>
<?php $cityid = getcity($city_id,'linkageid')?>
<?php $cityname = getcity($city_id,'name')?>
<?php $city = getcity($city_id,'pinyin')?>
<!--main-->

<div id="main">
    <div class="gongqiu_list">
        <div class="mbx"><a href="<?php echo siteurl($siteid);?>">首页</a><span> > </span><a href="<?php echo $CATEGORYS['9']['url'];?>"><?php echo $CATEGORYS['9']['catname'];?></a><span> > </span><a href="<?php echo $CATEGORYS[$catid]['url'];?>"><?php echo $CATEGORYS[$catid]['catname'];?></a></div>
        <div class="gongqiu_city_list">
            <div class="gongqiu_city_list_1"><h4>类  别：</h4>
                <ul>
            <?php $n=1;if(is_array(subcat(getinfocache('11'),0,0,$siteid))) foreach(subcat(getinfocache('11'),0,0,$siteid) AS $r) { ?>
                <?php if($r[catid]==9) { ?>
                    <li><a class="f30" href="<?php echo makecaturl($r[url], $city, getinfocache('multi_city'));?>">全部</a></li>
                <?php } ?>
                <?php if($r[catid]==11) { ?>
                    <li><?php if($catid!=11) { ?><a class="f30" href="<?php echo makecaturl($r[url], $city, getinfocache('multi_city'));?>"><?php } ?><?php echo $r['catname'];?><?php if($catid!=11) { ?></a><?php } ?></li>
                <?php } ?>
                <?php if($r[catid]==17) { ?>
                    <li><?php if($catid!=17) { ?><a class="f30" href="<?php echo makecaturl($r[url], $city, getinfocache('multi_city'));?>"><?php } ?><?php echo $r['catname'];?><?php if($catid!=17) { ?></a><?php } ?></li>
                <?php } ?>
                <?php if($r[catid]==18) { ?>
                    <li><?php if($catid!=18) { ?><a class="f30" href="<?php echo makecaturl($r[url], $city, getinfocache('multi_city'));?>"><?php } ?><?php echo $r['catname'];?><?php if($catid!=18) { ?></a><?php } ?></li>
                <?php } ?>
                <?php if($r[catid]==19) { ?>
                    <li><?php if($catid!=19) { ?><a class="f30" href="<?php echo makecaturl($r[url], $city, getinfocache('multi_city'));?>"><?php } ?><?php echo $r['catname'];?><?php if($catid!=19) { ?></a><?php } ?></li>
                <?php } ?>
                <?php if($r[catid]==20) { ?>
                    <li><?php if($catid!=20) { ?><a class="f30" href="<?php echo makecaturl($r[url], $city, getinfocache('multi_city'));?>"><?php } ?><?php echo $r['catname'];?><?php if($catid!=20) { ?></a><?php } ?></li>
                <?php } ?>
                <?php if($r[catid]==21) { ?>
                    <li><?php if($catid!=21) { ?><a class="f30" href="<?php echo makecaturl($r[url], $city, getinfocache('multi_city'));?>"><?php } ?><?php echo $r['catname'];?><?php if($catid!=21) { ?></a><?php } ?></li>
                <?php } ?>
                <?php if($r[catid]==23) { ?>
                    <li><?php if($catid!=23) { ?><a class="f30" href="<?php echo makecaturl($r[url], $city, getinfocache('multi_city'));?>"><?php } ?><?php echo $r['catname'];?><?php if($catid!=23) { ?></a><?php } ?></li>
                <?php } ?>
            <?php $n++;}unset($n); ?>
                </ul>
            </div>
            <div class="gongqiu_city_list_1"><h4>供求：</h4>
                <ul>
            <?php $n=1;if(is_array(filters('rent_mode',$modelid))) foreach(filters('rent_mode',$modelid) AS $r) { ?>
                <li><?php echo $r['menu'];?></li>
            <?php $n++;}unset($n); ?>
                </ul>
            </div>
        <?php $zone = intval($_GET['zone'])?>
            <?php $zones = show_linkage($info_linkageid,$cityid,$cityid,$modelid)?>
          <div class="gongqiu_city_list_1"><h4>所在地：</h4>
              <ul>
            <?php $n=1;if(is_array($zones)) foreach($zones AS $area) { ?>
                <?php if($zone == $area['linkageid'] || get_linkage_level($info_linkageid,$zone)== $area['linkageid']) { ?>
                <li><em><?php echo $area['name'];?></em></li>
                <?php } else { ?>
                <li><a href="<?php echo $area['url'];?>"><?php echo $area['name'];?></a> </li>
                <?php } ?>
            <?php $n++;}unset($n); ?>
              </ul>
          </div>
      </div>
    <?php $sql = structure_filters_sql($modelid,$cityid)?>
    <?php $cachetime = getinfocache('info_cachetime')?>
    
        <div class="gongqiu_list_l">
            <h2>最新更新需求信息 <a href="<?php echo APP_PATH;?>index.php?m=member&c=content&a=info_publish&siteid=1&city=">发布需求</a></h2>
            <ul>
            <?php $top_posid = ($zone==0) ? getinfocache('top_city_posid') : (get_linkage_level($info_linkageid,$zone,'child') ? getinfocache('top_zone_posid') : getinfocache('top_district_posid'))?>
            <?php $where = ($zone==0) ? '`extention` LIKE \''.$cityid.'_%\'' : (get_linkage_level($info_linkageid,$zone,'child') ? '`extention` LIKE \''.$cityid.'_'.$zone.'%\'' : '`extention` = \''.$cityid.'_'.get_linkage_level($info_linkageid,$zone,'parentid').'_'.$zone.'\'')?>
            <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=23d7ad2fd53b61fd50398683f85f5c77&action=position&posid=%24top_posid&where=%24where&order=listorder+DESC&num=10&expiration=1&cache=%24cachetime\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>$top_posid,'where'=>$where,'order'=>'listorder DESC','expiration'=>'1','limit'=>'10',));}?>
                <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
                <li><a href="<?php echo $r['url'];?>">
                    <p class="gongqiu_name"><span class="gongqiu_tt"><?php echo $r['title'];?></span> <span class="gongqiu_gongsi">发布人：<?php echo $r['contact'];?></span></p>
                    <p class="gongqiu_city"><span class="gongqiu_diqu">
                    (<?php if($r[zone]) { ?><?php echo get_linkage($r[zone], $info_linkageid, '', 0);?><?php } ?><?php if($r[xiaoqu_address]) { ?><?php echo $r['xiaoqu_address'];?><?php } ?>)
                    </span> <span class="gongqiu_other">发布时间：<?php echo timeinterval($r[inputtime]);?></span> </p>
                </a></li>
                <?php $n++;}unset($n); ?>
            <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
            <?php $urlrule = makeurlrule()?>
            <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=462844ce8720fd4ef02894bba29dcf79&action=lists&catid=%24catid&where=%24sql&num=10&order=listorder+DESC%2Cinputtime+DESC&page=%24page&moreinfo=1&cache=%24cachetime&urlrule=%24urlrule\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$pagesize = 10;$page = intval($page) ? intval($page) : 1;if($page<=0){$page=1;}$offset = ($page - 1) * $pagesize;$content_total = $content_tag->count(array('catid'=>$catid,'where'=>$sql,'order'=>'listorder DESC,inputtime DESC','moreinfo'=>'1','limit'=>$offset.",".$pagesize,'action'=>'lists',));$pages = pages($content_total, $page, $pagesize, $urlrule);$data = $content_tag->lists(array('catid'=>$catid,'where'=>$sql,'order'=>'listorder DESC,inputtime DESC','moreinfo'=>'1','limit'=>$offset.",".$pagesize,'action'=>'lists',));}?>
            <div style="display:none" id="content_total"><?php echo $content_total;?></div> 
            <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
            <?php $photos_num = count(string2array($r[photos]))?>
                    <?php if($r[catid] == $catid) { ?>
                <li><a href="<?php echo $r['url'];?>">
                    <p class="gongqiu_name"><span class="gongqiu_tt"><?php echo $r['title'];?></span> <span class="gongqiu_gongsi">发布人：<?php echo $r['contact'];?></span></p>
                    <p class="gongqiu_city"><span class="gongqiu_diqu">
                    (<?php if($r[zone]) { ?><?php echo get_linkage($r[zone], $info_linkageid, '', 0);?><?php } ?><?php if($r[xiaoqu_address]) { ?><?php echo $r['xiaoqu_address'];?><?php } ?>)
                    </span> <span class="gongqiu_other">发布时间：<?php echo timeinterval($r[inputtime]);?></span> </p>                
                </a></li>
                        <?php } else { ?>
                <?php } ?>

                
            <?php $n++;}unset($n); ?>
            <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
            </ul>
            <div id="page"><?php echo $pages;?></div>                           
        </div>
        <div class="gongqiu_list_r">
            <dl class="dl index_zhanhui">
                <dt><a href="#" class="dt_tt">飞行器租赁/托管</a></dt>
                <dd><ul>
            <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=d4995f8869d6347a852961703b82fd45&action=lists&catid=12&where=%24sql&num=5&order=listorder+DESC%2Cinputtime+DESC&moreinfo=1&cache=%24cachetime&urlrule=%24urlrule\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'12','where'=>$sql,'order'=>'listorder DESC,inputtime DESC','moreinfo'=>'1','limit'=>'5',));}?>
            <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
            <?php $photos_num = count(string2array($r[photos]))?>
                    <li> <a href="<?php echo $r['url'];?>"><?php echo str_cut($r['title'], 40);?></a></li>
            <?php $n++;}unset($n); ?>
            <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
            <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=f5b397f7660e1fac63bb8a365f950302&action=lists&catid=13&where=%24sql&num=5&order=listorder+DESC%2Cinputtime+DESC&moreinfo=1&cache=%24cachetime&urlrule=%24urlrule\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'13','where'=>$sql,'order'=>'listorder DESC,inputtime DESC','moreinfo'=>'1','limit'=>'5',));}?>
            <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
            <?php $photos_num = count(string2array($r[photos]))?>
                    <li> <a href="<?php echo $r['url'];?>"><?php echo str_cut($r['title'], 40);?></a></li>
            <?php $n++;}unset($n); ?>
            <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
                </ul></dd>
            </dl>
            <dl class="dl index_zhanhui">
                <dt><a href="#" class="dt_tt">执照</a></dt>
                <dd><ul>
            <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=d21d9752f063a6fce22d1e3bd5a9a744&action=lists&catid=16&where=%24sql&num=10&order=listorder+DESC%2Cinputtime+DESC&moreinfo=1&cache=%24cachetime&urlrule=%24urlrule\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'16','where'=>$sql,'order'=>'listorder DESC,inputtime DESC','moreinfo'=>'1','limit'=>'10',));}?>
            <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
            <?php $photos_num = count(string2array($r[photos]))?>
                    <li> <a href="<?php echo $r['url'];?>"><?php echo str_cut($r['title'], 40);?></a></li>
            <?php $n++;}unset($n); ?>
            <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
                </ul></dd>
            </dl>
            <dl class="dl index_zhanhui">
                <dt><a href="#" class="dt_tt">其他</a></dt>
                <dd><ul>
            <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=ea464e735338636b8f5f70093f51d8f9&action=lists&catid=23&where=%24sql&num=10&order=listorder+DESC%2Cinputtime+DESC&moreinfo=1&cache=%24cachetime&urlrule=%24urlrule\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'23','where'=>$sql,'order'=>'listorder DESC,inputtime DESC','moreinfo'=>'1','limit'=>'10',));}?>
            <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
            <?php $photos_num = count(string2array($r[photos]))?>
                    <li> <a href="<?php echo $r['url'];?>"><?php echo str_cut($r['title'], 40);?></a></li>
            <?php $n++;}unset($n); ?>
            <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
                </ul></dd>
            </dl>
        </div>
        <div class="gongqiu_bt">
            <dl class="dl">
                <dt><a href="#" class="dt_tt">飞行包机/托管</a></dt>
                <dd><ul>
            <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=f9e91e772b8afe0ab9eed5173e52efc8&action=lists&catid=10&where=%24sql&num=4&order=listorder+DESC%2Cinputtime+DESC&moreinfo=1&cache=%24cachetime&urlrule=%24urlrule\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'10','where'=>$sql,'order'=>'listorder DESC,inputtime DESC','moreinfo'=>'1','limit'=>'4',));}?>
            <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
            <?php if($n<4) { ?>
            <?php $photos_num = count(string2array($r[photos]))?>
                        <li><a href="<?php echo $r['url'];?>">
                            <p class="gongqiu_tt"><?php echo str_cut($r['title'], 40);?></p>
                            <p class="gongqiu_city"><p class="gongqiu_ren"><p class="gongqiu_ren"><?php echo $r['contact'];?></p></a>
                        </li>
            <?php $n++;}unset($n); ?>
            <?php } ?>
            <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
                </ul></dd>
            </dl>
        </div>
        
  </div>
</div>
<?php include template('yp', 'footer'); ?>