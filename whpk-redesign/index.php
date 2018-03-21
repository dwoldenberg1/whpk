<?php
/** whpk redesign
 * David Woldenberg 2018
 *
 * Index.php landing page
 *
 * @author David Woldenberg
 * @package WordPress
 * @subpackage whpk_redesign
 * @since whpk redesign 1.0
 **/

get_header(); ?>

	<div class="contact-icons">
	  	<a href="http://www.facebook.com/whpk885/" target="_blank"><i class="fab fa-facebook-square"></i></a>
	  	<a href="http://twitter.com/whpk_chicago?lang=en" target="_blank"><i class="fab fa-twitter-square"></i></a>
	</div>
	<div class="display-cont">
	      <video class="video-cont" autoplay muted loop>
	      	<source src="<?php get_template_directory_uri().'/public/img/whpk.mp4'?>" type="video/mp4">
	      </video>

	</div>

<?php get_footer(); ?>