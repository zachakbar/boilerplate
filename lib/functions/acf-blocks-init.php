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
if(!function_exists('tdc_block_categories')):
	function tdc_block_categories( $categories, $post ) {
		return in_array('tdc-blocks', $categories) ? $categories : array_merge(
			array(
				array(
					'slug'			=> 'tdc-blocks',
					'title'			=> __( 'Striventa Blocks', 'tdc' ),
				),
			),
			$categories
		);
	}
	add_filter(	'block_categories',	'tdc_block_categories', 10, 2 );
endif;


/*
 * Register custom ACF blocks for use in Gutenberg
 *
 * @link https://developer.wordpress.org/resource/dashicons/
 */
function tdc_register_acf_block_types() {
  // GENREAL BLOCKS
  acf_register_block_type(array(
    'name'              => 'theme_button',
    'title'             => __('Theme Button'),
    'description'       => __('Insert a button using the Theme Styles button settings.'),
    'render_template'   => 'lib/blocks/theme_button.php',
    'category'          => 'tdc-blocks',
    'icon'              => '<svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" role="img" aria-hidden="true" focusable="false"><path d="M19 6H5c-1.1 0-2 .9-2 2v8c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2zm0 10H5V8h14v8z"></path></svg>',
    'keywords'          => array( 'standard', 'content' ),
    'supports'          => [ 'align' => false ],
    //'enqueue_style'     => get_stylesheet_directory_uri().'/assets/css/blocks/theme_button.css'
  ));
}

// Check if function exists and hook into setup.
if( function_exists('acf_register_block_type') ) {
  add_action('acf/init', 'tdc_register_acf_block_types');
}
