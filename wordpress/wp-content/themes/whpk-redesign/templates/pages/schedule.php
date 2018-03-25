<?php
/** 
 * whpk redesign
 * David Woldenberg 2018
 *
 * schedule.php schedule page
 * will be dynamic
 * Templat name: schedule
 *
 * @author David Woldenberg
 * @package WordPress
 * @subpackage whpk_redesign
 * @since whpk redesign 1.0
 **/

	$days = ["monday", "tuesday", "wednesday", "thursday", "friday", "saturday", "sunday"];
	$day_count = 0;
	$active_shows = array();

	foreach($days as $day){
		$active_shows_perday = array(
	      'post_type' => 'show',
	      'tax_query' => array(
	        array(
	          'taxonomy' => 'days',
	          'field' => 'slug',
	          'terms' => $day
	        )
	       ),
	      'meta_query' => array(
		    array(
		      'key' => 'active_show',
		      'value' => '1',
		      'compare' => '='
		    )
	  	   )
	    );

		array_push($active_shows, new WP_Query($active_shows_perday));

		wp_reset_postdata();		
	}
?>

	<!-- https://codyhouse.co/gem/schedule-template/ -->

	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri().'/public/css/schedule.css';?>">

	<div class="cd-schedule loading">
		<div class="timeline">
			<ul>
				<li><span>07:00</span></li>
				<li><span>07:30</span></li>
				<li><span>08:00</span></li>
				<li><span>08:30</span></li>
				<li><span>09:00</span></li>
				<li><span>09:30</span></li>
				<li><span>10:00</span></li>
				<li><span>10:30</span></li>
				<li><span>11:00</span></li>
				<li><span>11:30</span></li>
				<li><span>12:00</span></li>
				<li><span>12:30</span></li>
				<li><span>13:00</span></li>
				<li><span>13:30</span></li>
				<li><span>14:00</span></li>
				<li><span>14:30</span></li>
				<li><span>15:00</span></li>
				<li><span>15:30</span></li>
				<li><span>16:00</span></li>
				<li><span>16:30</span></li>
				<li><span>17:00</span></li>
				<li><span>17:30</span></li>
				<li><span>18:00</span></li>
				<li><span>18:30</span></li>
				<li><span>19:00</span></li>
				<li><span>19:30</span></li>
				<li><span>20:00</span></li>
				<li><span>20:30</span></li>
				<li><span>21:00</span></li>
				<li><span>21:30</span></li>
				<li><span>22:00</span></li>
				<li><span>22:30</span></li>
				<li><span>23:00</span></li>
				<li><span>23:30</span></li>

			</ul>
		</div>

		<div class="events">
			<ul>
				<?php
					foreach($active_shows as $day_query):
				?>
				<li class="events-group">
					<div class="top-info"><span><?php echo $days[$day_count++]; ?></span></div>

					<ul>
					<?php while ( $day_query->have_posts() ): 
						$day_query->the_post();
						$start_time = date('G:i', get_post_meta( $day_query->post->ID, 'start_time', true ));
						$end_time = date('G:i', get_post_meta( $day_query->post->ID, 'end_time', true ));
						$term = genre_type($day_query->post);
						$show_title = get_the_title();

						?>
						<li class="single-event" data-start="<?php echo $start_time?>" data-end="<?php echo $end_time?>" 
						data-content="event-<?php echo $show_title ?>" data-event="event-<?php echo $term->slug ?>">
							<a href="#0">
								<em class="event-name"><?php echo $show_title ?></em>
							</a>
							<div class="hidden" data-target="event-<?php echo get_the_ID() ?>" >
								<div class="dj-heading">DJ: <?php echo get_the_author(); ?></div>
								<div class="show-about"><?php echo get_the_content(); ?></div>
							</div>
						</li>

					<?php endwhile; ?>
					</ul>
				</li>
				<?php endforeach; ?>
			</ul>
		</div>

		<div class="event-modal">
			<header class="header">
				<div class="content">
					<span class="event-date"></span>
					<h3 class="event-name"></h3>
				</div>

				<div class="header-bg"></div>
			</header>

			<div class="body">
				<div class="event-info"></div>
				<div class="body-bg"></div>
			</div>

			<a href="#0" class="close">Close</a>
		</div>

		<div class="cover-layer"></div>
	</div>

<script src="<?php echo get_template_directory_uri().'/public/js/modernizr.js';?>"></script>
<script src="<?php echo get_template_directory_uri().'/public/js/schedule.js';?>"></script>

<?php wp_reset_postdata(); ?>


