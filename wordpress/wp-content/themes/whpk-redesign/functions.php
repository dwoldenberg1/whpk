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

	$path = $path = get_site_url();
}
add_action( 'after_setup_theme', 'whpk_setup' );

function themeslug_enqueue_style() {
	wp_enqueue_style('core-style', get_stylesheet_uri());
  wp_enqueue_style('montserrat-font', "https://fonts.googleapis.com/css?family=Montserrat:400,400i,700,700i");
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
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-120012177-1"></script>
	<script type="text/javascript">
		jQuery(document).ready(function( $ ) {
			//GA Stuff
			window.dataLayer = window.dataLayer || [];
  			function gtag(){dataLayer.push(arguments);}
  			gtag('js', new Date());

  			gtag('config', 'UA-120012177-1');
		});
	</script>
	<?php
}

/** Thumbnails **/

add_theme_support( 'post-thumbnails' );

add_action( 'do_meta_boxes', 'remove_thumbnail_box' );

function remove_thumbnail_box() {
    remove_meta_box( 'postimagediv', 'show', 'side' );
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

/** Adding event post types **/

function event_post_type() {
 
// Set UI labels for Custom Post Type
    $labels = array(
        'name'                => _x( 'Events', 'Post Type General Name', 'whpk-redesign' ),
        'singular_name'       => _x( 'Event', 'Post Type Singular Name', 'whpk-redesign' ),
        'menu_name'           => __( 'Events', 'whpk-redesign' ),
        'parent_item_colon'   => __( 'Parent Event', 'whpk-redesign' ),
        'all_items'           => __( 'All Events', 'whpk-redesign' ),
        'view_item'           => __( 'View Event', 'whpk-redesign' ),
        'add_new_item'        => __( 'Add New Event', 'whpk-redesign' ),
        'add_new'             => __( 'Add New', 'whpk-redesign' ),
        'edit_item'           => __( 'Edit Event', 'whpk-redesign' ),
        'update_item'         => __( 'Update Event', 'whpk-redesign' ),
        'search_items'        => __( 'Search Events', 'whpk-redesign' ),
        'not_found'           => __( 'Event Not Found', 'whpk-redesign' ),
        'not_found_in_trash'  => __( 'Event not found in Trash', 'whpk-redesign' ),
    );
     
// Set other options for Custom Post Type
     
    $args = array(
        'label'               => __( 'Event', 'whpk-redesign' ),
        'description'         => __( 'Events and Descriptions', 'whpk-redesign' ),
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
        'menu_position'       => 6,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'page',
    );
     
    // Registering your Custom Post Type
    register_post_type('event', $args );
 
}
 
add_action( 'init', 'event_post_type', 0 );

/** Custom Genre + Day Taxonomy **/
 
add_action( 'init', 'create_genre_taxonomy', 0 );
add_action( 'init', 'create_day_taxonomy', 0 );
 
function create_genre_taxonomy() {
 
  $labels = array(
    'name' => _x( 'Formats', 'taxonomy general name' ),
    'singular_name' => _x( 'Format', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Formats' ),
    'popular_items' => __( 'Popular Formats' ),
    'all_items' => __( 'All Formats' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit Format' ), 
    'update_item' => __( 'Update Format' ),
    'add_new_item' => __( 'Add New Format' ),
    'new_item_name' => __( 'New Format Name' ),
    'separate_items_with_commas' => __( 'Separate Formats with commas' ),
    'add_or_remove_items' => __( 'Add or remove Formats' ),
    'choose_from_most_used' => __( 'Choose from the most used Formats' ),
    'menu_name' => __( 'Format' ),
  ); 

 
  register_taxonomy('genres',array('show', 'event'),array(
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

 
  register_taxonomy('days',array('show', 'event'),array(
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

add_action( 'add_meta_boxes', 'campaign_box_show' );

function campaign_box_show() {
    add_meta_box( 
        'campaign_box_show',
        __( 'Show Information', 'whpk-redesign' ),
        'campaign_content_show',
        'show',
        'side',
        'high'
    );
}

function campaign_content_show( $post ) {
  wp_nonce_field( plugin_basename( __FILE__ ), 'campaign_nonce' );

  $start_t = date('G:i', get_post_meta($post->ID, 'start_time', true));
  $end_t   = date('G:i', get_post_meta($post->ID, 'end_time', true));
  $end_t   = ($end_t == "0:00" && $start_t != "0:00")?"24:00":$end_t;
  $dj_list = unserialize(get_post_meta($post->ID, 'djs', true));

  $active  = get_post_meta($post->ID, 'active_show', true);
  $alter   = get_post_meta($post->ID, 'alter_show', true);

  ?>
  	<label for="start_time">Start time (24 hours)</label>
  	<input type="text" id="start_time" name="start_time" placeholder="ex.) 3:22" value="<?php echo $start_t?>"/>
  	<br>
  	<label for="end_time">End time (24 hours)</label>
  	<input type="text" id="end_time" name="end_time" placeholder="ex.) 18:00" value="<?php echo $end_t?>"/>
  	<br>
  	<label for="active_show">Active (yes or no)</label>
  	<br>
  	<select id="active_show" name="active_show"/>
  		<option value="yes" <?php echo (($active == 1)?'selected':''); ?>>yes</option>
  		<option value="no" <?php echo (($active == 0)?'selected':''); ?>>no</option>
    </select>
  	<br>
  	<label for="altershow">Alternating (yes or no)</label>
  	<br>
  	<select id="alter_show" name="alter_show"/>
  		<option value="yes" <?php echo (($alter == 1)?'selected':''); ?>>yes</option>
  		<option value="no" <?php echo (($alter  == 0)?'selected':''); ?>>no</option>
    </select>
  	<br>
  	<label for="dj_list">DJs (comma-seperated)</label>
  	<input type="text" id="dj_list" name="dj_list" placeholder="ex.) MF Doom, J5" value="<?php echo implode(",", $dj_list);?>"/>
  <?php
}

add_action( 'save_post', 'campaign_save_show' );
function campaign_save_show( $post_id ) {

  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
  return;

  if ( !wp_verify_nonce( $_POST['campaign_nonce'], plugin_basename( __FILE__ ) ) )
  return;

  if ( 'show' == $_POST['post_type'] ) {
    if ( !current_user_can( 'edit_page', $post_id ) )
    return;
  } else {
    return;
  }

  /* "2007-01-01" is an aribitrary time that was used in the 
   * legacy db needed to proper migration 
   */
  $start_t = strtotime("2007-01-01".$_POST['start_time']);
  $end_t   = strtotime("2007-01-01".$_POST['end_time']);

  $active_valid = 0;
  $active  = $_POST['active_show'];
  if($active == "yes" || $active == "no"){
  	$active_valid = 1;
  }

  $alter_valid = 0;
  $alter  = $_POST['alter_show'];
  if($alter == "yes" || $alter == "no"){
  	$alter_valid = 1;
  }

  $djs_raw = $_POST['dj_list'];
  $djs = explode(",", $djs_raw);

  if($end_t == "" || $start_t == "" || $active_valid == 0 || $alter_valid == 0){
  	return;
  } else {
  	update_post_meta( $post_id, 'start_time', $start_t);
  	update_post_meta( $post_id, 'end_time', $end_t);
  	update_post_meta( $post_id, 'active_show', (($active == "yes")?1:0));
  	update_post_meta( $post_id, 'alter_show', (($alter == "yes")?1:0));
  	update_post_meta( $post_id, 'djs', serialize($djs));
  }
}

/* validate show/event data */
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
	  	$alter_valid  = 0;

	  	$active  = $form_data['active_show'];
	  	$alter   = $form_data['alter_show'];

	  	$djs_raw = $form_data['dj_list'];
  		$djs = explode(",", $djs_raw);

	  	if($active == "yes" || $active == "no"){
	  		$active_valid = 1;
	  	}

	  	if($alter == "yes" || $alter == "no"){
	  		$alter_valid = 1;
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
    		echo 'please enter yes or no in the "Active" field';
    		die();
    	}

    	if($alter_valid == 0){
    		echo 'please enter yes or no in the "Alternating" field';
    		die();
    	}

    	foreach ($djs as $dj) {
    		$user = reset(
  			 get_users(
  			  array(
  			   'meta_key' => 'nickname',
  			   'meta_value' => $dj,
  			   'number' => 1,
  			   'count_total' => false
  			  )
  			 )
  			);

    		if(!$user){
    			echo 'please only enter valid djs, "'.$dj.'" was not valid';
    			die();
    		} 
    	}

    	echo 'true';
    	die();
    } else if (get_post_type($form_data['post_ID']) == 'event') {
      $start_t = strtotime($form_data['start_time']);
      $end_t   = strtotime($form_data['end_time']);

      $location = $form_data['event_location'];

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

      if($location == "") {
        echo 'Please enter a location';
        die();
      }

      echo 'true';
      die();
    } else {
    	echo 'true';
    	die();
    }
}

/** Creating meta Boxs for events **/

add_action( 'add_meta_boxes', 'campaign_box_event' );

function campaign_box_event() {
    add_meta_box( 
        'campaign_box_event',
        __( 'Event Information', 'whpk-redesign' ),
        'campaign_content_event',
        'event',
        'side',
        'high'
    );
}

function campaign_content_event( $post ) {
  wp_nonce_field( plugin_basename( __FILE__ ), 'campaign_nonce' );

  $start_t  = date('Y-n-j G:i', get_post_meta($post->ID, 'start_time', true));
  $end_t    = date('Y-n-j G:i', get_post_meta($post->ID, 'end_time', true));
  $location = get_post_meta($post->ID, 'event_location', true);
  $addr     = get_post_meta($post->ID, 'event_address', true);

  ?>
    <label for="start_time">Start time (Y-M-D H:M)</label>
    <input type="text" id="start_time" name="start_time" placeholder="ex.) 2018-4-20 6:00" value="<?php echo $start_t?>"/>
    <br>
    <label for="end_time">End time (Y-M-D H:M)</label>
    <input type="text" id="end_time" name="end_time" placeholder="ex.) 2018-5-25 6:30" value="<?php echo $end_t?>"/>
    <br>
    <label for="event_location">Location</label>
    <br>
    <input type="text" id="event_location" name="event_location" placeholder="ex.) Reynold's club" value="<?php echo $location?>"/>
    <br>
    <label for="event_address">Address (optional)</label>
    <br>
    <input type="text" id="event_address" name="event_address" placeholder="ex.) 5706 S University Ave, Chicago, IL 60637" value="<?php echo $addr?>"/>
    <br>
  <?php
}

add_action( 'save_post', 'campaign_save_event' );
function campaign_save_event( $post_id ) {

  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
  return;

  if ( !wp_verify_nonce( $_POST['campaign_nonce'], plugin_basename( __FILE__ ) ) )
  return;

  if ( 'event' == $_POST['post_type'] ) {
    if ( !current_user_can( 'edit_page', $post_id ) )
    return;
  } else {
    return;
  }

  $start_t  = strtotime($_POST['start_time']);
  $end_t    = strtotime($_POST['end_time']);
  $location = esc_attr($_POST['event_location']);
  $addr     = esc_attr($_POST['event_address']);

  if($end_t == "" || $start_t == ""){
    return;
  } else {
    update_post_meta( $post_id, 'start_time', $start_t);
    update_post_meta( $post_id, 'end_time', $end_t);
    update_post_meta( $post_id, 'event_location', $location);
    update_post_meta( $post_id, 'event_address', $addr);
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

/* Deprecated, do not use */
function get_genre_val($num) {
	switch($num) {
		case "rock":
			return 1;
			break;
		case "rap":
			return 2;
			break;
		case "jazz":
			return 3;
			break;
		case "electronic":
			return 4;
			break;
		case "international":
			return 5;
			break;
		case "classical":
			return 6;
			break;
		case "folk":
			return 7;
			break;
		case "public-affairs":
			return 8;
			break;
		case "specialty":
			return 9;
			break;
		default:
			return 10;
	}
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

function howdy_message($translated_text, $text, $domain) {
	$new_message = str_replace('Howdy', 'Yo', $text);
	return $new_message;
}
add_filter('gettext', 'howdy_message', 10, 3);

/** Import Shows + DJs (only works on my local environment) **/

if ( isset($_GET['run_my_script']) && ! get_option('my_script_completev17') ) {
	//add_action('init', 'import_djs', 9);
    add_action('init', 'import_shows', 10);
    add_action('init', 'import_shows_done', 20);
}

function import_djs() {
	$olddb = new wpdb(constant("DB_USER"),constant("DB_PASSWORD"),"WHPK_DB",constant("DB_HOST"));

	$sql = "SELECT * FROM djs";
	$rows = $olddb->get_results($sql);

	$test = 0;

	foreach($rows as $obj) {
		$user_id = wp_insert_user ( array(
			'user_login'   => esc_attr(isset($obj->name_dj)?$obj->name_dj:"nemo"),
			'nickname'     => esc_attr(isset($obj->name_dj)?$obj->name_dj:"nemo"),
			'description'  => esc_attr(isset($obj->description_dj)?$obj->description_dj:""),
			'user_email'   => esc_attr($test."@dwold.com"),
			'role'		   => esc_attr(($obj->active_dj == "y")?"author":"subscriber")
		) );

		update_user_meta( $user_id, 'dj_id', $obj->id_dj );
		update_user_meta( $user_id, 'staff_position', "dj" );

		$test++;
	}

	error_log("done with dj script", 0);
	return;
}
 
function import_shows() {
    $olddb = new wpdb(constant("DB_USER"),constant("DB_PASSWORD"),"WHPK_DB",constant("DB_HOST"));

	$sql = "SELECT * FROM shows";
	$rows = $olddb->get_results($sql);

	$test = 0;

	foreach($rows as $obj) {
		$djs = array();
		$djss = "";

		/* Manual, it's shit but it was the easier method */
		array_push($djs, isset($obj->dj1)?$obj->dj1:"");
		array_push($djs, isset($obj->dj2)?$obj->dj2:"");
		array_push($djs, isset($obj->dj3)?$obj->dj3:"");
		array_push($djs, isset($obj->dj4)?$obj->dj4:"");
		array_push($djs, isset($obj->dj5)?$obj->dj5:"");

		foreach ($djs as $sing) {
			$djss .= (($sing != "")?",".$sing:"");
		}

		$sql = "SELECT name_dj FROM djs WHERE id_dj IN (0".$djss.");";

		$rowd = $olddb->get_results($sql);

		$djarr = array();
		foreach ($rowd as $djname) {
			array_push($djarr, $djname->name_dj);
		}

		$user = reset(
		 get_users(
		  array(
		   'meta_key' => 'dj_id',
		   'meta_value' => $djs[0],
		   'fields' => 'ids',
		   'number' => 1,
		   'count_total' => false
		  )
		 )
		);

		$dj_id = $djs[0];

		$post_id = wp_insert_post( array(
	        'post_title'    => $obj->name_show,
	        'post_type'     => 'show',
	        'post_content'  => (isset($obj->description_show)?$obj->description_show:""),
	        'post_author'   => ((isset($user) && is_numeric($user))?$user:"1"),
	        'post_parent'   => '0',
	        'post_status'   => 'publish'
	    ) );

	    update_post_meta( $post_id, 'start_time', strtotime($obj->time_start));
	    update_post_meta( $post_id, 'end_time', strtotime($obj->time_end));
	    update_post_meta( $post_id, 'active_show', (($obj->active_show == "y")?1:0));
	    update_post_meta( $post_id, 'start_time', strtotime($obj->time_start));
	    update_post_meta( $post_id, 'djs', serialize($djarr));

	    wp_set_object_terms( $post_id, get_old_day($obj->day), 'days' );
	    wp_set_object_terms( $post_id, get_old_genre($obj->genre), 'genres' );
	}

	error_log("done with show script", 0);
	return;
}

function get_old_genre($num) {
	switch($num) {
		case 1:
			return "rock";
			break;
		case 2:
			return "rap";
			break;
		case 3:
			return "jazz";
			break;
		case 4:
			return "specialty";
			break;
		case 5:
			return "international";
			break;
		case 6:
			return "classical";
			break;
		case 7:
			return "folk";
			break;
		case 8:
			return "public-affairs	";
			break;
		case 10:
			return "dance-rpm";
			break;
		default:
			return 42;
	}
}

function get_old_day($num) {
	switch($num) {
		case 1:
			return "monday";
			break;
		case 2:
			return "tuesday";
			break;
		case 3:
			return "wednesday";
			break;
		case 4:
			return "thursday";
			break;
		case 5:
			return "friday";
			break;
		case 6:
			return "saturday";
			break;
		case 7:
			return "sunday";
			break;
		default:
			return "unkown";
	}
}
 
function import_shows_done() {
    add_option('my_script_completev17', 1);
    die("Script finished.");
}

/* Numeric Pagination */

function numeric_posts_nav($query) {
 
  /** Stop execution if there's only 1 page */
  if( $query->max_num_pages <= 1 )
      return;

  $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
  $max   = intval( $query->max_num_pages );

  /** Add current page to the array */
  if ( $paged >= 1 )
      $links[] = $paged;

  /** Add the pages around the current page to the array */
  if ( $paged >= 3 ) {
      $links[] = $paged - 1;
      $links[] = $paged - 2;
  }

  if ( ( $paged + 2 ) <= $max ) {
      $links[] = $paged + 2;
      $links[] = $paged + 1;
  }

  echo '<div class="navigation"><ul>' . "\n";

  /** Previous Post Link */
  if ( get_previous_posts_link() )
      printf( '<li>%s</li>' . "\n", get_previous_posts_link() );

  /** Link to first page, plus ellipses if necessary */
  if ( ! in_array( 1, $links ) ) {
      $class = 1 == $paged ? ' class="active"' : '';

      printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );

      if ( ! in_array( 2, $links ) )
          echo '<li>…</li>';
  }

  /** Link to current page, plus 2 pages in either direction if necessary */
  sort( $links );
  foreach ( (array) $links as $link ) {
      $class = $paged == $link ? ' class="active"' : '';
      printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
  }

  /** Link to last page, plus ellipses if necessary */
  if ( ! in_array( $max, $links ) ) {
      if ( ! in_array( $max - 1, $links ) )
          echo '<li>…</li>' . "\n";

      $class = $paged == $max ? ' class="active"' : '';
      printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
  }

  /** Next Post Link */
  if ( get_next_posts_link() )
      printf( '<li>%s</li>' . "\n", get_next_posts_link() );

  echo '</ul></div>' . "\n";
 
}

/* Adding support for different schedules */

function schedule_selector($wp_customize){
  $wp_customize->add_section('whpk-settings', array(
      'title'    => __('WHPK Settings', 'whpk-redesign'),
      'description' => 'Adjust general WHPK settings here',
      'priority' => 120,
  ));

  $wp_customize->add_setting('under-construction', array(
      'capability'     => 'edit_theme_options',
      'type'           => 'theme_mod'

  ));

  $wp_customize->add_control(
    'is-under-construction', 
    array(
      'label'    => __( 'Check this to enable the under-construction landing page (currently does nothing)', 'whpk-redesign' ),
      'priority' => 10,
      'section'  => 'whpk-settings',
      'settings' => 'under-construction',
      'type'     => 'checkbox'
    )
  );

  $wp_customize->add_setting('schedule-select', array(
      'default'        => 'reg',
      'capability'     => 'edit_theme_options',
      'type'           => 'theme_mod'

  ));

  $wp_customize->add_control(
    'schedule-select-box', 
    array(
      'label'    => __( 'Choose the schedule format here', 'whpk-redesign' ),
      'priority' => 10,
      'section'  => 'whpk-settings',
      'settings' => 'schedule-select',
      'type'     => 'select',
      'choices'  => array(
        '7-24'  => 'Regular Schedule (7:00 - 24:00)',
        '8-24'  => 'Summer Schedule (8:00 - 24:00)',
        '9-24'  => 'Lazy Schedule (9:00 - 24:00)'
      )
    )
  );

  $wp_customize->add_setting('custom-schedule', array(
      'capability'     => 'edit_theme_options',
      'type'           => 'theme_mod'
  ));

  $wp_customize->add_control(
    'custom-schedule-chk', 
    array(
      'label'    => __( 'Check this to enable a custom schedule format (specified below):', 'whpk-redesign' ),
      'priority' => 10,
      'section'  => 'whpk-settings',
      'settings' => 'custom-schedule',
      'type'     => 'checkbox'
    )
  );

  $wp_customize->add_setting('custom-schedule-start', array(
      'default'        => '7',
      'capability'     => 'edit_theme_options',
      'type'           => 'theme_mod'

  ));

  $wp_customize->add_control(
    'custom-schedule-start-select', 
    array(
      'label'    => __( 'Custom Start Time', 'whpk-redesign' ),
      'priority' => 10,
      'section'  => 'whpk-settings',
      'settings' => 'custom-schedule-start',
      'type'     => 'select',
      'choices'  => array(
        '0'   => '0:00',
        '1'   => '1:00',
        '2'   => '2:00',
        '3'   => '3:00',
        '4'   => '4:00',
        '5'   => '5:00',
        '6'   => '6:00',
        '7'   => '7:00',
        '8'   => '8:00',
        '9'   => '9:00',
        '10'  => '10:00',
        '11'  => '11:00',
        '12'  => '12:00',
        '13'  => '13:00',
        '14'  => '14:00',
        '15'  => '15:00',
        '16'  => '16:00',
        '17'  => '17:00',
        '18'  => '18:00',
        '19'  => '19:00',
        '20'  => '20:00',
        '21'  => '21:00',
        '22'  => '22:00',
        '23'  => '23:00',
        '24'  => '24:00',
      )
    )
  );

  $wp_customize->add_setting('custom-schedule-end', array(
      'default'        => '24',
      'capability'     => 'edit_theme_options',
      'type'           => 'theme_mod'

  ));

  $wp_customize->add_control(
    'custom-schedule-end-select', 
    array(
      'label'    => __( 'Custom End time', 'whpk-redesign' ),
      'priority' => 10,
      'section'  => 'whpk-settings',
      'settings' => 'custom-schedule-end',
      'type'     => 'select',
      'choices'  => array(
        '0'   => '0:00',
        '1'   => '1:00',
        '2'   => '2:00',
        '3'   => '3:00',
        '4'   => '4:00',
        '5'   => '5:00',
        '6'   => '6:00',
        '7'   => '7:00',
        '8'   => '8:00',
        '9'   => '9:00',
        '10'  => '10:00',
        '11'  => '11:00',
        '12'  => '12:00',
        '13'  => '13:00',
        '14'  => '14:00',
        '15'  => '15:00',
        '16'  => '16:00',
        '17'  => '17:00',
        '18'  => '18:00',
        '19'  => '19:00',
        '20'  => '20:00',
        '21'  => '21:00',
        '22'  => '22:00',
        '23'  => '23:00',
        '24'  => '24:00',
      )
    )
  );

  $wp_customize->add_setting('display-msg', array(
      'capability'     => 'edit_theme_options',
      'type'           => 'theme_mod'

  ));

  $wp_customize->add_control(
    'display-msg-chk', 
    array(
      'label'    => __( 'Check this to enable the message (below) on top of the navigational banner', 'whpk-redesign' ),
      'priority' => 10,
      'section'  => 'whpk-settings',
      'settings' => 'display-msg',
      'type'     => 'checkbox'
    )
  );

  $wp_customize->add_setting('main-ann', array(
      'default'        => ' ',
      'capability'     => 'edit_theme_options',
      'type'           => 'theme_mod'

  ));

  $wp_customize->add_control(
    'main-ann-input', 
    array(
      'label'    => __( 'Message to display in banner', 'whpk-redesign' ),
      'priority' => 10,
      'section'  => 'whpk-settings',
      'settings' => 'main-ann',
    )
  );

  $wp_customize->add_setting('display-modal', array(
      'capability'     => 'edit_theme_options',
      'type'           => 'theme_mod'

  ));

  $wp_customize->add_control(
    'display-modal-chk', 
    array(
      'label'    => __( 'Check this to enable the message (below) in a modal display on the homepage', 'whpk-redesign' ),
      'priority' => 10,
      'section'  => 'whpk-settings',
      'settings' => 'display-modal',
      'type'     => 'checkbox'
    )
  );

  $wp_customize->add_setting('modal-text', array(
      'default'        => ' ',
      'capability'     => 'edit_theme_options',
      'type'           => 'theme_mod'

  ));

  $wp_customize->add_control(
    'modal-text-input', 
    array(
      'label'    => __( 'Message to display in modal', 'whpk-redesign' ),
      'priority' => 10,
      'section'  => 'whpk-settings',
      'settings' => 'modal-text',
    )
  );
}

add_action( 'customize_register', 'schedule_selector' );
