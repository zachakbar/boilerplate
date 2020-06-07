<?php

/* ==========================================
	Theme Options page
========================================== */
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page(array(
		'page_title' 	=> 'Theme Options',
		'menu_title'	=> 'Theme Options',
		'menu_slug' 	=> 'theme-options',
		'capability'	=> 'edit_posts',
		'redirect'		=> false, 
		'parent_slug'	=> ''
	));
}


/* ==========================================
	Convert Hex to RGB
========================================== */
function hex2rgb( $color ) {
    if ( $color[0] == '#' ) {
        $color = substr( $color, 1 );
    }
    if ( strlen( $color ) == 6 ) {
        list( $r, $g, $b ) = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
    } elseif ( strlen( $color ) == 3 ) {
        list( $r, $g, $b ) = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
    } else {
        return false;
    }
    $r = hexdec( $r );
    $g = hexdec( $g );
    $b = hexdec( $b );
    return array( 'r' => $r, 'g' => $g, 'b' => $b );
}


/* ==========================================
	Add custom scripts to header/body/footer
========================================== */
// header
function custom_header_scripts() {
	echo get_field( 'header_scripts', 'option' );
}
add_action( 'wp_head', 'custom_header_scripts' );
// body
function custom_body_scripts() {
	echo get_field( 'body_scripts', 'option' );
}
add_action( 'wp_body_open', 'custom_body_scripts' );
// footer
function custom_footer_scripts() {
	echo get_field( 'footer_scripts', 'option' );
}
add_action( 'wp_footer', 'custom_footer_scripts' );


/* ==========================================
	Dynamic Button functions
========================================== */
// get info from ACF fields to return to output function
function get_button_fields( $btn_field ) {

	$cta_button = get_field( $btn_field );
	$btn = array();

	$btn_color = isset($cta_button['button_color']) ? $cta_button['button_color'] : "";
	$btn_style = $cta_button['button_style'] == "outline" ? "-outline" : "";
	$btn_size = isset($cta_button['button_size']) ? $cta_button['button_size'] : "";
	$btn['class'] = $cta_button['button_style'] == "text" ? "text-link" : "btn btn-".$btn_color.$btn_style." ".$btn_size;
	$btn['class'] .= " custom-tracking";
	$btn['modal'] = "";

	$btn_text = $cta_button['button_text'];

	$btn['ga_tracking'] = "";
	if($cta_button['add_ga_tracking'] == 1):
		$btn['ga_tracking'] = "data-category='".$cta_button['ga_tracking'][0]['event_category']."' data-action='".$cta_button['ga_tracking'][0]['event_action']."' data-label='".$cta_button['ga_tracking'][0]['event_label']."'";
	endif;

	$btn_link_type = $cta_button['button_link_type'];
	$btn_link = $cta_button["button_link_$btn_link_type"];
	$btn_target = $cta_button['button_link_target'];

	if($btn_link_type == "internal"):
		if(is_array($btn_link)):
			$btn_href = get_permalink( $btn_link['ID'] );
		else:
			$btn_href = get_permalink( $btn_link->ID );
		endif;
	else:
		$btn_href = $btn_link;
	endif;

	$btn['rel'] = '';
	if($btn_link_type == "external"):
		$btn['rel'] = 'rel="nofollow noopener"';
	endif;

	$btn['link_type'] = $btn_link_type;
	$btn['link'] = $btn_href;
	$btn['target'] = $btn_target;
	$btn['text'] = $btn_text;

	return $btn;
	exit;
}

// echo single CTA button
function dynamic_button( $btn_field ) {
	$btn = get_button_fields( $btn_field );
	echo "<a href='{$btn['link']}' {$btn['ga_tracking']} class='{$btn['class']}' target='{$btn['target']}' {$btn['rel']} {$btn['modal']}>{$btn['text']}</a>";

	if(!empty($btn['video'])):
		echo $btn['video'];
	endif;
}

// echo multiple CTA buttons in a repeater
function dynamic_buttons( $repeater_name, $field_name ) {
	global $post;

	if( have_rows( $repeater_name ) ):
		while( have_rows( $repeater_name ) ): the_row();
			$btn = get_button_fields( $field_name );
			echo "<a href='{$btn['link']}' {$btn['ga_tracking']} class='{$btn['class']}' target='{$btn['target']}' {$btn['rel']} {$btn['modal']}>{$btn['text']}</a>";

			if(!empty($btn['video'])):
				echo $btn['video'];
			endif;
		endwhile;
	endif;
}
