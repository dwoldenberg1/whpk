<?php
/** whpk redesign
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

?>

<div class="navbar">
  <div class="nav schedule">
    <a href="<?php get_template_directory_uri().'/schedule'?>">Schedule</a>
  </div>
  <div class="nav events">
    <a href="<?php get_template_directory_uri().'/events'?>">Events</a>
  </div>
  <div class="nav about">
    <a href="<?php get_template_directory_uri().'/about'?>">About</a>
  </div>
  <div class="nav contact">
    <a href="<?php get_template_directory_uri().'/contact'?>">Contact</a>
  </div>
  <div class="nav donate">
    <a href="<?php get_template_directory_uri().'/dontae'?>">Donate</a>
  </div>
  <div class="nav merch">
    <a href="<?php get_template_directory_uri().'/merch'?>">Merch</a>
  </div>
</div>

