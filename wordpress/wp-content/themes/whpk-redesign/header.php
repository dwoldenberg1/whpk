<?php
/** 
 * whpk redesign
 * David Woldenberg 2018
 *
 * hedear.php
 * responsible for setting the html hedears and the navbar, the body, 
 * and the navbar (constants to every page)
 *
 * @author David Woldenberg
 * @package WordPress
 * @subpackage whpk_redesign
 * @since whpk redesign 1.0
 **/

$page_title = (isset($GLOBALS["page_title"]))?$GLOBALS["page_title"]:$pagename; 

?>
<!DOCTYPE html>

<head <?php language_attributes(); ?>>
	<link rel="shortcut icon" href="<?php echo get_home_url(); ?>/favicon.ico" />

	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>whpk - <?php echo $page_title ?></title>

	<?php 
		wp_head();
		wp_enqueue_scripts()
	 ?>
</head>
<body>
	<div class="msg-ann">WHPK WILL BE OFF-AIR 6/9-6/10. We apologize for the inconvenience, and do please tune back in on Monday.</div>

	<div class="sticky-cont">
		<audio id="whpk-play" src="http://www.whpk.org:8000/mp3" autoplay></audio>
		<?php 	get_template_part('templates/headers/header'); 
				get_template_part('templates/navigation/navbar'); 
		?>		
	</div>
