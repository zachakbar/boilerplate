<?php
/**
 * Genesis Child appearance settings.
 */

$tdc_default_colors = [
	'black' => '#141414',
	'white' => '#ffffff',
];
$tdc_theme_options_colors = get_field( 'theme_colors', 'option' );
$tdc_default_colors = array_merge($tdc_default_colors, $tdc_theme_options_colors);
$tdc_gutenberg_colors = array(
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
foreach($tdc_default_colors[0] as $key => $theme_color):
	if(!empty($theme_color)):
		$theme_color_array = array(
			'name'	=> ucwords(str_replace("_", " ", $key)),
			'slug'	=> $key,
			'color'	=> $theme_color,
		);
		$tdc_gutenberg_colors[] = $theme_color_array;
	endif;
endforeach;

$tdc_link_color = get_theme_mod(
	'tdc_link_color',
	$tdc_default_colors['black']
);

$tdc_accent_color = get_theme_mod(
	'tdc_accent_color',
	$tdc_default_colors['white']
);

$tdc_link_color_contrast   = tdc_color_contrast( $tdc_link_color );
$tdc_link_color_brightness = tdc_color_brightness( $tdc_link_color, 35 );

return [
	'fonts-url'            => 'https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,400i,600,700&display=swap',
	'content-width'        => 1062,
	'button-bg'            => $tdc_link_color,
	'button-color'         => $tdc_link_color_contrast,
	'button-outline-hover' => $tdc_link_color_brightness,
	'link-color'           => $tdc_link_color,
	'accent-color'           => $tdc_accent_color,
	'default-colors'       => $tdc_default_colors,
	'editor-color-palette' => $tdc_gutenberg_colors,
	'editor-font-sizes'    => [
		[
			'name' => __( 'Small', 'genesis-sample' ),
			'size' => 12,
			'slug' => 'small',
		],
		[
			'name' => __( 'Normal', 'genesis-sample' ),
			'size' => 18,
			'slug' => 'normal',
		],
		[
			'name' => __( 'Large', 'genesis-sample' ),
			'size' => 20,
			'slug' => 'large',
		],
		[
			'name' => __( 'Larger', 'genesis-sample' ),
			'size' => 24,
			'slug' => 'larger',
		],
	],
];
