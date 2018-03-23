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
              <div class="foot about">
                <a href="<?php echo $path.'/wordpress/about'; ?>">about</a>
              </div>
              <div class="foot contact">
                <a href="<?php echo $path.'/wordpress/contact'; ?>">contact</a>
              </div>
              <div class="foot social">
                <?php get_template_part('templates/navigation/social'); ?>
              </div>
          </div>
          <div class="side other-list">
              <img class="foot bot-pic" src="<?php echo get_template_directory_uri().'/public/img/guitar-dude-crop.jpg'; ?>">
              <div class="foot sttmnt">some stuff you might want to say</div>
          </div>
      </div>
      <?php
  }

  wp_footer(); ?>

    </body>
</html>