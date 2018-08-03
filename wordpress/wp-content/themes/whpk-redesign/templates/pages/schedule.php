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
	$formats = array();

	foreach($days as $day){
		$active_shows_perday = array(
	      'post_type' => 'show',
	      'nopaging' => true,
	      'meta_key' => 'start_time',
          'orderby' => 'meta_value_num',
          'order' => 'ASC',
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

	//get_theme_mod( 'schedule-selected' ); == 0 for default, == 1 for break schedule
?>

	<!-- https://codyhouse.co/gem/schedule-template/ -->

	<div class="legend">
	<?php
		$val = 1; 
		$terms = get_terms('genres');
		foreach ( $terms as $term):
			if($term->description != "inactive"):
				$formats[$term->slug] = $val;
		?>
		<div class="legend-box format-<?php echo $val++; ?>">
			<span><?php echo (($term->slug == "international")?"Inter-national":$term->name); ?></span>
		</div>
	<?php endif; endforeach; ?>
	</div>

	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri().'/public/css/schedule.css';?>">

	<div class="alter-msg">* indicates that the show is alternating</div>
	<div class="cd-schedule loading">
		<div class="timeline">
				<?php
					$sched = get_theme_mod('schedule-select');
					$is_cust_sched = get_theme_mod('custom-schedule');
					$cust_start = get_theme_mod('custom-schedule-start');
					$cust_end = get_theme_mod('custom-schedule-end');

					$start = 7;
					$end = 24;

					if($is_cust_sched == 1){
						$start = $cust_start;
						$end = $cust_end;
					} else {
						$vals = explode("-", $sched);
						$start = $vals[0];
						$end = $vals[1];
					}
			?>
			<ul data-val='<?php echo $end - $start; ?>'>
				<?php
					for(; $start < $end; $start++) {
						$val = ($start < 10) ? "0".$start : $start;
						echo "<li><span>".$val.":00</span></li>";
						echo "<li><span>".$val.":30</span></li>";
					}
				?>
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
						$end_time = (($end_time == "0:00")?"24:00":$end_time); //correct for 24:00 = 0:00
						$djs = unserialize(get_post_meta($day_query->post->ID, 'djs', true));
						$post_hasalter = get_post_meta($day_query->post->ID, 'alter_show', true);

						$term = genre_type($day_query->post);
						$show_title = get_the_title();
						$content = get_the_content();

						$alter = 0;
						$next_p = 0;

						if(isset($post_hasalter) && $post_hasalter == 1){
							$alter = 1;

							$next_q = $day_query->posts[$day_query->current_post + 1];
							$next_p = get_post_meta($next_q->ID, 'alter_show', true);

							if($day_query->have_posts()){
								if ($next_p == 1){
									$day_query->the_post();

									$djs2 = unserialize(get_post_meta($post->ID, 'djs', true));
									$term2 = genre_type($day_query->post);
									$show_title2 = get_the_title();

									$content2 = get_the_content();
								} else {
									$alter = 0;
								}
							} else {
								$alter = 0;
								break;
							}
						}

						?>
						<li class="single-event" data-start="<?php echo $start_time?>" data-end="<?php echo $end_time?>" 
						data-content="event-<?php echo $show_title ?>" data-event="event-<?php echo $formats[$term->slug]; ?>">
							<a href="#0">
								<em class="event-name"><?php 
									echo ($alter)?("<b>*</b> ".$show_title."<br><span class='alter'>alternating with</span><br>".$show_title2):$show_title;
								?></em>
							</a>
							<div class="hidden" data-target="event-<?php echo get_the_ID() ?>" >
								<div class="dj-heading"><?php
									$djs_string = implode(",", $djs); 
									echo ((sizeof($djs) > 1 || $alter)?"DJs: ":"DJ: ");
									echo ($alter)?(implode(", ", $djs)."<span class='alter'> or </span>".implode(", ", $djs2)):implode(", ", $djs); 
								?></div>
								<div class="show-about"><?php 
									$content = ($content == ""?"No Description":$content);
									$content2 = ($content2 == ""?"No Description":$content2);
									echo ($alter)?($content."<br><span class='alter'>alternating with</span><br>".$content2):$content;
								?></div>
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

<script>
	var playing = "event-" + $('.playing').attr("data-content");
	$('[data-content="'+ playing + '"]').css("border", "2px red solid").css("z-index", "101").css("overflow", "hidden");;
</script>

<script src="<?php echo get_template_directory_uri().'/public/js/modernizr.js';?>"></script>
<script src="<?php echo get_template_directory_uri().'/public/js/schedule.js';?>"></script>

<?php wp_reset_postdata(); ?>


