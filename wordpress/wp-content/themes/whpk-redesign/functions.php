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

/** Wordpress set up **/

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
	wp_enqueue_style('core-style', get_stylesheet_uri());
}

function themeslug_enqueue_script() {
	wp_enqueue_script("jquery");
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

/** Adding Role for User IDs **/

function custom_fields($user) {
	$pos = get_the_author_meta( 'staff_position', $user->ID );

	?>
	<table class="form-table">
		<tr class="form-field form-required">
			<th><label for="staff_position"><?php esc_html_e( 'Staff Position' ); ?><i> (required)</i></label></th>
			<td>
				<input type="text"
			       id="staff_position"
			       name="staff_position"
			       placeholder="ex.) dj"
			       value="<?php echo esc_attr($pos); ?>";
			       class="regular-text"
				/>
			</td>
		</tr>
	</table>
	<?php
}

add_action( 'show_user_profile', 'custom_fields' );
add_action( 'edit_user_profile', 'custom_fields' );
add_action( "user_new_form", "custom_fields" );

function custom_edit_errors( $errors, $update, $user ) {
	if ( ! $update ) {
		return;
	}

	if ( empty( $_POST['staff_position'] ) ) {
		$errors->add('staff_position_error', __( '<strong>ERROR</strong>: Please enter your role.', 'crf'));
	}
}

add_action('user_profile_update_errors', 'custom_edit_errors', 10, 3);

function custom_update_profile_fields( $user_id ) {
	if ( ! current_user_can( 'edit_user', $user_id ) ) {
		return false;
	}

	if ( ! empty( $_POST['staff_position'] ) ) {
		update_user_meta( $user_id, 'staff_position', $_POST['staff_position'] );
	}
}

add_action('personal_options_update', 'custom_update_profile_fields');
add_action('edit_user_profile_update', 'custom_update_profile_fields');
add_action('user_register', 'custom_update_profile_fields');
add_action('profile_update', 'custom_update_profile_fields');

/** Misc Functions **/

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