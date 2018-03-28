<?php
/** whpk redesign
 * David Woldenberg 2018
 *
 * donate.php donation page
 * For now it is empty (no implementation)
 * Templat name: donate
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