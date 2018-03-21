<?php
/** whpk redesign
 * David Woldenberg 2018
 *
 * hedear.php
 * responsible for setting the html hedears and the navbar, the body, 
 * and the navbar (constants to every page)
 *
 * @author David Woldenberg
 * @package WordPress
 * @subpackage whpk_redesign
 * @since whpk redesign 1.0
 **/

?>
<!DOCTYPE html>

<head <?php language_attributes(); ?>>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>whpk - Home</title>

	<?php wp_head(); ?>
</head>
<body>
	<div class="contact-icons">
      	<a href="http://www.facebook.com/whpk885/" target="_blank"><i class="fab fa-facebook-square"></i></a>
      	<a href="http://twitter.com/whpk_chicago?lang=en" target="_blank"><i class="fab fa-twitter-square"></i></a>
	</div>
	<div class="display-cont">
	      <video class="video-cont" autoplay muted loop>
	      	<source src="whpk.mp4" type="video/mp4">
	      </video>

	</div>
	<div class="sticky-cont">
		<?php 	get_template_part('templates/headers/header'); 
				get_template_part('templatess/navigations/navbar'); 
		?>
	</div>