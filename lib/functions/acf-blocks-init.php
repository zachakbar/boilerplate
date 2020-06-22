<?php
/*
 * Use this file to create new blocks and block categories for the Gutenberg editor.
 *
 * @link https://www.advancedcustomfields.com/resources/blocks/
 */


/*
 * Create custom Gutenberg block category
 *
 */
function my_acf_block_category( $categories, $post ) {
	return array_merge(
		array(
			array(
				'slug' => 'CUSTOM_CATEGORY_SLUG',
				'title' => __( 'CUSTOM_CATEGORY_NAME', 'CUSTOM_CATEGORY_SLUG' ),
			),
		),
		$categories
	);
}
add_filter( 'block_categories', 'my_acf_block_category', 10, 2);


/*
 * Register custom ACF blocks for use in Gutenberg
 *
 * @link https://developer.wordpress.org/resource/dashicons/
 */
function register_acf_block_types() {
  // GENREAL BLOCKS
  acf_register_block_type(array(
    'name'              => 'BLOCK_SLUG',
    'title'             => __('BLOCK_NAME'),
    'description'       => __('BLOCK_DESCRIPTION'),
    'render_template'   => 'lib/template-parts/blocks/BLOCK_CONTENT.php',
    'category'          => 'CUSTOM_CATEGORY_SLUG',
    'icon'              => 'align-left',
    'keywords'          => array( 'standard', 'content' ),
    'supports'          => [ 'align' => true ],
    'align'             => 'full',
    'enqueue_style'     => get_stylesheet_directory_uri().'/assets/css/blocks/BLOCK_CSS.css'
  ));
}

// Check if function exists and hook into setup.
if( function_exists('acf_register_block_type') ) {
  add_action('acf/init', 'register_acf_block_types');
}
