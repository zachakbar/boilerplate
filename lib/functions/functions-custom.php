<?php

// Add Stylesheets
function theme_styles() {
	wp_enqueue_style( 'tdc-styles', get_stylesheet_directory_uri() . '/assets/css/styles.css' );
}
add_action( 'wp_enqueue_scripts', 'theme_styles' );

// Add JS
function theme_scripts() {
	wp_enqueue_script( 'tdc-scripts', get_stylesheet_directory_uri() . '/assets/js/scripts.js', array('jquery'), NULL, true );

	wp_enqueue_script( 'tdc-fontawesome', 'https://kit.fontawesome.com/8aba9c53ef.js', null, '5.13.0' );
}
add_action( 'wp_enqueue_scripts', 'theme_scripts' );

// Add Admin CSS
function admin_style() {
  wp_enqueue_style( 'tdc-admin-styles', get_stylesheet_directory_uri().'/admin/css/tdc-admin.css' );
}
add_action('admin_enqueue_scripts', 'admin_style');

