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
global $wp_query;
$post_id = $wp_query->post->ID;
$post = get_post( $post_id );
$slug = $post->post_name;
?>
<body <?php body_class(); ?>>

<div <?php echo $slug == 'home' ? '' : 'id="'.$slug.'"'; ?> class="container">
	
	<header role="banner">
		<div class="wrap">
			<?php the_custom_logo(); ?>
			<nav id="main_menu" role="navigation">
				<?php 
					wp_nav_menu(
						array(
							'theme_location' => 'main',
							'container_class' => 'menu',
						)
					);
				?>
			</nav>
		</div>
	</header>
