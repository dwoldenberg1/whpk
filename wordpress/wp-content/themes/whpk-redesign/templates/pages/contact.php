<?php
/** whpk redesign
 * David Woldenberg 2018
 *
 * contact.php contact page
 * Templat name: contact
 *
 * @author David Woldenberg
 * @package WordPress
 * @subpackage whpk_redesign
 * @since whpk redesign 1.0
 **/

?>
	<div class="whpk-contact-head">
		<div class="contact-whpk contact-item">
			<span>WHPK</span>
			<br>
			<span>88.5 fm Chicago</span>
		</div>
		<div class="contact-address contact-item">
			<a href="http://www.google.com/maps?q=5706+S+University+Ave,+Chicago,+IL+60637,+USA&ie=UTF8&z=16&iwloc=addr&om=1" target="_blank">
				<span>Reynolds Club</span>
				<br>
				<span>5706 S. University Ave.</span>
				<br>
				<span>Chicago, IL 60637</span>
			</a>
		</div>
		<div class="contact-numbers contact-item">
			<span>studio: 773-702-8424</span>
			<br> 
			<span>Phone Line: 712 432 7726</span>
			<br>
			<a href="mailto:contact@whpk.org">
				<span>contact@whpk.org</span>
			</a>
		</div>
	</div>

	<div class="contact-main">
		<h1> - Our Staff - </h1>
	<?php

		while ( have_posts() ) : the_post();
			
			echo the_content(); 

		endwhile;

	?>
	</div>