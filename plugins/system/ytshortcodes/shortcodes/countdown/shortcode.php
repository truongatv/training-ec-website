<?php 
/*
* @package   YouTech Shortcodes
* @author    YouTech Company http://smartaddons.com/
* @copyright Copyright (C) 2015 YouTech Company
* @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
*/
defined('_JEXEC') or die;
function countdownYTShortcode($atts = null, $content = null) {
        $atts = ytshortcode_atts(array(
			'count_date'    => '2020/12/25',
			'count_time'    => '',
			'count_size'    => '32',
			'count_color'   => '',
			'background'    => '#FFFFFF',
			'text_align'    => 'default',
			'text_size'     => '14',
			'text_color'    => '#666666',
			'align'         => 'left',
			'padding'       => '',
			'margin'        => '',
			'border'        => '0px solid #DDD',
			'radius'        => '',
			'divider'       => 'none',
			'divider_color' => 'rgba(100,100,100,.1)',
			'class'         => ''
        ), $atts, 'countdown');

        $id = uniqid('yt_countdown_').rand().time();
        $css = '';
        $js = '';

        $divider_style = '';
        if ($atts['divider'] == 'colon') {
            $divider_style = '#'.$id.' .yt-countdown-content .yt-cd-timer > span:after { font-size: '.round($atts['count_size']/2).'px;line-height: '.round($atts['count_size']/2).'px; color: '.$atts['divider_color'].';}';
        }
        if ($atts['divider'] == 'vertical_line' || $atts['divider'] == 'horizontal_line') {
            $divider_style = '#'.$id.' .yt-countdown-content .yt-cd-timer > span:after {background-color: '.$atts['divider_color'].';}';
        }
        else {
            $divider_style = '#'.$id.' .yt-countdown-content .yt-cd-timer > span:after { font-size: '.$atts['count_size'].'px;line-height: '.$atts['count_size'].'px; color: '.$atts['divider_color'].';}'; 
        }

        if ($atts['margin'] or $atts['padding'] or $atts['radius'] or $atts['border'] or $atts['background']) {
            $margin = ($atts['margin']) ? 'margin: '.$atts['margin'].';' : '';
            $padding = ($atts['padding']) ? 'padding: '.$atts['padding'].';' : '';
            $radius = ($atts['radius']) ? 'border-radius: '.$atts['radius'].';' : '';
            $border = ($atts['border']) ? 'border: '.$atts['border'].';' : '';
            $background = ($atts['background']) ? 'background-color: '.$atts['background'].';' : '';
            $css .= '#'.$id.' {'.$margin.$padding.$radius.$border.$background.'}';
        }
        $count_color = ($atts['count_color']) ? 'color: '.$atts['count_color'].';' : '';

        $css .= '#'.$id.'  .yt-cd-timer > span span[class*="text"] { color: '.$atts['text_color'].'; font-size: '.$atts['text_size'].'px; }
			      #'.$id.'  .yt-cd-timer span > span { font-size: '.$atts['count_size'].'px; line-height: '.$atts['count_size'].'px; '. $count_color .'}
			     '.$divider_style.'
        ';

        $message ='';
        $countdown  = $atts['count_date'];
        $countdown .=  ($atts['count_time']) ? ' '. $atts['count_time'] : '';

        if (isset($content)) {
            $message = '.on("finish.countdown", function(event) {
                $(this).parent()
                   .addClass("disabled")
                   .html("'.parse_shortcode(str_replace(array("<br/>", "<br>", "<br />"), " ", $content)).'");
            })';
        }

        $js .= '
            jQuery(document).ready(function ($) {
               $("#'.$id.' .yt-cd-timer").countdown("'.$countdown.'").on("update.countdown", function(event) {
                   var $this = $(this).html(event.strftime(
                       "<span class=\'yt-cd-day\'><span class=\'yt-cd-day-data\'>%-D</span> <span class=\'yt-cd-day-text\'>DAY</span></span> "
                     + "<span class=\'yt-cd-hour\'><span class=\'yt-cd-hour-data\'>%H</span> <span class=\'yt-cd-hour-text\'>HOUR</span></span> "
                     + "<span class=\'yt-cd-minute\'><span class=\'yt-cd-minute-data\'>%M</span> <span class=\'yt-cd-minute-text\'>MIN</span></span> "
                     + "<span class=\'yt-cd-second\'><span class=\'yt-cd-second-data\'>%S</span> <span class=\'yt-cd-second-text\'>SEC</span></span>"));
                })'.$message.';
            });
        ';
        JHtml::stylesheet(JUri::base()."plugins/system/ytshortcodes/shortcodes/countdown/css/countdown.css");
		JHtml::_('jquery.framework');
		JHtml::script(JUri::base()."plugins/system/ytshortcodes/shortcodes/countdown/js/jquery.countdown.js");
		$doc = JFactory::getDocument();
		$doc->addStyleDeclaration($css);
		$doc->addScriptDeclaration($js);
        return '<div id="'.$id.'" class="yt-countdown-wrapper clearfix yt-countdown-'.$atts['align'].' yt-cd-divider-'. $atts['divider'].' yt-countdown-text-'.$atts['text_align'].'">
            <div class="yt-countdown-content">
                <div class="yt-cd-timer"></div>
            </div>
        </div>';
    }
?>