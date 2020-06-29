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

		// add desktop header styles
		$header_styles = get_field( 'desktop_header_styles', 'option' );
		$styles_output .= "header[role='banner']{background-color:".$header_styles['background_color'].";}header[role='banner'] .main-menu ul li a{color:".$header_styles['text_color'].";}header[role='banner'] .main-menu ul li a:hover{color:".$header_styles['text_hover_color'].";}header[role='banner'] .main-menu ul li:hover > a{color:".$header_styles['text_hover_color'].";}header[role='banner'] .menu-toggle{color:".$header_styles['text_color'].";}header[role='banner'] .menu-toggle .hamburger-inner,header[role='banner'] .menu-toggle .hamburger-inner::before,header[role='banner'] .menu-toggle .hamburger-inner::after{background:".$header_styles['text_color'].";}header[role='banner'] .menu-toggle:hover{color:".$header_styles['text_hover_color'].";}header[role='banner'] .menu-toggle:hover .hamburger-inner,header[role='banner'] .menu-toggle:hover .hamburger-inner::before,header[role='banner'] .menu-toggle:hover .hamburger-inner::after{background:".$header_styles['text_hover_color'].";}";

		// add desktop header sub-menu styles
		$submenu_styles = get_field( 'desktop_submenu_styles', 'option' );
		$styles_output .= "header[role='banner'] .main-menu ul li .sub-menu{background-color:".$submenu_styles['background_color'].";}header[role='banner'] .main-menu ul li .sub-menu a{color:".$submenu_styles['text_color'].";}header[role='banner'] .main-menu ul li .sub-menu li:hover{background:".$submenu_styles['hover_background_color'].";}header[role='banner'] .main-menu ul li .sub-menu li:hover > a{color:".$submenu_styles['text_hover_color'].";}";

		// add mobile header styles
		$mobile_header_styles = get_field( 'mobile_header_styles', 'option' );
		$styles_output .= "header[role='banner'] .mobile{background-color:".$mobile_header_styles['background_color'].";color:".$mobile_header_styles['text_color'].";}header[role='banner'] .mobile a{color:".$mobile_header_styles['text_color']."}header[role='banner'] .mobile a:hover{color:".$mobile_header_styles['text_hover_color']."}header[role='banner'] .mobile .menu-toggle{color:".$mobile_header_styles['text_color'].";}header[role='banner'] .mobile .menu-toggle .hamburger-inner,header[role='banner'] .mobile .menu-toggle .hamburger-inner::before,header[role='banner'] .mobile .menu-toggle .hamburger-inner::after{background:".$mobile_header_styles['text_color'].";}header[role='banner'] .mobile .menu-toggle:hover{color:".$mobile_header_styles['text_hover_color'].";}header[role='banner'] .mobile .menu-toggle:hover .hamburger-inner,header[role='banner'] .mobile .menu-toggle:hover .hamburger-inner::before,header[role='banner'] .mobile .menu-toggle:hover .hamburger-inner::after{background:".$mobile_header_styles['text_hover_color'].";}";

		// add mobile navigation styles
		$mobile_nav_styles = get_field( 'mobile_navigation_styles', 'option' );
		$nav_bg_hex = $mobile_nav_styles['background_color'];
		$nav_bg_rgb = hex2rgb($nav_bg_hex);
		$nav_bg_opacity = $mobile_nav_styles['background_opacity'] / 100;
		$nav_bg_css = "rgba(".$nav_bg_rgb['r'].",".$nav_bg_rgb['g'].",".$nav_bg_rgb['b'].",$nav_bg_opacity)";
		$styles_output .= "#nav_overlay{background:$nav_bg_css;-webkit-transition: all .".$mobile_nav_styles['animation_duration']."s ".$mobile_nav_styles['animation_easing']."; -o-transition: all .".$mobile_nav_styles['animation_duration']."s ".$mobile_nav_styles['animation_easing']."; transition: all .".$mobile_nav_styles['animation_duration']."s ".$mobile_nav_styles['animation_easing'].";}#nav_overlay nav a{color:".$mobile_nav_styles['text_color'].";}#nav_overlay nav a:hover,#nav_overlay nav a:active{".$mobile_nav_styles['text_hover_color'].";}";

		// add top bar styles if applicable
		if(isset($top_bar_styles)):
			$styles_output .= "#top_bar{background-color:".$top_bar_styles['background_color'].";border-color:".$top_bar_styles['text_color'].";}#top_bar p{color:".$top_bar_styles['text_color'].";}#top_bar a:not(.btn){color:".$top_bar_styles['text_color'].";}#top_bar a:not(.btn):hover{color:".$top_bar_styles['text_hover_color'].";}";
		endif;

		// add primary button styles
		$primary_btn_styles = get_field( 'primary_button', 'option' );
		$primary_btn_bg_css = $primary_btn_styles['button_type'] == "solid" ? "background-color:".$primary_btn_styles['background_color'].";border-color:".$primary_btn_styles['background_color'] : "border-color:".$primary_btn_styles['border_color'];
		$styles_output .= ".btn.primary-button{".$primary_btn_bg_css.";color:".$primary_btn_styles['text_color'].";border-radius:".$primary_btn_styles['border_radius']."px;border-width:".$primary_btn_styles['border_thickness']."px;font-weight:".$primary_btn_styles['font_weight'].";text-transform:".$primary_btn_styles['text_transform'].";}.btn.primary-button:hover{background-color:".$primary_btn_styles['hover_background_color'].";border-color:".$primary_btn_styles['hover_background_color'].";color:".$primary_btn_styles['hover_text_color'].";}";

		// add secondary button styles
		$secondary_btn_styles = get_field( 'secondary_button', 'option' );
		$secondary_btn_bg_css = $secondary_btn_styles['button_type'] == "solid" ? "background-color:".$secondary_btn_styles['background_color'].";border-color:".$secondary_btn_styles['background_color'] : "border-color:".$secondary_btn_styles['border_color'];
		$styles_output .= ".btn.secondary-button{".$secondary_btn_bg_css.";color:".$secondary_btn_styles['text_color'].";border-radius:".$secondary_btn_styles['border_radius']."px;border-width:".$primary_btn_styles['border_thickness']."px;;font-weight:".$secondary_btn_styles['font_weight'].";text-transform:".$secondary_btn_styles['text_transform'].";}.btn.secondary-button:hover{background-color:".$secondary_btn_styles['hover_background_color'].";border-color:".$secondary_btn_styles['hover_background_color'].";color:".$secondary_btn_styles['hover_text_color'].";}";

		$styles_output .= "</style>";
		echo $styles_output;
 }
 add_filter( 'wp_head', 'theme_options_css' );
