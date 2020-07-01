<?php get_desktop_logos(); ?>
<div class="nav-cta-container">
	<nav id="main_menu" role="navigation" itemscope="" itemtype="https://schema.org/SiteNavigationElement">
		<?php
			wp_nav_menu(
				array(
					'theme_location' => 'main',
					'container_class' => 'main-menu',
				)
			);
		?>
	</nav>
	<div class="header-ctas">
		<?php
			if(have_rows( 'header_ctas', 'option' )):
				while(have_rows( 'header_ctas', 'option' )): the_row();
					if(get_sub_field( 'cta_style' ) == "button"):
						dynamic_button('cta_button');
					else:
						$text_link = get_sub_field( 'text_link' );
						$text_link_text = $text_link['button_text'];
						$text_link_type = $text_link['button_link']['button_link_type'];
						$text_link_target = $text_link['button_link']['button_link_target'];
						$text_link_link = $text_link['button_link']["button_link_$text_link_type"];

						if($text_link_type == "internal"):
							if(is_array($text_link_link)):
								$text_link_href = get_permalink( $text_link_link['ID'] );
							else:
								$text_link_href = get_permalink( $text_link_link->ID );
							endif;
						else:
							$text_link_href = $text_link_link;
						endif;

						$text_link_rel = '';
						if($text_link_type == "external"):
							$text_link_rel = 'rel="nofollow noopener"';
						endif;

						echo "<a href='$text_link_href' target='$text_link_target' $text_link_rel>$text_link_text</a>";
					endif;
				endwhile;
			endif;
		?>
	</div>
</div>
