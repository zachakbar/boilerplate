<?php
/**
 * Genesis Sample child theme.
 *
 * Theme supports.
 *
 * @package Genesis Sample
 * @author  StudioPress
 * @license GPL-2.0-or-later
 * @link    https://my.studiopress.com/themes/genesis-sample/
 */

return [
	'genesis-custom-logo'             => [
		'height'      => 120,
		'width'       => 700,
		'flex-height' => true,
		'flex-width'  => true,
	],
	'html5'                           => [
		'caption',
		'comment-form',
		'comment-list',
		'gallery',
		'search-form',
		'script',
		'style',
	],
	'genesis-accessibility'           => [
		'drop-down-menu',
		'headings',
		'search-form',
		'skip-links',
	],
	'genesis-lazy-load-images'        => '',
	'genesis-after-entry-widget-area' => '',
	'genesis-footer-widgets'          => 3,
	'genesis-menus'                   => [
		'main'				=> __('Main Menu', 'tdc' ),
		'main-left'		=> __('Main Menu - Left (for centered logo header)', 'tdc' ),
		'main-right'	=> __('Main Menu - Right (for centered logo header)', 'tdc' ),
		'footer'			=> __('Footer Menu', 'tdc' ),
		'social'			=> __('Social Menu', 'tdc' ),
	],
];
