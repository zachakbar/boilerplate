<?php

/************************************************************************/
/* FUNCTIONS
/************************************************************************/

	// why don't ya add somethin' already?!
	include( get_template_directory().'/lib/functions/acf-functions.php' );
	include( get_template_directory().'/lib/functions/critical-assets.php' );
	include( get_template_directory().'/lib/functions/custom-color-picker.php' );
	include( get_template_directory().'/lib/functions/helpers.php' );
	include( get_template_directory().'/lib/functions/page-elements.php' );


/************************************************************************/
/* THEME SUPPORT
/************************************************************************/

function tdc_theme_setup(){

	add_theme_support( 'title-tag' );

	add_theme_support('menus');

	add_theme_support( 'custom-logo', array(
		'width'       => 400,
		'height'      => 100,
		'flex-height' => true,
		'flex-width'  => true,
		'header-text' => array( 'site-title', 'site-description' ),
	) );

	add_theme_support('post-thumbnails');
	//add_image_size('custom-size', 700, 200, true); // Custom Thumbnail Size call using the_post_thumbnail('custom-size');

	register_nav_menus( array(
		'main'				=> __('Main Menu', 'tdc' ),
		'main-left'		=> __('Main Menu - Left (for centered logo header)', 'tdc' ),
		'main-right'	=> __('Main Menu - Right (for centered logo header)', 'tdc' ),
		'footer'			=> __('Footer Menu', 'tdc' ),
		'social'			=> __('Social Menu', 'tdc' ),
	) );

	add_theme_support( 'html5', array(
		'comment-list',
		'comment-form',
		'search-form',
		'gallery',
		'caption'
	) );
};
add_action( 'after_setup_theme', 'tdc_theme_setup' );


/************************************************************************/
/* wp_head();
/************************************************************************/

// Add Stylesheets
function tdc_theme_assets() {
	wp_enqueue_style( 'tdc-styles', get_stylesheet_directory_uri() . '/assets/css/styles.css' );
	
	wp_enqueue_script( 'tdc-script', get_template_directory_uri() . '/assets/js/scripts.js', '', NULL, true );
}
add_action( 'wp_enqueue_scripts', 'tdc_theme_assets' );

function tdc_admin_assets() {
	wp_enqueue_style( 'tdc-admin-styles', get_stylesheet_directory_uri() . '/admin/css/tdc-admin.css' );
}
add_action( 'admin_enqueue_scripts', 'tdc_admin_assets' );
