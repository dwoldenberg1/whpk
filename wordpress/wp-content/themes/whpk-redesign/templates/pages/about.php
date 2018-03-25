<?php
/** 
 * whpk redesign
 * David Woldenberg 2018
 *
 * about.php about page
 * Templat name: about
 *
 * @author David Woldenberg
 * @package WordPress
 * @subpackage whpk_redesign
 * @since whpk redesign 1.0
 **/

?>

<?php 

	while ( have_posts() ) : the_post();
		
		echo the_content(); 

	endwhile;
?>