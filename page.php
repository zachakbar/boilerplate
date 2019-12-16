<?php
/**
 * default for pages
 * @link https://developer.wordpress.org/themes/basics/template-files/
 */
?>
<?php get_header(); ?>

<?php if ( have_posts() ): ?>
	<?php while ( have_posts() ) : the_post(); ?>

	<section role="main">
		
		<header id="hero">
			<div class="wrap">
				<h1><?php the_title(); ?></h1>
			</div>
		</header>
		
		<section>
			<div class="wrap">
				<article>
					<?php the_content(); ?>
				</article>
			</div>
		</section>
		
	</section>

	<?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>