<?php

if(have_rows( 'layouts' )):
	while(have_rows( 'layouts' )): the_row();

		$layout = get_row_layout();
		
		get_template_part( 'lib/template-parts/content', $layout );

	endwhile;
endif;