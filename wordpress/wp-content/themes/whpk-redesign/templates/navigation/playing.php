<?php
/** 
 * whpk redesign
 * David Woldenberg 2018
 *
 * playing.php template page for the now playing widget
 *
 * @author David Woldenberg
 * @package WordPress
 * @subpackage whpk_redesign
 * @since whpk redesign 1.0
 **/
	date_default_timezone_set('America/Chicago');

	$now = (intval(date('G')) * 60) + intval(date('i'));
	$day_now = date('l');

	date_default_timezone_set('GMT');

	$active_shows_today = array(
      'post_type' => 'show',
      'nopaging' => true,
      'tax_query' => array(
        array(
          'taxonomy' => 'days',
          'field' => 'slug',
          'terms' => $day_now
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

    $show = "no shows today";
    $dj = "";
    $genre = "";

    $active_shows = new WP_Query($active_shows_today);
    if($active_shows->have_posts()){
    	$show = "no shows left today";

	    while ( $active_shows->have_posts() ) {
	    	$active_shows->the_post();

	    	$start_t = get_post_meta( $active_shows->post->ID, 'start_time', true );
	    	$end_t   = get_post_meta( $active_shows->post->ID, 'end_time', true );

	    	$start = (intval(date('G', $start_t)) * 60) + intval(date('i', $start_t));
	    	$end   = (intval(date('G', $end_t)) * 60) + intval(date('i', $end_t));

	    	if($now >= $start && $now <= $end){
	    		$term = genre_type($day_query->post);

	    		$show  = "Now Playing: ".get_the_title();
	    		$genre    = "Genre: ".get_the_author();
	    		$dj = "DJ: ".$term->name;

	    		break;
	    	}
	    }
	}

?>

<div class="playing playing-open playing-transition">
	<div class="toggle-arrow">
		<i class="fa fa-arrow-circle-right" style="font-size:24px"></i>
	</div>
	<div class="now-show"><?php echo $show; ?></div>
	<div class="now-genre"><?php echo $genre; ?></div>
	<div class="now-dj"><?php echo $dj; ?></div>
</div>