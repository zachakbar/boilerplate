<?php

// Add Stylesheets
function theme_styles() {
	wp_enqueue_style( 'styles', get_stylesheet_directory_uri() . '/assets/css/styles.css' );
}
add_action( 'wp_enqueue_scripts', 'theme_styles' );

// Add JS
function theme_scripts() {
	wp_register_script('script', get_stylesheet_directory_uri() . '/assets/js/scripts.js', '', NULL, true);
	wp_enqueue_script('script');
}
add_action( 'wp_enqueue_scripts', 'theme_scripts' );

// Add Admin CSS
function admin_style() {
  wp_enqueue_style( 'admin-styles', get_stylesheet_directory_uri().'/assets/css/admin.css' );
}
add_action('admin_enqueue_scripts', 'admin_style');

