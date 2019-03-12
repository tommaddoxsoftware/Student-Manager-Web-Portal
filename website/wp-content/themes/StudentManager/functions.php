<?
// =======================================================================//
//   Include required files                                               //
// =======================================================================//
if(is_admin()) {
    include("admin_functions.php");
}

//Ajax functions
include "ajax_functions.php";

// =======================================================================//
//   Register navbar/navwalker                                            //
// =======================================================================//
require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';

//Register navbar
register_nav_menus( array(
    'primary' => __( 'Primary', 'StudentManager'),
) );

// =======================================================================//
//   Enqueue styles and scripts                                           //
// =======================================================================//
function sm_enqueue_scripts() {
    //unload WordPress' version of jQuery and load the version we want
    wp_deregister_script('jquery');
    wp_register_script('jquery', 'https://code.jquery.com/jquery-3.3.1.min.js');

    //Enqueue scripts
    wp_enqueue_script('jquery');
    wp_enqueue_script('popper', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js');
    wp_enqueue_script('bootstrap-js', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js', array('jquery', 'popper'), true);
}

function sm_enqueue_styles() {
    wp_enqueue_style('bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' );
	wp_enqueue_style('bootstrap-datepicker', get_template_directory_uri().'/vendor/bootstrap-datepicker-1.6.4/css/bootstrap-datepicker.min.css');
	wp_enqueue_style('custom_styles', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style('fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' );
	wp_enqueue_style('googleFonts', 'https://fonts.googleapis.com/css?family=Lato|Montserrat|Open+Sans|Roboto:400,700,900');
}

//Call the enqueue functions
add_action('wp_enqueue_scripts', 'sm_enqueue_styles');
add_action('wp_enqueue_scripts', 'sm_enqueue_scripts');

// =======================================================================//
//   Modify WordPress user roles                                          //
// =======================================================================//
//Remove existing roles
remove_role('subscriber');
remove_role('editor');
remove_role('contributor');
remove_role('author');

//Create new roles
$userPerms = array(
    'read' => true
);
add_role('user', 'End User', $userPerms);

// =======================================================================//
//   Login and register functions                                         //
// =======================================================================//
//Custom styling on wordpress login/register
add_action('login_head', 'custom_login_styles');
function custom_login_styles() {
    echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('stylesheet_directory') . ' /css/login.css" />';
}
//Step 1. Add required forms to default registration form
add_action('register_form', 'custom_registration_form');
function custom_registration_form() {
    $first_name = ( ! empty( $_POST['first_name'] ) ) ? sanitize_text_field( $_POST['first_name'] ) : '';
    $year = ! empty($_POST['birth_year']) ? intval($_POST['birth_year']) : '';
    ?>

    <div class="form-group">
        <label for="first_name">First Name</label>
        <input type="text" name="first_name" id="first_name" class="form-control" value="<? echo esc_attr($first_name);?>" size="30" required>
    </div>
    <div class="form-group">
        <label for="birth_year">Year of Birth</label>
        <input type="number" class="form-control" required min="1900" max="<?echo date('Y');?>" step="1" id="birth_year" name="birth_year" value="<?php echo esc_attr($year);?>">
    <?
}

//Step 2. Add validation
add_filter( 'registration_errors', 'custom_registration_errors', 10, 3 );
function custom_registration_errors( $errors, $sanitized_user_login, $user_email ) {
    //Check for errors
    if ( empty( $_POST['first_name'] ) || ! empty( $_POST['first_name'] ) && trim( $_POST['first_name'] ) == '' ) {
        $errors->add( 'first_name_error', sprintf('<strong>%s</strong>: %s', 'ERROR', 'You must include a first name.') );
    }

    if (empty ($_POST['birth_year'])) {
        $errors->add('birth_year_error', sprintf('<strong>%s</strong>: %s', 'ERROR', 'You must provide your year of birth'));
    }
    if (!empty($_POST['birth_year']) && intval($_POST['birth_year']) < 1900) {
        $errors->add('birth_year_error', sprintf('<strong>%s</strong>: %s', 'ERROR', 'Invalid year of birth. Must be born between 1900 and ' . date('Y') ));
    }


    return $errors;
}

//Step 3. Save our extra registration user meta.
add_action( 'user_register', 'custom_user_register' );
function custom_user_register( $user_id ) {
    if ( ! empty( $_POST['first_name'] ) ) {
        update_user_meta( $user_id, 'first_name', sanitize_text_field( $_POST['first_name'] ) );
    }
    if ( ! empty($_POST['birth_year']) ) {
        update_user_meta($user_id, 'birth_year', intval( $_POST['birth_year']));
    }
}


?>
