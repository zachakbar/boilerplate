<?php
	
/* Add critical JS to the <head> of the site.
 * 
 */
function critical_js() {
	$js = file_get_contents( get_stylesheet_directory_uri().'/assets/js/jquery.min.js' );
	echo '<script type="text/javascript">'.$js.'</script>';
}
add_action( 'wp_head', 'critical_js' );
	
/* Add critical CSS to the <head> of the site.
 * 
 * @link https://www.sitelocity.com/critical-path-css-generator
 * @link https://www.namehero.com/startup/how-to-inline-and-defer-css-on-wordpress-without-plugins/
 */
function critical_css() {
	$css = file_get_contents( get_stylesheet_directory_uri().'/assets/css/critical.css' );
	echo '<style type="text/css">'.update_style_asset_url( $css ).'</style>';
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

/*
 * Generate additional inline css from Theme Options
 */
 function theme_options_css(){
		$styles_output = "<style type='text/css'>";
		$theme_colors = get_field( 'theme_colors', 'option' );
		$header_styles = get_field( 'header_styles', 'option' );
		if(get_field( 'include_top_bar', 'option' )):
			$top_bar_styles = get_field( 'top_bar_styles', 'option' );
		endif;
		
		$styles_output .= ".has-black-color{color:#141414;}.has-black-background-color{background-color:#141414;}.has-white-color{color:#fff;}.has-white-background-color{background-color:#fff;}";
		
		foreach($theme_colors[0] as $key => $theme_color):
			if(!empty($theme_color)):
				$class = str_replace("_", "-", $key);
				$styles_output .= ".has-$class-color{color:$theme_color;}.has-$class-background-color{background-color:$theme_color;}";
			endif;
		endforeach;
		
		$styles_output .= "header[role='banner']{background-color:".$header_styles['background_color'].";}header[role='banner'] .main-menu ul li a{color:".$header_styles['text_color'].";}header[role='banner'] .main-menu ul li a:hover{color:".$header_styles['text_hover_color'].";}header[role='banner'] .menu-toggle{color:".$header_styles['text_color'].";}header[role='banner'] .menu-toggle .hamburger-inner,header[role='banner'] .menu-toggle .hamburger-inner::before,header[role='banner'] .menu-toggle .hamburger-inner::after{background:".$header_styles['text_color'].";}header[role='banner'] .menu-toggle:hover{color:".$header_styles['text_hover_color'].";}header[role='banner'] .menu-toggle:hover .hamburger-inner,header[role='banner'] .menu-toggle:hover .hamburger-inner::before,header[role='banner'] .menu-toggle:hover .hamburger-inner::after{background:".$header_styles['text_hover_color'].";}";
		
		if(isset($top_bar_styles)):
			$styles_output .= "#top_bar{background-color:".$top_bar_styles['background_color'].";}#top_bar a{color:".$top_bar_styles['text_color'].";}#top_bar a:hover{color:".$top_bar_styles['text_hover_color'].";}";
		endif;
		
		$styles_output .= "</style>";
		echo $styles_output;
 }
 add_filter( 'wp_head', 'theme_options_css' );