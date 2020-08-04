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
  // register a interior image hero block.
  acf_register_block_type(array(
      'name'              => 'hero-static',
      'title'             => __('Page Hero'),
      'description'       => __('A static image hero with overlay text.'),
      'render_template'   => 'lib/blocks/hero-static.php',
      'category'          => 'tdc-blocks',
      'icon'              => '<svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" role="img" aria-hidden="true" focusable="false"><path d="M4 4h7V2H4c-1.1 0-2 .9-2 2v7h2V4zm6 9l-4 5h12l-3-4-2.03 2.71L10 13zm7-4.5c0-.83-.67-1.5-1.5-1.5S14 7.67 14 8.5s.67 1.5 1.5 1.5S17 9.33 17 8.5zM20 2h-7v2h7v7h2V4c0-1.1-.9-2-2-2zm0 18h-7v2h7c1.1 0 2-.9 2-2v-7h-2v7zM4 13H2v7c0 1.1.9 2 2 2h7v-2H4v-7z"></path></svg>',
      'keywords'          => array( 'hero', 'static' ),
      'supports'          => [ 'align' => true ],
      'align'             => 'full',
      'enqueue_style'     => get_stylesheet_directory_uri().'/assets/css/blocks/hero.css'
  ));
  // register a text with media block.
  acf_register_block_type(array(
      'name'              => 'text-media',
      'title'             => __('Text with Media'),
      'description'       => __('Split content between a block of text and an image or video.'),
      'render_template'   => 'lib/blocks/text-media.php',
      'category'          => 'tdc-blocks',
      'icon'              => '<svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" role="img" aria-hidden="true" focusable="false"><path d="M13 17h8v-2h-8v2zM3 19h8V5H3v14zM13 9h8V7h-8v2zm0 4h8v-2h-8v2z"></path></svg>',
      'keywords'          => array( 'text', 'media', 'layout' ),
      'supports'          => [ 'align' => true ],
      'align'             => 'full',
      'enqueue_style'     => get_stylesheet_directory_uri().'/assets/css/blocks/text-media.css'
  ));
  // register a block to highlight team members
  acf_register_block_type(array(
    'name'              => 'our-team',
    'title'             => __('Our Team'),
    'description'       => __('Block displaying a group of team members.'),
    'render_template'   => 'lib/blocks/our-team.php',
    'category'          => 'tdc-blocks',
    'icon'              => 'businessman',
    'keywords'          => array( 'standard', 'content' ),
    'supports'          => [ 'align' => true ],
    'align'             => 'full',
    'enqueue_assets'		=> function(){
			wp_enqueue_style( 'block-our-team', get_stylesheet_directory_uri().'/assets/css/blocks/our-team.css', null, date("Y-m-d") );
			wp_enqueue_script( 'block-our-team', get_stylesheet_directory_uri().'/assets/js/blocks/our-team.js', array( 'jquery' ), date("Y-m-d") );
    }
  ));
  // Theme Button pulling from Button Styles in the theme options
  acf_register_block_type(array(
    'name'              => 'theme-button',
    'title'             => __('Theme Button'),
    'description'       => __('Insert a button using the Theme Styles button settings.'),
    'render_template'   => 'lib/blocks/theme-button.php',
    'category'          => 'tdc-blocks',
    'icon'              => '<svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" role="img" aria-hidden="true" focusable="false"><path d="M19 6H5c-1.1 0-2 .9-2 2v8c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2zm0 10H5V8h14v8z"></path></svg>',
    'keywords'          => array( 'standard', 'content' ),
    'supports'          => [ 'align' => false ],
    'enqueue_style'     => get_stylesheet_directory_uri().'/assets/css/blocks/theme-button.css'
  ));
  // Icon block with FA icon and optional label and button
  acf_register_block_type(array(
    'name'              => 'icon-block',
    'title'             => __('Icon Block'),
    'description'       => __('Insert an icon with optional text and CTA button beneath it.'),
    'render_template'   => 'lib/blocks/icon-block.php',
    'category'          => 'tdc-blocks',
    'icon'              => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M116.65 219.35a15.68 15.68 0 0 0 22.65 0l96.75-99.83c28.15-29 26.5-77.1-4.91-103.88C203.75-7.7 163-3.5 137.86 22.44L128 32.58l-9.85-10.14C93.05-3.5 52.25-7.7 24.86 15.64c-31.41 26.78-33 74.85-5 103.88zm143.92 100.49h-48l-7.08-14.24a27.39 27.39 0 0 0-25.66-17.78h-71.71a27.39 27.39 0 0 0-25.66 17.78l-7 14.24h-48A27.45 27.45 0 0 0 0 347.3v137.25A27.44 27.44 0 0 0 27.43 512h233.14A27.45 27.45 0 0 0 288 484.55V347.3a27.45 27.45 0 0 0-27.43-27.46zM144 468a52 52 0 1 1 52-52 52 52 0 0 1-52 52zm355.4-115.9h-60.58l22.36-50.75c2.1-6.65-3.93-13.21-12.18-13.21h-75.59c-6.3 0-11.66 3.9-12.5 9.1l-16.8 106.93c-1 6.3 4.88 11.89 12.5 11.89h62.31l-24.2 83c-1.89 6.65 4.2 12.9 12.23 12.9a13.26 13.26 0 0 0 10.92-5.25l92.4-138.91c4.88-6.91-1.16-15.7-10.87-15.7zM478.08.33L329.51 23.17C314.87 25.42 304 38.92 304 54.83V161.6a83.25 83.25 0 0 0-16-1.7c-35.35 0-64 21.48-64 48s28.65 48 64 48c35.2 0 63.73-21.32 64-47.66V99.66l112-17.22v47.18a83.25 83.25 0 0 0-16-1.7c-35.35 0-64 21.48-64 48s28.65 48 64 48c35.2 0 63.73-21.32 64-47.66V32c0-19.48-16-34.42-33.92-31.67z"/></svg>',
    'keywords'          => array( 'standard', 'content' ),
    'supports'          => [ 'align' => false ],
    'enqueue_style'     => get_stylesheet_directory_uri().'/assets/css/blocks/icon-block.css'
  ));
}

// Check if function exists and hook into setup.
if( function_exists('acf_register_block_type') ) {
  add_action('acf/init', 'tdc_register_acf_block_types');
}
