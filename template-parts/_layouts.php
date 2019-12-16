<?php
	if(have_rows( 'layouts' )):
		while(have_rows( 'layouts' )): the_row();
		
			$layout = get_row_layout();
			
			// make sure layout is named the same in the ACF flexible content field.
			get_template_part( 'template-parts/layout', $layout );

		endwhile;
	endif;
?>
