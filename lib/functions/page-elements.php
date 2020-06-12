<?php

// return an array with the Section Background ACF field group data
function section_background() {
	
	$bg = array();
	
	$bg_style = get_sub_field( 'background_style' );
	
	if( $bg_style == 'image' ):
		$bg_image = get_sub_field( 'background_image' );
		$bg['style'] = 'background-image:url('.esc_url($bg_image['url']).');';
		$bg['class'] = 'bg-img';
		return $bg;
	elseif( $bg_style == 'color' ):
		$bg_color = get_sub_field( 'background_color' );
		$bg['style'] = 'background-color:'.$bg_color.';';
		$bg['class'] = 'bgcolor';
		return $bg;
	elseif( $bg_style == 'gradient' ):
		$bg_gradient_color = get_sub_field( 'background_gradient_color' );
		$bg['style'] = '';
		$bg['class'] = 'bgcolor gradient '.$bg_gradient_color;
		return $bg;
	else:
		$bg['image'] = '';
		$bg['style'] = '';
		$bg['class'] = '';
		return $bg;
	endif;
}

// Simple Link
// return the simple link acf fields in an array
function get_simple_link_fields() {
	
	$link = array();
	
	$link_type = get_sub_field( 'link_type' );
	$link_target = get_sub_field( 'link_target' );
	$link_url = get_sub_field( 'link_'.$link_type.'' );
	if( $link_type == 'internal' ):
		$link_url = get_permalink( $link_url->ID );
	endif;
	
	$link['link'] = esc_url($link_url);
	$link['target'] = esc_attr($link_target);
	
	return $link;
}

// ACF oEmbed
function acf_video_embed( $video ) {
	// use preg_match to find iframe src
	preg_match('/src="(.+?)"/', $video, $matches);
	$src = $matches[1];
	// Add extra parameters to src and replcae HTML.
	$params = array(
	    'controls'  => 0,
	    'hd'        => 1,
	    'autohide'  => 1
	);
	$new_src = add_query_arg($params, $src);				
	$video = str_replace($src, $new_src, $video);
	// add extra attributes to iframe html
	$attributes = 'frameborder="0"';
	$video = str_replace('></iframe>', ' ' . $attributes . '></iframe>', $video);
	// Display customized HTML.
	if($video) :
    echo '<div class="video-wrapper">'.$video.'</div>';
	endif;
}

// adds a custom ID. works with the custom ID acf field group.
function custom_section_id() {
	if( get_sub_field( 'add_custom_id' ) == true ):
		echo 'id="'.get_sub_field( 'custom_id' ).'"';
	endif;
}