<?php
/** 
 * whpk_redesign
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

<div class="space-taker">

	<?php 	get_template_part('templates/headers/header'); 
			get_template_part('templates/navigation/navbar'); 
	?>
</div>

<div class="main">
	<script>
		jQuery('.' + "<?php echo $pagename ?>").addClass("active");
	</script>


	<?php get_template_part('templates/pages/'.$pagename); ?>

</div>

<?php get_footer(); ?>