<?php
/** 
 * whpk redesign
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
            <div class="first-list">
                <div class="foot about">
                  <a href="<?php echo $path.'/wordpress/about'; ?>">about</a>
                </div>
                <div class="foot contact">
                  <a href="<?php echo $path.'/wordpress/contact'; ?>">contact</a>
                </div>
                <div class="foot social">
                  <?php get_template_part('templates/navigation/social'); ?>
                </div>
                <div class="foot cprt">
                  © 2018 WHPK
                </div>
              </div>
              <div class="side other-list">
                  <div class="foot sttmnt">
                    <div>
                      <a href="http://www.google.com/maps?q=5706+S+University+Ave,+Chicago,+IL+60637,+USA&ie=UTF8&z=16&iwloc=addr&om=1" target="_blank"> 
                        Reynolds Club, 5706 S. University Ave. <br> Chicago, IL 60637
                      </a>
                    </div>
                    <div>
                      office: 773-702-8289
                    </div>
                    <div>
                      studio: 773-702-8424
                    </div>
                  </div>
              </div>
              <div>
                  <img class="foot bot-pic" src="<?php echo get_template_directory_uri().'/public/img/guitar-dude-crop.jpg'; ?>">
              </div>
          </div>     
      </div>
      <?php
  }

  wp_footer(); ?>

    </body>
</html>