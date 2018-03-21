<?php
/** whpk redesign
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

?>
<!DOCTYPE html>

<head <?php language_attributes(); ?>>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>whpk - Home</title>

	<?php wp_head(); ?>
</head>
<body>
	<div class="contact-icons">
      	<a href="http://www.facebook.com/whpk885/" target="_blank"><i class="fab fa-facebook-square"></i></a>
      	<a href="http://twitter.com/whpk_chicago?lang=en" target="_blank"><i class="fab fa-twitter-square"></i></a>
	</div>
	<div class="display-cont">
	      <video class="video-cont" autoplay muted loop>
	      	<source src="whpk.mp4" type="video/mp4">
	      </video>

	</div>
	<div class="sticky-cont">
		<div class="topbar">
			<a class="main-back" href="index.html">
				<img class="top whpk-logo" src="logo.png">
				<div class="top masthead">
					<div class="top station-info">88.5 FM Chicago</div>
					<div class="top slogan-info">The Pride of the South Side</div>
				</div>
			</a>
			<div class="top listen">
				<h1 id="listen-item">LISTEN</h1>
				<img id="mega" src="megaphone.svg">
				<audio id="whpk-play" src="http://www.whpk.org:8000/mp3" autoplay></audio>
			</div>
		</div>
		<div class="navbar">
			<div class="nav schedule">
				<a href="schedule.html">Schedule</a>
			</div>
			<div class="nav events">
				<a href="events.html">Events</a>
			</div>
			<div class="nav about">
				<a href="about.html">About</a>
			</div>
			<div class="nav contact">
				<a href="contact.html">Contact</a>
			</div>
			<div class="nav donate">
				<a href="donate.html">Donate</a>
			</div>
			<div class="nav merch">
				<a href="merch.html">Merch</a>
			</div>
		</div>
	</div>