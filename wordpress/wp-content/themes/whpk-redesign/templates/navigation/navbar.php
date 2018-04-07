<?php
/** 
 * whpk redesign
 * David Woldenberg 2018
 *
 * navbar.php
 * Code for the static navbar (not making this dynamic 
 * because it doesn't really seem necessary in v0)
 *
 * @author David Woldenberg
 * @package WordPress
 * @subpackage whpk_redesign
 * @since whpk redesign 1.0
 **/


  $path = get_site_url();
  error_log("path: ".$path, 0);
?>

<div class="navbar">
  <div class="nav mobile">
    <div id="bar-listen">
      <h1 id="listen-item-bar" class="bar-listen">LISTEN</h1>
      <img id="mega-bar" class="mega bar-listen" src="<?php echo get_template_directory_uri().'/public/img/megaphone.svg'; ?>">
    </div>
    <div class="ham">
      <div class="ham1"></div>
      <div class="ham2"></div>
      <div class="ham3"></div>
    </div>
  </div>
  <div class="nav collapsed schedule">
    <a class="nav-item" href="<?php echo $path.'/wordpress/schedule'; ?>">Schedule</a>
  </div>
  <div class="nav collapsed events">
    <a class="nav-item" href="<?php echo $path.'/wordpress/events'; ?>">Events</a>
  </div>
  <div class="nav collapsed about">
    <a class="nav-item" href="<?php echo $path.'/wordpress/about'; ?>">About</a>
  </div>
  <div class="nav collapsed contact">
    <a class="nav-item" href="<?php echo $path.'/wordpress/contact'; ?>">Contact</a>
  </div>
  <div class="nav collapsed donate">
    <a class="nav-item" href="<?php echo $path.'/wordpress/donate'; ?>">Donate</a>
  </div>
  <div class="nav collapsed merch">
    <a class="nav-item" href="<?php echo $path.'wordpress/merch'; ?>">Merch</a>
  </div>
</div>

