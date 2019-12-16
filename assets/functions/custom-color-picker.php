<?php
	
/* Custom Color Picker Selections
 *
 * Adds custom colors to WYSIWYG editor and ACF color picker.
 */
function change_acf_color_picker() {
	$custom_colors = '["#323232","#ffffff"]';
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

/*	WYSIWYG Color Picker Selections
 *	
 */
function color_options( $init ) {
	$default_colors = '
		"323232", "Dark Grey",
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