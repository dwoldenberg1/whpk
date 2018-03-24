<?php
/** whpk redesign
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

<!-- do 404 thing with whpktoaddress 4 000 4  or something -->

</div>

<?php get_footer(); ?>