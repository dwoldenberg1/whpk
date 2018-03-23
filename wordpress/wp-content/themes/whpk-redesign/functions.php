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

function whpk_setup() {
	/* linked scripts/css */
	add_action( 'wp_enqueue_scripts', 'themeslug_enqueue_script' );
	add_action( 'wp_enqueue_scripts', 'themeslug_enqueue_style' );

	/* In line scripts/css */
	add_action('wp_head', 'hook_css');
	add_action('wp_head', 'hook_js');

	add_action('wp_head', 'hook_headers');

	$path = get_home_url();
}
add_action( 'after_setup_theme', 'whpk_setup' );

function themeslug_enqueue_style() {
	wp_enqueue_style('core', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css', false);
	wp_enqueue_style('core-style', get_stylesheet_uri());
}

function themeslug_enqueue_script() {
	wp_enqueue_script("jquery");
	wp_enqueue_script('boostrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js', false);
	wp_enqueue_script('fontawesome', 'https://use.fontawesome.com/releases/v5.0.7/js/all.js', false);
	wp_enqueue_script('functions', get_template_directory_uri().'/public/js/function.js', false);
}

function hook_css() {
}

function hook_js() {
	?>
	<script type="text/javascript">
		jQuery(document).ready(function( $ ) {
			//GA stuff eventually
		});
	</script>
	<?php
}

function wpcf_is_404( $url = null ){
    $code = '';
    if( is_null( $url ) ){
        return false;
    }else{
        $handle = curl_init($url);
        curl_setopt($handle,  CURLOPT_RETURNTRANSFER, TRUE);
        curl_exec($handle);
        $code = curl_getinfo($handle, CURLINFO_HTTP_CODE);
        if( $code == '404' ){
            return true;
        }else{
            return false;
        }
        curl_close($handle);
    }
}
?>