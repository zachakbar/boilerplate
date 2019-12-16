<?php
if( have_rows('btn_row') ):
	echo '<div class="btn-row '.$align_class.' row-flex">';
	    while ( have_rows('btn_row') ) : the_row();
			// BUTTON DETAILS
			$btn_txt = get_sub_field('btn_txt');
			$btn_class = get_sub_field('btn_class');
			$link_type = get_sub_field('link_type');
			$pagelink = get_sub_field('pagelink');
			$url = get_sub_field('url');
			$file = get_sub_field('file');

			// LINK TYPE
			if($link_type == 'internal'):
				$link = $pagelink; 
				$target = '_self';
			elseif($link_type == 'url'):
				$link = $url; 
				$target = '_blank';
			elseif($link_type == 'file'):
				$link = $file['url']; 
				$target = '_blank';
			endif;
			
			echo '<div><a href="'.$link.'" class="'.$btn_class.'" target="'.$target.'">'.$btn_txt.'</a></div>';

		endwhile;
	echo '</div>';
endif;