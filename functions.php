<?php
/**
 * Genesis Child.
 *
 * This file adds functions to the Genesis Child Theme.
 *
 */

// Start the Genesis Engine.
require_once get_template_directory() . '/lib/init.php';

/**
 * Theme Setup/Functions
 *
 * The $theme_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 */
$theme_includes = [
	// classes
	'/lib/classes/class-duplicate-post.php', // Duplicate Post
	'/lib/classes/class-script-loader.php', // Adds Asyc/Defer option to wp_enqueue

	// setup
	'/lib/theme-defaults.php', // Main theme setup

	// additional genesis
	'/lib/helper-functions.php',
	'/lib/customize.php',
	'/lib/output.php',

	// custom functions
	'/lib/functions/acf-functions.php',
	'/lib/functions/page-elements.php',
	'/lib/functions/critical-assets.php',
	'/lib/functions/functions-custom.php',

	// custom block functions
	//'/lib/functions/acf-blocks-init.php',
	//'/lib/functions/block-functions.php',
];

foreach ( $theme_includes as $file ) {

  if( !$filepath = locate_template( $file ) ):
    trigger_error( sprintf( __('Error locating %s for inclusion', 'hfw'), $file ), E_USER_ERROR );
  endif;

  require_once $filepath;
}
unset( $file, $filepath );

add_action( 'after_setup_theme', 'tdc_localization_setup' );
