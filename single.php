<?php
/**
 * single
 * @link https://developer.wordpress.org/themes/basics/template-files/
 */
?>
<?php get_header(); ?>

<?php if ( have_posts() ): ?>
	<?php while ( have_posts() ) : the_post(); ?>

		<section role="main">

			<article>
				<div class="wrap">
					<?php the_content(); ?>
				</div>
			</article>

			<?php get_sidebar(); ?>

		</section>

	<?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>