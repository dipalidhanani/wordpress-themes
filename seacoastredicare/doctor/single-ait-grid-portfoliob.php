<?php
/**
 * AIT WordPress Theme
 *
 * Copyright (c) 2012, Affinity Information Technology, s.r.o. (http://ait-themes.com)
 */

$latteParams['post'] = WpLatte::createPostEntity($post, array('meta' => $GLOBALS['pageOptions']));
$latteParams['post']->classes = implode(' ', get_post_class());

global $wpdb;
$sql = "SELECT meta_value FROM ".$wpdb->prefix."postmeta WHERE post_id=".$latteParams['post']->id." AND meta_key LIKE '%_ait%'";
$itemMeta = $wpdb->get_results($sql);
$itemMetaValue = unserialize($itemMeta[0]->meta_value);
if($itemMetaValue['itemType'] == NULL){$itemMetaValue['itemType']='image';}
$itemMetaValue['videoAutoplay'] = 0;
/* Parse video provider && video id*/
if(strpos($itemMetaValue['videoLink'],'vimeo') != false){
  $itemMetaValue['videoProvider'] = 'vimeo';
  $itemMetaValue['videoID'] = str_replace('http://vimeo.com/','',$itemMetaValue['videoLink']);
} else {
  $itemMetaValue['videoProvider'] = 'youtube';
  $temp = str_replace('http://www.youtube.com/watch?v=','',$itemMetaValue['videoLink']);
  $itemMetaValue['videoID'] = substr($temp,0,strpos($temp,'&'));
}
/* Parse video provider */
$latteParams['gridGalleryOptions'] = $itemMetaValue;

ob_start();
comments_template('');
ob_get_clean();

WPLatte::createTemplate(basename(__FILE__, '.php'), $latteParams)->render();