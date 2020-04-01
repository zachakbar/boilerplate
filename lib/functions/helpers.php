<?php

/* simple helper function for the svg path.
 *
 * @param string $svg: SVG file name
 */
function svg_path( $svg ){
	$svg_path = get_stylesheet_directory_uri().'/assets/svg/';
	return file_get_contents( $svg_path . sanitize_file_name( $svg . '.svg' ) );
}

/* shell function to echo ACF image with srcset
 *
 * @param array $image: ACF image field array
 */
function acf_image( $image ) {
	$image_id = $image['id'];
	$size = 'full'; // (thumbnail, medium, large, full or custom size)
	if( $image_id ) {
		echo wp_get_attachment_image( $image_id, $size );
	}
}

/* Remove emoji stuff
 *
 */
function disable_emojicons_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
}
add_action( 'init', 'disable_wp_emojicons' );

function disable_wp_emojicons() {
	// all actions related to emojis
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	// filter to remove TinyMCE emojis
	add_filter( 'tiny_mce_plugins', 'disable_emojicons_tinymce' );
}
add_filter( 'emoji_svg_url', '__return_false' );


/* Append broswer specifc classes to the body class as well as the page slug
 *
 * @param array $classes: array of classes to add to the <body> tag
 */
function custom_body_classes( $classes ){
	global $post;
	$slug = $post->post_name;
	$classes[] .= $slug;
	// the list of WordPress global browser checks
	// @link https://codex.wordpress.org/Global_Variables#Browser_Detection_Booleans
	$browsers = ['is_iphone', 'is_chrome', 'is_safari', 'is_NS4', 'is_opera', 'is_macIE', 'is_winIE', 'is_gecko', 'is_lynx', 'is_IE', 'is_edge'];
	// check the globals to see if the browser is in there and return a string with the match
	$classes[] .= join(' ', array_filter($browsers, function ($browser) {
		return $GLOBALS[$browser];
	}));
	return $classes;
}
// call the filter for the body class
add_filter('body_class', 'custom_body_classes');