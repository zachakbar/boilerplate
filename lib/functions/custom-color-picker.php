<?php

/*
 * Custom Color Picker Selections
 *
 * Adds custom colors to WYSIWYG editor and ACF color picker.
 */
function change_acf_color_picker() {
	$custom_colors = '["#000000","#ffffff"]';
	echo "<script>
		acf.add_filter('color_picker_args', function( args, field ){

		    // overwrite palette with custom colors
		    args.palettes = $custom_colors

		    // return
		    return args;

		});
	</script>";
}
add_action( 'acf/input/admin_head', 'change_acf_color_picker' );

/*
 * WYSIWYG Color Picker Selections
 *
 */
function color_options( $init ) {
	$default_colors = '
		"000000", "Black",
		"FFFFFF", "White",
	';
	// Add custom colors here
	$custom_colors = '

	';
	$init['textcolor_map'] = '['.$default_colors.','.$custom_colors.']'; // build color grid default+custom colors
	$init['textcolor_rows'] = 6; // enable 6th row for custom colors in grid
	return $init;
}
add_filter( 'tiny_mce_before_init', 'color_options' );



/*
 * Custom Editor Color Palette
 *
 */
function custom_editor_color_palette(){
	// Editor Color Palette
	add_theme_support( 'editor-color-palette', array(
		array(
			'name'	=> __( 'Black', 'wp-theme-genesis-child' ),
			'slug'	=> 'black',
			'color'	=> '#000000',
		),
		array(
			'name'	=> __( 'White', 'wp-theme-genesis-child' ),
			'slug'	=> 'white',
			'color'	=> '#FFFFFF',
		),
	) );
};
add_action( 'after_setup_theme', 'custom_editor_color_palette' );