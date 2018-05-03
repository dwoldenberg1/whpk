<?php
/**
 * whpk redesign
 * David Woldenberg 2018
 *
 * 404.php
 * 404 Error when uri not valid
 *
 * @author David Woldenberg
 * @package WordPress
 * @subpackage whpk_redesign
 * @since whpk redesign 1.0
 **/

$GLOBALS["page_title"]  = "404 Page not Found";

get_header(); ?>

<div class="space-taker">
		<?php 	get_template_part('templates/headers/header'); 
				get_template_part('templates/navigation/navbar'); 
		?>
</div>

<div class="main">

	<?php get_template_part('templates/navigation/playing'); ?>

	<div id="fourofour-img">
		<div class="fourfour">
			4
		</div>
		<div class="fouro">
			<img id="fourofour-pic" src="<?php echo get_template_directory_uri().'/public/img/whpktoteaddress.jpg'; ?>">
		</div>
		<div class="fourfour">
			4
		</div>
	</div>
	<div id="fourofour-msg">
		Dang, that page doesn't exist... 
	</div>

</div>

<?php get_footer(); ?>