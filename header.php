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
?>
<body <?php body_class(); ?>>

<div <?php echo $slug == 'home' ? '' : 'id="'.$slug.'"'; ?> class="container">

	<?php 
		echo get_template_part( 'lib/template-parts/header-mobile', get_field( 'header_mobile_layout', 'option' ) ); 
		echo get_template_part( 'lib/template-parts/header-desktop', get_field( 'header_desktop_layout', 'option' ) ); 
	?>
