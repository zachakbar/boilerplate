<?php

// Add Theme Options page via ACF
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page(array(
		'page_title' 	=> 'Theme Options',
		'menu_title'	=> 'Theme Options',
		'menu_slug' 	=> 'theme-options',
		'capability'	=> 'edit_posts',
		'redirect'		=> false, 
		'parent_slug'	=> ''
	));
}


function register_acf_block_types() {
  // register a text with media block.
  acf_register_block_type(array(
      'name'              => 'text-media',
      'title'             => __('Text with Media'),
      'description'       => __('Standard content module with an image or video taking up 2/3 of the row and text taking up the other 1/3.'),
      'render_template'   => 'lib/blocks/text-media.php',
      'category'          => 'common',
      'icon'              => 'align-left',
      'keywords'          => array( 'standard', 'content', 'media' ),
      'supports'          => [ 'align' => true ],
      'align'             => 'full',
      'enqueue_style'     => get_template_directory_uri().'/assets/css/blocks/text-media.css'
  ));
}

// Check if function exists and hook into setup.
if( function_exists('acf_register_block_type') ) {
    add_action('acf/init', 'register_acf_block_types');
}