<?php
/**
 * front page
 * @link https://developer.wordpress.org/themes/basics/template-files/
 */
get_header();

if(have_posts()):
	while(have_posts()): the_post();

		get_template_part( '/lib/template-parts/page', 'content' );
		
	endwhile;
endif;

get_footer();