<?php
/** whpk redesign
 * David Woldenberg 2018
 *
 * footer.php cloooosing time
 * https://www.youtube.com/watch?v=xGytDsqkQY8
 *
 * @author David Woldenberg
 * @package WordPress
 * @subpackage whpk_redesign
 * @since whpk redesign 1.0
 **/

  if ( !is_home() ) {
      ?>

      <div class="footer">
          <div class="side main-list">
              <div class="foot about">about</div>
              <div class="foot contact">contact</div>
              <div class="foot social">social</div>
          </div>
          <div class="side other-list">
              <img class="foot bot-pic" src="guitar-dude-crop.jpg">
              <div class="foot sttmnt">some stuff you might want to say</div>
          </div>
      </div>
      <?php
  }

  wp_footer(); ?>

    </body>
</html>