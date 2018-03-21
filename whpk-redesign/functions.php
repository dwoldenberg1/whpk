<?php
/** whpk_redesign
 *
 * functions.php lots of site functionality and stuff
 *
 * @author David Woldenberg
 * @package WordPress
 * @subpackage whpk_redesign
 * @since whpk redesign 1.0
 **/

function whpk_setup {
	/* linked scripts/css */
	add_action( 'wp_enqueue_scripts', 'themeslug_enqueue_style' );
	add_action( 'wp_enqueue_scripts', 'themeslug_enqueue_script' );

	/* In line scripts/css */
	add_action('wp_head', 'hook_css');
	add_action('wp_head', 'hook_js');

	add_action('wp_head', 'hook_headers');
}
add_action( 'after_setup_theme', 'whpk_setup' );

function themeslug_enqueue_style() {
	wp_enqueue_style('core', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css', false);
	wp_enqueue_style( 'core', 'style.css', false );
}

function themeslug_enqueue_script() {
	wp_enqueue_style('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js', false);
	wp_enqueue_script('boostrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js' false);
	wp_enqueue_script('functions', get_template_directory_uri(). '/public/js/function.js', false);
	
	<script type="text/javascript" src="function.js" ></script>
	<script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>

	wp_enqueue_script( 'my-js', 'filename.js', false );
}

function hook_css {

}

function hook_js {
	?>
	<script type="text/javascript">
		$(function(){
			//GA stuff eventually
		});
	</script>
	<?php
}

function hook_headers {

}

?>