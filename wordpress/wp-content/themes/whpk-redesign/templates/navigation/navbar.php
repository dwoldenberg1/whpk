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
    <a href="<?php echo $path.'/wordpress/schedule'; ?>">Schedule</a>
  </div>
  <div class="nav events">
    <a href="<?php echo $path.'/wordpress/events'; ?>">Events</a>
  </div>
  <div class="nav about">
    <a href="<?php echo $path.'/wordpress/about'; ?>">About</a>
  </div>
  <div class="nav contact">
    <a href="<?php echo $path.'/wordpress/contact'; ?>">Contact</a>
  </div>
  <div class="nav donate">
    <a href="<?php echo $path.'/wordpress/donate'; ?>">Donate</a>
  </div>
  <div class="nav merch">
    <a href="<?php echo $path.'wordpress/merch'; ?>">Merch</a>
  </div>
</div>

