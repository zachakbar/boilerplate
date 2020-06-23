<?php

// override genesis header
function tdc_genesis_header(){
	$mobile_nav_styles = get_field( 'mobile_navigation_styles', 'option' );
	?>

	<div id="nav_overlay" class="animation-<?php echo $mobile_nav_styles['navigation_animation']; ?>">
		<div class="wrap">
			<nav id="mobile_main_menu" class="main-menu-mobile <?php the_field( 'stickyscroll_behavior', 'option' ); ?>" role="navigation">
				<?php
					wp_nav_menu(
						array(
							'theme_location' => 'main',
							'container_class' => 'main-menu',
							'depth' => 1
						)
					);
				?>
			</nav>
		</div>
	</div>

	<header role="banner" class="<?php the_field( 'stickyscroll_behavior', 'option' ); ?>" itemscope="" itemtype="https://schema.org/WPHeader">
		<?php
			if(get_field( 'include_top_bar', 'option' )):
				get_template_part( 'lib/template-parts/header', 'top-bar' );
			endif;
		?>
		<div class="mobile wrap <?php the_field( 'header_mobile_layout', 'option' ); ?>">
			<?php get_template_part( 'lib/template-parts/header-mobile', 'default' ); ?>
		</div>
		<div class="desktop wrap <?php the_field( 'header_desktop_layout', 'option' ); ?>">
			<?php get_template_part( 'lib/template-parts/header-desktop', get_field( 'header_desktop_layout', 'option' ) ); ?>
		</div>
	</header>

<?php }

remove_action( 'genesis_header', 'genesis_header_markup_open' );
remove_action( 'genesis_header', 'genesis_header_markup_close' );
remove_action( 'genesis_header', 'genesis_do_header' );
add_action( 'genesis_header', 'tdc_genesis_header' );

// return an array with the Section Background ACF field group data
function section_background() {

	$bg = array();

	$bg_style = get_sub_field( 'background_style' );

	if( $bg_style == 'image' ):
		$bg_image = get_sub_field( 'background_image' );
		$bg['style'] = 'background-image:url('.esc_url($bg_image['url']).');';
		$bg['class'] = 'bg-img';
		return $bg;
	elseif( $bg_style == 'color' ):
		$bg_color = get_sub_field( 'background_color' );
		$bg['style'] = 'background-color:'.$bg_color.';';
		$bg['class'] = 'bgcolor';
		return $bg;
	elseif( $bg_style == 'gradient' ):
		$bg_gradient_color = get_sub_field( 'background_gradient_color' );
		$bg['style'] = '';
		$bg['class'] = 'bgcolor gradient '.$bg_gradient_color;
		return $bg;
	else:
		$bg['image'] = '';
		$bg['style'] = '';
		$bg['class'] = '';
		return $bg;
	endif;
}


// Dynamic Button functions
// get info from ACF fields to return to output function
function get_button_fields( $btn_field ) {

	$cta_button = get_field( $btn_field ) ? get_field( $btn_field ) : get_sub_field( $btn_field );
	$btn = array();

	$btn_text = $cta_button['button_text'];
	$btn_styles = $cta_button['button_styles'];
	$btn_link = $cta_button['button_link'];

	$btn_style = isset($btn_styles['background_type']) ? $btn_styles['background_type'] : "";
	$btn_color = isset($btn_styles['button_color']) ? $btn_styles['button_color'] : "";
	$btn_size = isset($btn_styles['button_size']) ? $btn_styles['button_size'] : "";

	if($btn_style == "solid"):
		$btn_color = "has-$btn_color-background-color has-$btn_color-border-color";
	elseif($btn_style == "outline"):
		$btn_color = "has-$btn_color-color has-$btn_color-border-color";
	endif;

	$btn['class'] = "btn $btn_color $btn_style $btn_size";
	$btn['modal'] = "";

	$btn_link_type = $btn_link['button_link_type'];
	$btn_target = $btn_link['button_link_target'];
	$btn_link = $btn_link["button_link_$btn_link_type"];

	if($btn_link_type == "internal"):
		if(is_array($btn_link)):
			$btn_href = get_permalink( $btn_link['ID'] );
		else:
			$btn_href = get_permalink( $btn_link->ID );
		endif;
	else:
		$btn_href = $btn_link;
	endif;

	$btn['rel'] = '';
	if($btn_link_type == "external"):
		$btn['rel'] = 'rel="nofollow noopener"';
	endif;

	$btn['link_type'] = $btn_link_type;
	$btn['link'] = $btn_href;
	$btn['target'] = $btn_target;
	$btn['text'] = $btn_text;

	return $btn;
	exit;
}

// echo single CTA button
function dynamic_button( $btn_field ) {
	$btn = get_button_fields( $btn_field );
	echo "<a href='{$btn['link']}' class='{$btn['class']}' target='{$btn['target']}' {$btn['rel']} {$btn['modal']}>{$btn['text']}</a>";

	if(!empty($btn['video'])):
		echo $btn['video'];
	endif;
}

// echo multiple CTA buttons in a repeater
function dynamic_buttons( $repeater_name, $field_name ) {
	global $post;

	if( have_rows( $repeater_name ) ):
		while( have_rows( $repeater_name ) ): the_row();
			$btn = get_button_fields( $field_name );
			echo "<a href='{$btn['link']}' {$btn['ga_tracking']} class='{$btn['class']}' target='{$btn['target']}' {$btn['rel']} {$btn['modal']}>{$btn['text']}</a>";

			if(!empty($btn['video'])):
				echo $btn['video'];
			endif;
		endwhile;
	endif;
}

// Simple Link
// return the simple link acf fields in an array
function get_simple_link_fields() {

	$link = array();

	$link_type = get_sub_field( 'link_type' );
	$link_target = get_sub_field( 'link_target' );
	$link_url = get_sub_field( 'link_'.$link_type.'' );
	if( $link_type == 'internal' ):
		$link_url = get_permalink( $link_url->ID );
	endif;

	$link['link'] = esc_url($link_url);
	$link['target'] = esc_attr($link_target);

	return $link;
}

// ACF oEmbed
function acf_video_embed( $video ) {
	// use preg_match to find iframe src
	preg_match('/src="(.+?)"/', $video, $matches);
	$src = $matches[1];
	// Add extra parameters to src and replcae HTML.
	$params = array(
	    'controls'  => 0,
	    'hd'        => 1,
	    'autohide'  => 1
	);
	$new_src = add_query_arg($params, $src);
	$video = str_replace($src, $new_src, $video);
	// add extra attributes to iframe html
	$attributes = 'frameborder="0"';
	$video = str_replace('></iframe>', ' ' . $attributes . '></iframe>', $video);
	// Display customized HTML.
	if($video) :
    echo '<div class="video-wrapper">'.$video.'</div>';
	endif;
}

// adds a custom ID. works with the custom ID acf field group.
function custom_section_id() {
	if( get_sub_field( 'add_custom_id' ) == true ):
		echo 'id="'.get_sub_field( 'custom_id' ).'"';
	endif;
}
