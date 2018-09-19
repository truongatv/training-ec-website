<?php 
/*
* @package   YouTech Shortcodes
* @author    YouTech Company http://smartaddons.com/
* @copyright Copyright (C) 2015 YouTech Company
* @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
*/
defined('_JEXEC') or die;
function toggle_box_itemYTShortcode($atts, $content = null){
	extract(ytshortcode_atts(array(
		"yt_title"  => '',
		"icon"  => '',
		"active"  => '',
		"background"  => '#f1f1f1',
		"color"  => '#000'
	), $atts));
	$css = '';
	$id = uniqid('toggle_box_item_').rand().time();  
	$toggle_active=((strtoupper($active) == 'YES') ? 'active' : '');
	$icon_active='';
	if($icon !=''){
		if (strpos($icon, 'icon:') !== false) 	{
			$icon_active .= "<i class='fa fa-" . trim(str_replace('icon:', '', $icon)) . "'></i> ";	
		}else		{
			$icon_active .= '<img src="'.yt_image_media($icon).'" style="width:16px" alt="" /> ';
		}
	}
	$css .= '#'.$id.' .toggle-box-head{'.(($background !='') ? 'background:'.$background.'' :'' ).";".(($color !='') ? 'color:'.$color.'' : '').'}';
	
	$css .= '#'.$id.' .toggle-box-span{color:'.$color.'; '.(($background =='') ? 'background:rgba(255,255,255,0.5)' : 'background:none').'}';
	
	$css .= '#'.$id.' .toggle-box-content{border-color:'.$background.'}';
	
	$doc = JFactory::getDocument();
	$doc->addStyleDeclaration($css);
	$toggle_item = "<li class='yt-divider' id='".$id."'>";
	$toggle_item = $toggle_item . "<h3 class='toggle-box-head ".$toggle_active."'>";
	$toggle_item = $toggle_item . $icon_active;
	$toggle_item = $toggle_item . "<span class='toggle-box-span'></span>";
	$toggle_item = $toggle_item . $yt_title . "</h3>";
	$toggle_item = $toggle_item . "<div class='toggle-box-content ".$toggle_active."'>" . parse_shortcode(str_replace(array("<br/>", "<br>", "<br />"), " ", $content)) . "</div>";
	$toggle_item = $toggle_item . "</li>";

	return $toggle_item;
}
?>