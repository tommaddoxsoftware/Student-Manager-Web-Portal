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
function customise_login() {
    echo '<link rel="stylesheet" type="text/css" href="' . bloginfo('template_directory') . '/css/login.css"';
}
function custom_login_logo_url() {
    return get_bloginfo( 'url' );
}
function custom_login_logo_url_title() {
    return 'Student Manager';
}

add_action('login_head', 'customise_login');
add_filter( 'login_headerurl', 'custom_login_logo_url' );
add_filter( 'login_headertitle', 'custom_login_logo_url_title' );


?>
