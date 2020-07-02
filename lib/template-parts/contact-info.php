<?php
while(have_rows( 'contact_info' )): the_row();

	$contact_info = get_field( 'contact_information', 'option' );
	echo "<div class='contact-info' itemscope itemtype='http://schema.org/LocalBusiness'>";
	echo "<meta itemprop='name' content='".get_bloginfo( 'name' )."'>";

	if(get_sub_field( 'phone_number' )):
		echo "<p class='phone' itemprop='telephone'>".$contact_info['phone']."</p>";
	endif;
	if(get_sub_field( 'email_address' )):
		echo "<p class='email' itemprop='email'>".$contact_info['email']."</p>";
	endif;
	if(get_sub_field( 'address' )):
		echo "<p class='address' itemprop='address' itemscope itemtype='http://schema.org/PostalAddress'>";
		echo "<span class='street-address' itemprop='streetAddress'>".$contact_info['street_address']."</span><br>";
		echo "<span class='city' itemprop='addressLocality'>".$contact_info['city']."</span>, ";
		echo "<span class='state' itemprop=''addressRegion>".$contact_info['state']."</span> ";
		echo "<span class='zip'> itemprop='postalCode'".$contact_info['zip_code']."</span>";
	endif;

	echo "</div>";

endwhile;
