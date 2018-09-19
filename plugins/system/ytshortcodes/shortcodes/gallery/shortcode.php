<?php 
/*
* @package   YouTech Shortcodes
* @author    YouTech Company http://smartaddons.com/
* @copyright Copyright (C) 2015 YouTech Company
* @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
*/
defined('_JEXEC') or die;

function galleryYTShortcode($atts, $content = null){
	global $gwidth, $gheight, $gcolumns, $galleryArray,$cation_gallery,$border_gallery, $padding_item,$id_uniq,$hover_gallery;
	$gwidth  = 100;
	$gheight = 100;
	
	JHtml::_('jquery.framework');
	JHtml::_('jquery.framework');
	JHtml::script(JUri::base()."plugins/system/ytshortcodes/assets/js/jquery.prettyPhoto.js");
	JHtml::stylesheet(JUri::base()."plugins/system/ytshortcodes/shortcodes/gallery/css/gallery.css");
	extract(ytshortcode_atts(array(
		"width"        		=> 100,
		"height"       		=> 100,
		"columns_0"    		=> 4,
		"columns_1"      	=> 4,
		"columns_2"      	=> 3,
		"columns_3"      	=> 2,
		"columns_4"      	=> 1,
		"align"        		=> 'center',
		"caption"      		=> '0',
		"border"       		=> '0px solid #4e9e41',
		"border_size"  		=> '0px',
		"border_color" 		=> '#4e9e41',
		"border_style" 		=> 'solid',
		"padding"      		=> '0px',
		"hover"        		=> '1'
	), $atts));
	$border_gallery = "border: ".$border."";
	switch ($caption) {
		case '1':
			$cation_gallery =  'caption_gallery_1';
			break;
		case '2':
			$cation_gallery =  'caption_gallery_2';
			break;
		default:
			$cation_gallery =  '';
			break;
	}
	$hover_gallery =$hover;
	$padding_item   = ($padding =='0px') ? '' : "padding:".$padding.";";
	$id = uniqid("gallery_").rand().time();
	$id_uniq = uniqid("yt").rand().time();
	$gwidth  = $width;
	$gheight = $height;

	$gallery = '';
	$galleryArray = array();
	parse_shortcode($content);
	$tags = array();
	$tags = '';
	$css ='';
	$css .='#'.$id.' .item-gallery{'.$padding_item.' '.$border_gallery.'}';
	$doc = JFactory::getDocument();
	$doc->addStyleDeclaration($css);
	foreach ($galleryArray as $key=>$item) $tags .= ',' . strtolower($item['tag']);
		$tags = ltrim($tags, ',');

		$tags = explode(',', $tags);
		$newtags = array();
		foreach($tags as $tag) $newtags[] = trim($tag);
		$tags = array_values(array_unique($newtags));
		if($align !='')
		$align = 'pull-'.$align;
		else
		$align ='';
		$gallery .= '<div class="yt-gallery clearfix '.$align.'" id="'.$id.'">';
			$gallery.='<div class = "yt-gallery-tabbed">';
			$gallery.='<ul class="tabnav">';
				$gallery.='<li class="showall active '.$id_uniq.'"><span >Show all</span></li>';
				foreach($tags as $tag )	{
					$gallery.='<li id='.trim($tag).$id_uniq.' class="'.$id_uniq.'"><span>'.ucfirst(trim($tag)).'</span></li>';
				}
			$gallery.='</ul>';
			$gallery.='</div>';
			$gallery .= '<ul class="gallery-list clearfix">' . parse_shortcode(str_replace(array("<br/>", "<br>", "<br />","<p>", "</p>"), " ", $content)) . '</ul>';
			$gallery .= '</div>';
			$gallery .= '<script>
				jQuery(".'.$id_uniq.'.masonry-brick").css("width","'.floor(100/$columns_0).'%");
				  window.onresize = function(event) {
					var width = jQuery(window).width();
					if(width >= 1200)
					{
						jQuery(".'.$id_uniq.'.masonry-brick").css("width","'.floor(100/$columns_0).'%");
					}else if(width >= 992 && width < 1200)
					{
						jQuery(".'.$id_uniq.'.masonry-brick").css("width","'.floor(100/$columns_1).'%");
					}else if(width >= 768 && width < 992)
					{
						jQuery(".'.$id_uniq.'.masonry-brick").css("width","'.floor(100/$columns_2).'%");
					}else if(width >= 480 && width < 768)
					{
						jQuery(".'.$id_uniq.'.masonry-brick").css("width","'.floor(100/$columns_3).'%");
					}else
					{
						jQuery(".'.$id_uniq.'.masonry-brick").css("width","'.floor(100/$columns_4).'%");
					}

			};</script>';
	return $gallery;
}
?>