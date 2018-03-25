<?php
/** 
 * whpk_redesign
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
	wp_enqueue_script("real_jquery", "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js", false);
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
		$errors->add('staff_position_error', __( '<strong>ERROR</strong>: Please enter your role.', 'whpk-redesign'));
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

/** Adding show post types**/
 
function show_post_type() {
 
// Set UI labels for Custom Post Type
    $labels = array(
        'name'                => _x( 'Shows', 'Post Type General Name', 'whpk-redesign' ),
        'singular_name'       => _x( 'Show', 'Post Type Singular Name', 'whpk-redesign' ),
        'menu_name'           => __( 'Shows', 'whpk-redesign' ),
        'parent_item_colon'   => __( 'Parent Show', 'whpk-redesign' ),
        'all_items'           => __( 'All Shows', 'whpk-redesign' ),
        'view_item'           => __( 'View Show', 'whpk-redesign' ),
        'add_new_item'        => __( 'Add New Show', 'whpk-redesign' ),
        'add_new'             => __( 'Add New', 'whpk-redesign' ),
        'edit_item'           => __( 'Edit Show', 'whpk-redesign' ),
        'update_item'         => __( 'Update Show', 'whpk-redesign' ),
        'search_items'        => __( 'Search Shows', 'whpk-redesign' ),
        'not_found'           => __( 'Show Not Found', 'whpk-redesign' ),
        'not_found_in_trash'  => __( 'Show not found in Trash', 'whpk-redesign' ),
    );
     
// Set other options for Custom Post Type
     
    $args = array(
        'label'               => __( 'show', 'whpk-redesign' ),
        'description'         => __( 'Radio Shows and Descriptions', 'whpk-redesign' ),
        'labels'              => $labels,
        // Features this CPT supports in Post Editor
        'supports'            => array( 'title', 'editor', 'author', 'thumbnail', 'revisions'),
        // You can associate this CPT with a taxonomy or custom taxonomy. 
        'taxonomies'          => array( 'genres', 'days'),
        /* A hierarchical CPT is like Pages and can have
        * Parent and child items. A non-hierarchical CPT
        * is like Posts.
        */ 
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'page',
    );
     
    // Registering your Custom Post Type
    register_post_type('show', $args );
 
}
 
add_action( 'init', 'show_post_type', 0 );

/** Custom Genre + Day Taxonomy **/
 
add_action( 'init', 'create_genre_taxonomy', 0 );
add_action( 'init', 'create_day_taxonomy', 0 );
 
function create_genre_taxonomy() {
 
  $labels = array(
    'name' => _x( 'Genres', 'taxonomy general name' ),
    'singular_name' => _x( 'Genre', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Genres' ),
    'popular_items' => __( 'Popular Genres' ),
    'all_items' => __( 'All Genres' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit Genre' ), 
    'update_item' => __( 'Update Genre' ),
    'add_new_item' => __( 'Add New Genre' ),
    'new_item_name' => __( 'New Genre Name' ),
    'separate_items_with_commas' => __( 'Separate Genres with commas' ),
    'add_or_remove_items' => __( 'Add or remove Genres' ),
    'choose_from_most_used' => __( 'Choose from the most used Genres' ),
    'menu_name' => __( 'Genre' ),
  ); 

 
  register_taxonomy('genres','show',array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'genre' ),
  ));
}

function create_day_taxonomy() {
 
  $labels = array(
    'name' => _x( 'Days', 'taxonomy general name' ),
    'singular_name' => _x( 'Day', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Days' ),
    'popular_items' => __( 'Popular Days' ),
    'all_items' => __( 'All Days' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit Day' ), 
    'update_item' => __( 'Update Day' ),
    'add_new_item' => __( 'Add New Day' ),
    'new_item_name' => __( 'New Day Name' ),
    'separate_items_with_commas' => __( 'Separate Days with commas' ),
    'add_or_remove_items' => __( 'Add or remove Days' ),
    'choose_from_most_used' => __( 'Choose from the most used Days' ),
    'menu_name' => __( 'Day' ),
  ); 

 
  register_taxonomy('days','show',array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'day' ),
  ));
}

/** Creating meta Boxs for show campaigns **/

add_action( 'add_meta_boxes', 'campaign_box' );
function campaign_box() {
    add_meta_box( 
        'campaign_box',
        __( 'Show Information', 'whpk-redesign' ),
        'campaign_content',
        'show',
        'side',
        'high'
    );
}

function campaign_content( $post ) {
  wp_nonce_field( plugin_basename( __FILE__ ), 'campaign_nonce' );

  $start_t = date('G:i', get_post_meta($post->ID, 'start_time', true));
  $end_t   = date('G:i', get_post_meta($post->ID, 'end_time', true));
  $active  = get_post_meta($post->ID, 'active_show', true);

  ?>
  	<label for="start_time">Start time (24 hours)</label>
  	<input type="text" id="start_time" name="start_time" placeholder="ex.) 3:22" value="<?php echo $start_t?>"/>
  	<br>
  	<label for="end_time">End time (24 hours)</label>
  	<input type="text" id="end_time" name="end_time" placeholder="ex.) 18:00" value="<?php echo $end_t?>"/>
  	<br>
  	<label for="active_show">Active (yes or no)</label>
  	<input type="text" id="active_show" name="active_show" placeholder="yes or no" value="<?php echo (($active)?'yes':'no');?>"/>
  <?php
}

add_action( 'save_post', 'campaign_save' );
function campaign_save( $post_id ) {

  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
  return;

  if ( !wp_verify_nonce( $_POST['campaign_nonce'], plugin_basename( __FILE__ ) ) )
  return;

  if ( 'page' == $_POST['post_type'] ) {
    if ( !current_user_can( 'edit_page', $post_id ) )
    return;
  } else {
    if ( !current_user_can( 'edit_post', $post_id ) )
    return;
  }

  $start_t = strtotime($_POST['start_time']);
  $end_t   = strtotime($_POST['end_time']);

  $active_valid = 0;
  $active  = $_POST['active_show'];
  if($active == "yes" || $active == "no"){
  	$active_valid = 1;
  }

  if($end_t == "" || $start_t == "" || $active_valid == 0){
  	return;
  } else {
  	update_post_meta( $post_id, 'start_time', $start_t);
  	update_post_meta( $post_id, 'end_time', $end_t);
  	update_post_meta( $post_id, 'active_show', (($active == "yes")?1:0));
  }
}

/* validate the times */
add_action('wp_print_scripts','my_publish_admin_hook');

function my_publish_admin_hook(){
if (is_admin()){
        ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script language="javascript" type="text/javascript">
            jQuery(document).ready(function() {
            	function enableSub() {
            		jQuery('#publish').removeClass('button-primary-disabled');
            	}

            	$('#start_time').change(enableSub);
            	$('#end_time').change(enableSub);

                jQuery('#post').submit(function() {

                    var form_data = jQuery('#post').serializeArray();
                    form_data = jQuery.param(form_data);
                    var data = {
                        action: 'my_pre_submit_validation',
                        security: '<?php echo wp_create_nonce( 'pre_publish_validation' ); ?>',
                        form_data: form_data
                    };
                    jQuery.post(ajaxurl, data, function(response) {
                        if (response.indexOf('True') > -1 || response.indexOf('true') > -1) {
                            return true;
                        }else{
                            alert("please correct the following errors: " + response);
                            jQuery('#publish').addClass('button-primary-disabled');
                            return false;
                        }
                    });
                });
            });
        </script>
        <?php
    }
}

add_action('wp_ajax_my_pre_submit_validation', 'pre_submit_validation');
function pre_submit_validation(){
    //simple Security check
    check_ajax_referer( 'pre_publish_validation', 'security' );

    $form_data = array();
    parse_str($_POST['form_data'], $form_data);

    if(get_post_type($form_data['post_ID']) == 'show'){
	  	$start_t = strtotime($form_data['start_time']);
	  	$end_t   = strtotime($form_data['end_time']);

	  	$active_valid = 0;

	  	$active  = $form_data['active_show'];

	  	if($active == "yes" || $active == "no"){
	  		$active_valid = 1;
	  	}

    	if($start_t == ""){
    		echo 'please enter a valid start time';
    		die();
    	}

    	if ($end_t == "") {
			echo 'please enter a valid end time';
			die();
    	}

    	if($end_t < $start_t) {
    		echo 'end time cannot be before start time';
    		die();
    	}

    	if($active_valid == 0){
    		echo 'please enter yes or no in the "active show" field';
    		die();
    	}

    	echo 'true';
    	die();
    } else {
    	echo 'true';
    	die();
    }
}

/** Function to determine Genre type **/

function genre_type($post) {
	$terms = get_terms([
	    'taxonomy' => $taxonomy,
	    'hide_empty' => true,
	]);

	if  ($terms) {
	  foreach ($terms  as $term ) {
	    if(has_term($term->name, "genres", $post)){
	    	return $term;
	    }
	  }
	}
	return "not found";
}


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

function isValidTimeStamp($timestamp)
{
    return ((string) (int) $timestamp === $timestamp) 
        && ($timestamp <= PHP_INT_MAX)
        && ($timestamp >= ~PHP_INT_MAX);
}
?>