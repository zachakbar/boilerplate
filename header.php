<?php
/**
 * Theme header
 * @link https://developer.wordpress.org/themes/basics/template-files/
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>

<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta http-equiv="x-ua-compatible" content="ie=edge" />

<?php wp_head(); ?>

</head>

<?php 
global $post;
$slug = $post->post_name;
$mobile_nav_styles = get_field( 'mobile_navigation_styles', 'option' );
?>
<body <?php body_class(); ?>>

<div <?php echo $slug == 'home' ? '' : 'id="'.$slug.'"'; ?> class="container">
	
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

	<header role="banner" class="<?php the_field( 'stickyscroll_behavior', 'option' ); ?>">
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
