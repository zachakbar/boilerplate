<?php
	
/* Add critical CSS to the <head> of the site.
 * 
 * @param 
 */
function critical_css() {
	?>
		[INSERT CRITICAL CSS HERE]
	<?php
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