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

<?php 
	echo "placeholder";

	while ( have_posts() ) : the_post();
		
		echo the_content(); 

	endwhile;
?>