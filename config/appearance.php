<?php
/**
 * Genesis Child appearance settings.
 */

$tdc_default_colors = [
	'link'   => '#0073e5',
	'accent' => '#0073e5',
];

$tdc_link_color = get_theme_mod(
	'tdc_link_color',
	$tdc_default_colors['link']
);

$tdc_accent_color = get_theme_mod(
	'tdc_accent_color',
	$tdc_default_colors['accent']
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
	'default-colors'       => $tdc_default_colors,
	'editor-color-palette' => [
		[
			'name'  => __( 'Custom color', 'genesis-sample' ), // Called “Link Color” in the Customizer options. Renamed because “Link Color” implies it can only be used for links.
			'slug'  => 'theme-primary',
			'color' => $tdc_link_color,
		],
		[
			'name'  => __( 'Accent color', 'genesis-sample' ),
			'slug'  => 'theme-secondary',
			'color' => $tdc_accent_color,
		],
	],
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
