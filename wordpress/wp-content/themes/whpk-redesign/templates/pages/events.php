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

	date_default_timezone_set('America/Chicago');

	$now = (intval(date('G')) * 60) + intval(date('i'));
	$day_now = date('l');



?>

<div class="events-main">
	<div class="upcoming-events">
	</div>
	<div class="past-events">
	</div>
</div>

<?php 
	echo "placeholder";

	while ( have_posts() ) : the_post();
		
		echo the_content(); 

	endwhile;
?>