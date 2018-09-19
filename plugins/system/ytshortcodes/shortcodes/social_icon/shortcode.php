<?php 
/*
* @package   YouTech Shortcodes
* @author    YouTech Company http://smartaddons.com/
* @copyright Copyright (C) 2015 YouTech Company
* @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
*/
defined('_JEXEC') or die;
function social_iconYTShortcode($atts, $content = null){
	extract(ytshortcode_atts(array(
		"type" 	=> 'facebook',
		"yt_title"	=> '',
		"size"	=> 'default',
		"style"	=> '',
		"color"	=> '',
		"link"	=> 'http://smartaddons.com'
	), $atts));

	$social_color=(($color == "Yes" || $color == "yes")? 'color' : "");
	$social = '<div class="yt-socialbt"><a data-placement="top" target="_blank" class="sb '.$type." ". $size."  ".$style." ".$social_color.'" title="' . $yt_title . '" href="' . trim($link) . '">';
	
	$social .= '<i class="fa fa-'.$type.'"></i></a></div>';
	
	JHtml::stylesheet(JUri::base()."plugins/system/ytshortcodes/shortcodes/social_icon/css/social_icon.css");
	return $social;
}
?>