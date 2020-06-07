<section id="top_bar" class="desktop top-bar">
	<div class="wrap">
		<div class="top-bar-left">
			<?php
				if(have_rows( 'top_bar_left', 'option' )):
					while(have_rows( 'top_bar_left', 'option' )): the_row();
				
						$layout = get_row_layout();
						
						echo "<div class='top-bar-section $layout'>";
						
						switch($layout) {
							
							case 'social_icons':
								get_template_part( 'lib/template-parts/nav', 'social-icons' );
								break;
							
							case 'phone_number':
								while(have_rows( 'contact_information', 'option' )): the_row();
									if(get_sub_field( 'phone' )):
										echo "<a href='tel:".get_sub_field( 'phone' )."'>".get_sub_field( 'phone' )."</a>";
									endif;
								endwhile;
								break;
							
							case 'email_address':
								while(have_rows( 'contact_information', 'option' )): the_row();
									if(get_sub_field( 'email' )):
										echo "<a href='mailto:".get_sub_field( 'email' )."'>".get_sub_field( 'email' )."</a>";
									endif;
								endwhile;
								break;
							
							case 'menu':
								get_template_part( 'lib/template-parts/nav', 'social-icons' );
								break;
							
							case 'cta_button':
								get_template_part( 'lib/template-parts/nav', 'social-icons' );
								break;
							
							case 'custom':
								the_sub_field( 'top_bar_content' );
								break;
							
						}
						
						echo "</div>";
				
					endwhile;
				endif;
			?>
		</div>
		<div class="top-bar-right">
			<?php
				if(have_rows( 'top_bar_right', 'option' )):
					while(have_rows( 'top_bar_right', 'option' )): the_row();
				
						$layout = get_row_layout();
						
						echo "<div class='top-bar-section $layout'>";
						
						switch($layout) {
							
							case 'social_icons':
								get_template_part( 'lib/template-parts/nav', 'social-icons' );
								break;
							
							case 'phone_number':
								while(have_rows( 'contact_information', 'option' )): the_row();
									if(get_sub_field( 'phone' )):
										echo "<a href='tel:".get_sub_field( 'phone' )."'>".get_sub_field( 'phone' )."</a>";
									endif;
								endwhile;
								break;
							
							case 'email_address':
								while(have_rows( 'contact_information', 'option' )): the_row();
									if(get_sub_field( 'email' )):
										echo "<a href='mailto:".get_sub_field( 'email' )."'>".get_sub_field( 'email' )."</a>";
									endif;
								endwhile;
								break;
							
							case 'menu':
								get_template_part( 'lib/template-parts/nav', 'social-icons' );
								break;
							
							case 'cta_button':
								get_template_part( 'lib/template-parts/nav', 'social-icons' );
								break;
							
							case 'custom':
								the_sub_field( 'top_bar_content' );
								break;
							
						}
						
						echo "</div>";
				
					endwhile;
				endif;
			?>
		</div>
	</div>
</section>