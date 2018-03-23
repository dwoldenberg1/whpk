<?php
/** whpk redesign
 * David Woldenberg 2018
 *
 * index.php landing page
 *
 * @author David Woldenberg
 * @package WordPress
 * @subpackage whpk_redesign
 * @since whpk redesign 1.0
 **/

$GLOBALS["page_title"] = "home";

get_header(); ?>

	<div class="contact-icons">

	  	<?php get_template_part('templates/navigation/social'); ?>

	</div>
	<div class="display-cont">
	      <video class="video-cont" autoplay muted loop>
	      	<source src="<?php echo get_template_directory_uri().'/public/img/whpk.mp4'; ?>" type="video/mp4">
	      </video>

	</div>

<?php get_footer(); ?>