<?php
/** 
 * whpk redesign
 * David Woldenberg 2018
 *
 * index.php landing page
 *
 * @author David Woldenberg
 * @package WordPress
 * @subpackage whpk_redesign
 * @since whpk redesign 1.0
 **/

$page_title = "home";

//get_theme_mod('under-construction') == '' for not construction, == 1 for construction

get_header(); ?>

	<div class="space-taker" style="background : rgba(255, 255, 255, 0.4);">

		<?php 	get_template_part('templates/headers/header'); 
				get_template_part('templates/navigation/navbar');
				//error_log(get_theme_mod('under-construction'), 0);
		?>
	</div>

	<div class="contact-icons">

		<div class="main-num">773-702-8289</div>
	  	<?php get_template_part('templates/navigation/social'); ?>

	</div>
	<div class="display-cont">
	    <video class="video-cont" autoplay muted loop>
	      	<source src="<?php echo get_template_directory_uri().'/public/img/whpk.mp4'; ?>" type="video/mp4">
	    </video>

	</div>

	<div class="main">
		<?php get_template_part('templates/navigation/playing'); ?>
	</div>

<?php get_footer(); ?>