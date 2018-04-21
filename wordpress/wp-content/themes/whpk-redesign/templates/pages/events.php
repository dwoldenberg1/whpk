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

	$upcoming_events = 0;
	$past_events = 0;


?>

<div class="events-main">
	<div class="upcoming-events">
		<h3>Upcoming Events</h3>

		<?php 

		if ($upcoming_events == 0) {
			echo "<p>There are no upcoming events.</p>";
		} else {

		}
		?>
	</div>
	<div class="past-events">
		<h3>Past Events</h3>

		<?php 

		if ($upcoming_events == 0) {
			echo "<p>There are no past events.</p>";
		} else {

		}
		?>
	</div>
</div>

<?php 

	while ( have_posts() ) : the_post();
		
		echo the_content(); 

	endwhile;
?>