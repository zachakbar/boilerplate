<?php

/* Add critical JS to the <head> of the site.
 *
 */
function critical_js() {
	$js = file_get_contents( get_stylesheet_directory_uri().'/assets/js/jquery.min.js' );
	echo '<script type="text/javascript">'.$js.'</script>';
}
//add_action( 'wp_head', 'critical_js' );

/* Add critical CSS to the <head> of the site.
 *
 * @link https://www.sitelocity.com/critical-path-css-generator
 * @link https://www.namehero.com/startup/how-to-inline-and-defer-css-on-wordpress-without-plugins/
 */
function critical_css() {
	$css = file_get_contents( get_stylesheet_directory_uri().'/assets/css/critical.css' );
	echo '<style>'.update_style_asset_url( $css ).'</style>';
}
add_action( 'wp_head', 'critical_css' );


/* Add rel="preload" to stylesheets loaded by wp_enqueue_scripts()
 *
 * @param string $html: The link tag for the enqueued style.
 * @param string $handle: The style's registered handle.
 * @param string $href: The stylesheet's source URL.
 * @param string $media: The stylesheet's media attribute.
 */
function add_rel_preload($html, $handle, $href, $media) {
  if (is_admin()):
    return $html;
  endif;

  $html = <<<EOT
		<link rel='preload' as='style' id='$handle' href='$href' type='text/css' media='all' />
		<link rel='stylesheet' as='style' id='$handle' href='$href' type='text/css' media='all' />
EOT;
  return $html;
}
add_filter( 'style_loader_tag', 'add_rel_preload', 10, 4 );


/* Correct asset path urls for critical css.
 *
 */
function update_style_asset_url( $haystack ) {
	$path = get_stylesheet_directory_uri().'/assets/';
	$paths = [ '../fonts/', '../img/', '../svg/' ];
	$new_paths = [ $path.'fonts/', $path.'img/', $path.'svg/' ];
	return str_replace( $paths, $new_paths, $haystack );
}