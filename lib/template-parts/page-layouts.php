<?php

if(have_rows( 'layouts' )):
	while(have_rows( 'layouts' )): the_row();

		$layout = get_row_layout();
		
		switch($layout) {
			
			case 'LAYOUT_NAME':
				get_template_part( 'template-parts/content', 'LAYOUT_NAME' );
				break;
			
		}

	endwhile;
endif;