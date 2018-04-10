<?php
/** whpk redesign
 * David Woldenberg 2018
 *
 * merch.php merchandise page
 * Also empty for now...
 * Templat name: merch
 *
 * @author David Woldenberg
 * @package WordPress
 * @subpackage whpk_redesign
 * @since whpk redesign 1.0
 **/

?>

	<div class="big-announcement">
		<span>Online Store Coming Soon...</span>
	</div>

<?php 

	while ( have_posts() ) : the_post();
		
		echo the_content(); 

	endwhile;
?>