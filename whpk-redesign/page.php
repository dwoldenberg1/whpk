<?php
/** whpk_redesign
 *
 * page.php
 * Default template for all pages being called 
 * (custom definitions in 'templates/pages/[filename]')
 *
 * @author David Woldenberg
 * @package WordPress
 * @subpackage whpk_redesign
 * @since whpk redesign 1.0
 **/

get_header(); ?>

<div class="main" >
	<?php
	while ( have_posts() ) : the_post();

		get_template_part( 'template-parts/page/'.$pagename);

	endwhile; // End of the loop.
	?>

</div>

<?php get_footer(); ?>