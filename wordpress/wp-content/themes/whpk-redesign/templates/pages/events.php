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

	$now = time();

	$upcoming_events = 0;
	$past_events = 0;

	$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

	$upcoming_events = array(
      'post_type' => 'event',
      'nopaging' => true,
      'meta_key' => 'start_time',
      'orderby' => 'meta_value_num',
      'order' => 'ASC',
      'meta_query' => array(
	    array(
	      'key' => 'start_time',
	      'value' => $now,
	      'compare' => '>='
	    )
  	   )
    );

    $past_events = array(
      'post_type' => 'event',
      'posts_per_page' => 5,
      'paged' => $paged,
      'meta_key' => 'start_time',
      'orderby' => 'meta_value_num',
      'order' => 'ASC',
      'meta_query' => array(
	    array(
	      'key' => 'start_time',
	      'value' => $now,
	      'compare' => '<'
	    )
  	   )
    );

    $upcoming = new WP_Query($upcoming_events);
    $past = new WP_Query($past_events);

    $u_count = $upcoming->post_count;
    $p_count = $past->post_count;

?>

<div class="events-main">
	<?php if ($paged == 1) : ?>
	<div class="upcoming-events">
		<h3>Upcoming Events</h3>

		<?php 

		if( $upcoming->have_posts() ) :
			while ( $upcoming->have_posts() ) :
				$upcoming->the_post();

				$title = get_the_title();
				$desc  = get_the_content();

				$loc  = get_post_meta( $upcoming->post->ID, 'event_location', true );
				$addr = get_post_meta( $upcoming->post->ID, 'event_address', true );

				$start_t = get_post_meta( $upcoming->post->ID, 'start_time', true );
				$end_t   = get_post_meta( $upcoming->post->ID, 'end_time', true );

				?>

				<div class="u-event">
					<?php if( has_post_thumbnail($upcoming->post) ) : ?>
					<div class="thumb-vert">
						<div class="event-d-vert">
						<div class="event-day">
								<?php echo date('j', $start_t); ?>
							</div>
							<div class="event-month">
								<?php echo date('M', $start_t); ?>
							</div>
							<div class="event-weekday">
								<?php echo date('l', $start_t); ?>
							</div>
						</div>
						<div class="event-data-info-vert">
							<div class="event-loc">
								<span>Location: <?php echo $loc; ?></span>
								<?php if($addr != "") : ?>
								<br>
								<span>(<a class="g-maps-event" target="_blank" href="https://maps.google.com/?q=<?php echo $addr?>"><?php echo $addr?></a>)</span>
							<?php endif; ?>
							</div>
							<div class="event-times">
								<?php echo "<span>".date('n/j g:i a', $start_t). "</span> - <span>" .date('n/j g:i a', $end_t),"</span>"; ?>
							</div>
						</div>
					</div>
					<?php else : ?>
					<div class="event-d">
						<div class="event-day">
							<?php echo date('j', $start_t); ?>
						</div>
						<div class="event-month">
							<?php echo date('M', $start_t); ?>
						</div>
						<div class="event-weekday">
							<?php echo date('l', $start_t); ?>
						</div>
					</div>
					<div class="event-data-info">
						<div class="event-loc">
							<span>Location: <?php echo $loc; ?></span>
							<?php if($addr != "") : ?>
							<br>
							<span>(<a class="g-maps-event" target="_blank" href="https://maps.google.com/?q=<?php echo $addr?>"><?php echo $addr?></a>)</span>
	
							<?php endif; ?>					
						</div>
						<div class="event-times">
							<?php echo "<span>".date('n/j g:i a', $start_t). "</span> - <span>" .date('n/j g:i a', $end_t),"</span>"; ?>
						</div>
					</div>
					<?php endif;?>
					<div class="event-main-cont">
						<div class="event-title">
							<b><?php echo $title; ?></b>
						</div>
						<?php the_post_thumbnail(); ?>
						<div class="event-desc">
							<?php echo $desc; ?>
						</div>
					</div>
				</div>

				<?php

			endwhile;
		else :
			echo "<p>There are no upcoming events.</p>";
		endif;
		?>
	</div>
<?php endif; ?>
	<div class="past-events">
		<h3>Past Events</h3>

		<?php 

		if( $past->have_posts() ) :
			while ( $past->have_posts() ) :
				$past->the_post();

				$title = get_the_title();
				$desc  = get_the_content();

				$loc =  get_post_meta( $past->post->ID, 'event_location', true );
				$addr = get_post_meta( $past->post->ID, 'event_address', true );

				$start_t = get_post_meta( $past->post->ID, 'start_time', true );
				$end_t   = get_post_meta( $past->post->ID, 'end_time', true );

				?>

				<div class="u-event">
					<?php if( has_post_thumbnail($past->post) ) : ?>
					<div class="thumb-vert">
						<div class="event-d-vert">
						<div class="event-day">
								<?php echo date('j', $start_t); ?>
							</div>
							<div class="event-month">
								<?php echo date('M', $start_t); ?>
							</div>
							<div class="event-weekday">
								<?php echo date('l', $start_t); ?>
							</div>
						</div>
						<div class="event-data-info-vert">
							<div class="event-loc">
								<span>Location: <?php echo $loc; ?></span>
								<?php if($addr != "") : ?>
								<br>
								<span>(<a class="g-maps-event" target="_blank" href="https://maps.google.com/?q=<?php echo $addr?>"><?php echo $addr?></a>)</span>
								<?php endif; ?>
							</div>
							<div class="event-times">
								<?php echo "<span>".date('n/j g:i a', $start_t). "</span> - <span>" .date('n/j g:i a', $end_t),"</span>"; ?>
							</div>
						</div>
					</div>
					<?php else : ?>
					<div class="event-d">
						<div class="event-day">
							<?php echo date('j', $start_t); ?>
						</div>
						<div class="event-month">
							<?php echo date('M', $start_t); ?>
						</div>
						<div class="event-weekday">
							<?php echo date('l', $start_t); ?>
						</div>
					</div>
					<div class="event-data-info">
						<div class="event-loc">
							<span>Location: <?php echo $loc; ?></span>
							<?php if($addr != "") : ?>
							<br>
							<span>(<a class="g-maps-event" target="_blank" href="https://maps.google.com/?q=<?php echo $addr?>"><?php echo $addr?></a>)</span>
							<?php endif; ?>					
						</div>
						<div class="event-times">
							<?php echo "<span>".date('n/j g:i a', $start_t). "</span> - <span>" .date('n/j g:i a', $end_t),"</span>"; ?>
						</div>
					</div>
					<?php endif;?>
					<div class="event-main-cont">
						<div class="event-title">
							<b><?php echo $title; ?></b>
						</div>
						<?php the_post_thumbnail(); ?>
						<div class="event-desc">
							<?php echo $desc; ?>
						</div>
					</div>
				</div>

				<?php

			endwhile;
			?>
			<div class="nav-cont">
				<?php numeric_posts_nav($past); ?>
			</div>
			<?php
		else :
			echo "<p>There are no upcoming events.</p>";
		endif;
		?>
	</div>
</div>