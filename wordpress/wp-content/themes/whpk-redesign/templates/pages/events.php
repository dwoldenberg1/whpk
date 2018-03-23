<?php
/** whpk redesign
 * David Woldenberg 2018
 *
 * events.php page for upcoming events
 * Templat name: events
 *
 * @author David Woldenberg
 * @package WordPress
 * @subpackage whpk_redesign
 * @since whpk redesign 1.0
 **/

?>

<?php 
	echo "placeholder";

	while ( have_posts() ) : the_post();
		
		echo the_content(); 

	endwhile;
?>