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

function theme_setup(){

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
		'main'		=> __('Main Menu', 'THEME_NAME' ),
		'footer'	=> __('Footer Menu', 'THEME_NAME' ),
		'social'	=> __('Social Menu', 'THEME_NAME' ),
	) );

	add_theme_support( 'html5', array(
		'comment-list',
		'comment-form',
		'search-form',
		'gallery',
		'caption'
	) );
};
add_action( 'after_setup_theme', 'theme_setup' );


/************************************************************************/
/* wp_head();
/************************************************************************/

// Add Stylesheets
function theme_styles() {
	wp_enqueue_style( 'styles', get_stylesheet_directory_uri() . '/assets/css/styles.css' );
}
add_action( 'wp_enqueue_scripts', 'theme_styles' );

function theme_scripts() {
	wp_register_script('script', get_template_directory_uri() . '/assets/js/scripts.js', '', NULL, true);
	wp_enqueue_script('script');
}
add_action( 'wp_enqueue_scripts', 'theme_scripts' );

