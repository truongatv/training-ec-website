<?php 
/*
* @package   YouTech Shortcodes
* @author    YouTech Company http://smartaddons.com/
* @copyright Copyright (C) 2015 YouTech Company
* @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
*/
defined('_JEXEC') or die;
function buttonsYTShortcode($atts, $content = null){
	extract(ytshortcode_atts(array(
		"type"         => '',
		"size"         => 'sm',
		"full"         => 'no',
		"icon"         => 'home',
		"link"         => '#',
		"radius"       => '3px',
		"target"       => '',
		"title"        => '',
		"position"     => '',
		"subtitle"     => '',
		"style"        => '',
		"iconposition" =>'',
		"background"   =>'#4e9e41',
		"color"        =>'#fff',
		"icon_position"    =>'',
		"center"       => 'no',
		"animated_icon" => 'no',
		"box_shadow_color" => '#337e27',
		"linear_color" => '#4e9e41',
		"gradient_color" => '#93c38c'
	), $atts));
	$css ='';
	$id = uniqid('btn_').rand().time(); 
	$yt_btn_icon ='';
	$dropshadow ='';
	$stylecss ='';
	$id = uniqid('ul_').rand().time(); 
	if($type =="line"){
		$dropshadow = 'box-shadow:0px 6px 0px '.$background.';';
	}
	if($style == "bottom_line")	{
		$stylecss .= "box-shadow:0px 6px 0px ".$box_shadow_color;
	}else if($style == "3d"){
		$stylecss .= "background:linear-gradient(19deg,".$background." 50%,".$linear_color." 50%)";
	}
	$animated_icon = ($animated_icon == 'yes') ? 'fa-spin' : '';
	if($icon != '')	{
		if (strpos($icon, 'icon:') !== false) 	{
			$yt_btn_icon = "<i class='fa ".$animated_icon." fa-" . trim(str_replace('icon:', '', $icon)) . "'></i> ";
		}else{
			$yt_btn_icon = '<img src="'.yt_image_media($icon).'" style="width:18px" alt="" /> ';
		}
	}
	
	$center = ($center =="yes") ? 'text-align:center' : '';
	switch ($style) {
		case 'border':
			$color=($color =='#fff') ? 'color:'.$background : 'color:'.$color;
			$background = 'border-color:'.$background;
			break;
		case 'dot':
			$color=($color =='#fff') ? 'color:'.$background : 'color:'.$color;
			$background = 'border-color:'.$background;
			break;
		case 'transparent':
			$background ="background:transparent;border-style:solid; border-color:".$background."; border-width:1px";
			$color= 'color:'.$color;
			break;
		case 'gradient':
			$background = "background: -webkit-linear-gradient(".$gradient_color.", ".$background."); /* For Safari 5.1 to 6.0 */
    background: -o-linear-gradient(".$gradient_color.", ".$background."); /* For Opera 11.1 to 12.0 */
    background: -moz-linear-gradient(".$gradient_color.", ".$background."); /* For Firefox 3.6 to 15 */
    background: linear-gradient(".$gradient_color.", ".$background."); /* Standard syntax (must be last) */";
			$color= 'color:'.$color;
    		break;
		default:
			$background = 'background:'.$background;
			$color = (($color != '') ? 'color:'.$color : '');
			break;
	}
	
	if($subtitle != "")	{
		$subtitle = '<small class="text-small">'.$subtitle.'</small>';
		$css .=".".$id." .text-small{display: block;margin: 5px 0px 0px;color: inherit;text-align: center;font-style: normal;font-size: 0.8em;line-height: 1;opacity: 0.7;}";
	}else{
		$subtitle ='';
	}
	if($icon_position == "left")
	{
		$css .=".".$id."{border-radius:".$radius."; ".$background.";".$dropshadow."; ".$color."; ".$center." ; ".$stylecss."}";
		$doc = JFactory::getDocument();
		$doc->addStyleDeclaration($css);
		return '<a class="yt-clearfix buttons-style-'.$style.' ytyt_btn '.$id.''.
			(($type != '') ? ' yt_btn-' . $type : '').
			(($size != '') ? ' yt_btn-' . $size : '') .
			(($full == 'yes') ? ' yt_btn-block' : '') .
			' " href="'.$link.'" target="'.$target.'" data-placement="'.$position.'" title="'.$title.'">'.'<span class="span-buttons"><span>'.$yt_btn_icon. parse_shortcode(str_replace(array("<br/>", "<br>", "<br />", "<p>", "</p>"), " ",$content)).'</span> '.$subtitle .'</span></a>';
	}else{
		$css .=".".$id."{border-radius:".$radius."; ".$background.";".$dropshadow."; ".$color."; ".$center." ; ".$stylecss."}";
		$doc = JFactory::getDocument();
		$doc->addStyleDeclaration($css);
		return '<a class="yt-clearfix buttons-style-'.$style.' ytyt_btn '.$id.''.
			(($type != '') ? ' yt_btn-' . $type : '').
			(($size != '') ? ' yt_btn-' . $size : '') .
			(($full == 'yes') ? ' yt_btn-block' : '') .
			' " href="'.$link.'" target="'.$target.'" data-placement="'.$position.'" title="'.$title.'">'.'<span class="span-buttons"><span>'. parse_shortcode(str_replace(array("<br/>", "<br>", "<br />", "<p>", "</p>"), " ",$content)) .$yt_btn_icon. '</span> '.$subtitle .'</span></a>';
	}
	
}

?>