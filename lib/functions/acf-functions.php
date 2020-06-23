<?php

/* ==========================================
	Theme Options page
========================================== */
if( function_exists('acf_add_options_page') ) {
	// Add parent.
  $parent = acf_add_options_page(array(
		'page_title' 	=> __('Theme Options'),
		'menu_title'	=> __('Theme Options'),
		'menu_slug' 	=> 'theme-options',
		'capability'	=> 'edit_posts',
		'redirect'		=> true,
		'parent_slug'	=> ''
  ));

  // Add general sub page.
  $child = acf_add_options_sub_page(array(
      'page_title'  => __('General Options'),
      'menu_title'  => __('General Options'),
      'parent_slug' => $parent['menu_slug'],
  ));

  // Add header sub page.
  $child = acf_add_options_sub_page(array(
      'page_title'  => __('Header Options'),
      'menu_title'  => __('Header Options'),
      'parent_slug' => $parent['menu_slug'],
  ));

  // Add footer sub page.
  $child = acf_add_options_sub_page(array(
      'page_title'  => __('Footer Options'),
      'menu_title'  => __('Footer Options'),
      'parent_slug' => $parent['menu_slug'],
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


/* ================================================
	Add custom color pickers based on theme colors
================================================ */
/* Custom Color Picker Selections
 *
 * Adds custom colors to WYSIWYG editor and ACF color picker.
 */
function tdc_change_acf_color_picker() {
	$custom_colors = '["#141414","#ffffff"';
	$theme_colors = get_field( 'theme_colors', 'option' );
	$custom_colors .= ',"'.$theme_colors[0]['theme_color_1'].'","'.$theme_colors[0]['theme_color_2'].'","'.$theme_colors[0]['theme_color_3'].'","'.$theme_colors[0]['theme_color_4'].'","'.$theme_colors[0]['theme_color_5'].'","'.$theme_colors[0]['theme_color_6'].'"]';
	echo "<script>
		acf.add_filter('color_picker_args', function( args, field ){

		    // overwrite palette with custom colors
		    args.palettes = $custom_colors

		    // return
		    return args;

		});
	</script>";
}
add_action( 'acf/input/admin_head', 'tdc_change_acf_color_picker' );

/*	WYSIWYG Color Picker Selections
 *
 */
function tdc_wysiwyg_color_options( $init ) {
	$default_colors = '
		"141414", "Black",
		"FFFFFF", "White",
	';
	// Add custom colors here
	$theme_colors = get_field( 'theme_colors', 'option' );
	$custom_colors = '';
	foreach($theme_colors[0] as $key => $theme_color):
		if(!empty($theme_color)):
			$theme_color = substr($theme_color, 1);
			$custom_colors .= '"'.$theme_color.'", "'.ucwords(str_replace("_", " ", $key)).'",';
		endif;
	endforeach;

	$init['textcolor_map'] = '['.$default_colors.','.$custom_colors.']'; // build color grid default+custom colors
	$init['textcolor_rows'] = 6; // enable 6th row for custom colors in grid
	return $init;
}
add_filter( 'tiny_mce_before_init', 'tdc_wysiwyg_color_options' );
