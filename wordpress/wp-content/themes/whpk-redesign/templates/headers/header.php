<?php
/** whpk redesign
 * David Woldenberg 2018
 *
 * hedear.php
 * Code for the top bar (including masthead), etc.
 *
 * @author David Woldenberg
 * @package WordPress
 * @subpackage whpk_redesign
 * @since whpk redesign 1.0
 **/

?>

<div class="topbar">
  <a class="main-back" href="<?php echo $path.'/wordpress';?>">
    <img class="top whpk-logo" src="<?php echo get_template_directory_uri().'/public/img/logo.png';?>">
    <div class="top masthead">
      <div class="top station-info">88.5 FM Chicago</div>
      <div class="top slogan-info">The Pride of the South Side</div>
    </div>
  </a>
  <div class="top listen">
    <h1 id="listen-item">LISTEN</h1>
    <img id="mega" src="<?php echo get_template_directory_uri().'/public/img/megaphone.svg'; ?>">
    <audio id="whpk-play" src="http://www.whpk.org:8000/mp3" autoplay></audio>
  </div>
</div>