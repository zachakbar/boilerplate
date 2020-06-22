<?php

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

/*
 * Replace new gutenberg color picker values with custom theme colors
 */
function tdc_editor_colors(){
	// Disable Custom Colors
	//add_theme_support( 'disable-custom-colors' );

	// Define Theme Colors
	$theme_colors = get_field( 'theme_colors', 'option' );
	$custom_colors = array(
		array(
			'name'  => 'Black',
			'slug'  => 'black',
			'color' => '#141414',
		),
		array(
			'name'  => 'White',
			'slug'  => 'white',
			'color' => '#FFFFFF',
		)
	);
	foreach($theme_colors[0] as $key => $theme_color):
		if(!empty($theme_color)):
			$theme_color = substr($theme_color, 1);
			$theme_color_array = array(
				'name'	=> ucwords(str_replace("_", " ", $key)),
				'slug'	=> $key,
				'color'	=> "#".$theme_color,
			);
			$custom_colors[] = $theme_color_array;
		endif;
	endforeach;

	// Editor Color Palette
	add_theme_support( 'editor-color-palette', $custom_colors );
}
add_action( 'after_setup_theme', 'tdc_editor_colors' );
