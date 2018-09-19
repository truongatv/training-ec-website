<?php 
/*
* @package   YouTech Shortcodes
* @author    YouTech Company http://smartaddons.com/
* @copyright Copyright (C) 2015 YouTech Company
* @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
*/
defined('_JEXEC') or die;
function pricing_tables_itemYTShortcode($atts, $content = null ){
	global $pcolumns, $per,$type;
	extract(ytshortcode_atts(array(
		"yt_title" 		=> '',
		"button_link" 	=> '',
		"button_label" 	=> '',
		"price" 		=> '',
		"featured" 		=> '',
		"yt_text"			=>'Popular',
		"background"	=>'#4e9e41',
		"color"			=>'#fff',
		"icon_name"		=>''
	), $atts));
	$return='';
	$css ='';
	$id = uniqid('pricing_tables_item_').rand().time(); 
	if($icon_name != ''){
		if (strpos($icon_name, 'icon:') !== false) 	{ 
		  $icon_name = '<i class="fa fa-' . trim(str_replace('icon:', '', $icon_name)) . '"></i>';
		} else { 
          $icon_name = '<img src="' . yt_image_media($icon_name) . '" width="16" height="16" alt="" />'; 
       	}
	}
	switch ($type) {
		case 'style1':
			$text= (strtolower($featured)=="yes" ? $yt_text : '');
			$return = '<div class="yt-col-xs-12 yt-col-sm-6 yt-col-md-'.round(12/$pcolumns).' yt-col-lg-'.round(12/$pcolumns).'">
				<div class="'.$type.' column '.(('yes' == strtolower($featured)) ? ' featured' : '') .'">
				<span class="pricing-featured">'.$text.'</span>
				<div class="pricing-basic "><h2>' . $yt_title . '</h2></div>' .
				'<div class="pricing-money block "><h5>' . $price . '</h5></div>' .
				parse_shortcode(str_replace(array("<br/>", "<br>", "<br />"), " ", $content)) .
				'<div class="pricing-bottom">
		<div class="signup"><a href="'.$button_link.'">'.$button_label.'<div class="iconsignup">'.$icon_name.'</div></a></div>

	</div> ' .
			 '</div></div>';
			break;
		default:
		case 'style2':
			$return = '<div class="yt-col-xs-12 yt-col-sm-6 yt-col-md-'.round(12/$pcolumns).' yt-col-lg-'.round(12/$pcolumns).'" id="'.$id.'">
				<div class="'.$type.' column '.(('true' == strtolower($featured)) ? ' featured' : '') .'">
				<div class="pricing-basic "><h2>' . $yt_title . '</h2><span class="pricing-featured">'.$yt_text.'</span></div>' .
				parse_shortcode(str_replace(array("<br/>", "<br>", "<br />"), " ", $content)) .
				'<div class="pricing-money block ">' . $price . '</div>' .
				'<div class="pricing-bottom" >
				<a class="signup" href="'.$button_link.'">'.$button_label.'</a>
					</div> ' .'</div></div>';
			$css .= '#'.$id.' .pricing-basic{background:'.$background.'; color:'.$color.'}';
			$css .= '#'.$id.' .signup{background:'.$background.';color:'.$color.'}';
			break;
		case 'style3':
			$text= (strtolower($featured)=="true" ? $yt_text : '');
			$return = '<div class="yt-col-xs-12 yt-col-sm-6 yt-col-md-'.round(12/$pcolumns).' yt-col-lg-'.round(12/$pcolumns).'" id="'.$id.'">
				<div class="'.$type.' column '.(('true' == strtolower($featured)) ? ' featured' : '') .'">
				<div class="pricing-basic"><h2>' . $yt_title . '</h2><span class="pricing-featured">'.$text.'</span></div>' .
				'<div class="pricing-money block "><h1>' . $price . '</h1></div>'.
				parse_shortcode(str_replace(array("<br/>", "<br>", "<br />"), " ", $content))  .
				'<div class="pricing-bottom" >
			<a class="signup" href="'.$button_link.'">'.$button_label.'</a>
			</div> ' .
			 '</div></div>';
			$css .= '#'.$id.' .pricing-basic{background:#e74847; color:'.$color.'}';
			$css .= '#'.$id.' .signup{background:#e74847;color:'.$color.'}';
			break;
	}
	$doc = JFactory::getDocument();
	$doc->addStyleDeclaration($css);
	return $return;
}
?>