<?php
/*
Plugin Name: Custom Registration
Plugin URI:
Description: Plugin to modify wordpress registration form to fit project requirements
Version: 1.0
Author: tommaddoxsoftware
Author URI: https://tommaddoxsoftware.co.uk
*/

// =======================================================================//
//   Login and register functions                                         //
// =======================================================================//
//Custom styling on wordpress login/register
add_action('login_head', 'custom_login_styles');
function custom_login_styles() {
    echo '<link rel="stylesheet" type="text/css" href="' . plugin_dir_url(__FILE__). '/css/login.css" />';
    echo '<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"';
}

/*==========================*/
/*  FRONT END REGISTRATION  */
/*==========================*/
//STEP 1. ADD CUSTOM INPUTS
add_action('register_form', 'custom_registration_form');
function custom_registration_form() {
    $first_name = ( ! empty( $_POST['first_name'] ) ) ? sanitize_text_field( $_POST['first_name'] ) : '';
    $dob = ! empty($_POST['date_of_birth']) ? validateDate($_POST['date_of_birth'], "d-m-Y") : '';
    ?>

    <div class="form-group">
        <label for="first_name">First Name</label>
        <input type="text" name="first_name" id="first_name" class="form-control" value="<? echo esc_attr($first_name);?>" size="30" required>
    </div>
    <div class="form-group">
        <label for="last_name">Last Name</label>
        <input type="text" name="last_name" id="last_name" class="form-control" value="<? echo esc_attr($last_name);?>" size="30" required>
    </div>
    <div class="form-group">
        <label for="birth_year">Date of Birth</label>
        <input type="date" class="form-control" min="1900/01/01" max="<?date('Y-m-d', strtotime('-13 years'))?>"required id="date_of_birth" name="date_of_birth" value="<?php echo $dob ?>">
    </div>
    <?
}

//STEP 2. VALIDATE INPUTS
add_filter('registration_errors', 'custom_registration_errors');
function custom_registration_errors($errors, $sanitized_user_login, $user_email) {
    //First Name Validation
    if ( empty( $_POST['first_name'] ) || ! empty( $_POST['first_name'] ) && trim( $_POST['first_name'] ) == '' ) {
        $errors->add( 'first_name_error', sprintf('<strong>%s</strong>: %s', 'ERROR', 'You must include a first name.') );
    }

    //Last Name Validation
    if ( empty( $_POST['last_name'] ) || ! empty( $_POST['last_name'] ) && trim( $_POST['last_name'] ) == '' ) {
        $errors->add( 'last_name_error', sprintf('<strong>%s</strong>: %s', 'ERROR', 'You must include a last name.') );
    }

    //Date of Birth Validation
    if(empty($_POST['date_of_birth'])) {
        $errors->add('date_of_birth_error', sprintf('<strong>%s</strong>: %s', 'ERROR', 'You must provide a date of birth'));
    }

    if(!empty($_POST['date_of_birth']) && !validateDate($_POST['date_of_birth'])) {
        $errors->add('date_of_birth_error', sprintf('<strong>%s</strong>: %s', 'ERROR', 'Invalid date of birth. Must be born between 01/01/1900 and ' . date('d-m-Y') ));
    }
}


//STEP 3. Save our extra registration user meta and sanitize inputs.
add_action( 'user_register', 'custom_user_register' );
function custom_user_register( $user_id ) {
    if ( ! empty( $_POST['first_name'] ) ) {
        update_user_meta( $user_id, 'first_name', sanitize_text_field( $_POST['first_name'] ) );
    }
    if ( ! empty( $_POST['last_name'] ) ) {
        update_user_meta( $user_id, 'last_name', sanitize_text_field( $_POST['last_name'] ) );
    }
    if ( ! empty($_POST['date_of_birth']) ) {
        update_user_meta($user_id, 'date_of_birth', $_POST['date_of_birth']);
    }
}

function validateDate($date, $format = "d-m-Y") {
    if(strtotime($date) < strtotime('-13 years') ) {
        return false;
    }

    //Check date in $_POST val meets the required format
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) === $date;
}

/*===============================*/
/*  SHOW CUSTOM META IN BACKEND  */
/*===============================*/
add_action('show_user_profile', 'custom_registration_show_extra_fields');
add_action('edit_user_profile', 'custom_registration_show_extra_fields');
function custom_registration_show_extra_fields($user) {
    $year = get_the_author_meta('date_of_birth', $user->ID);
    ?>
    <h3><? esc_html_e('Personal Information', 'crf');?></h3>
    <table class="form-table">
        <tr>
            <th><label for="name"><?php esc_html_e('Full Name', 'crf');?></label></th>
            <td><?esc_html(get_the_author_meta('first_name', $user->ID)) . " " . esc_html(get_the_author_meta('last_name', $user->ID))?></td>
        <tr>
            <th><label for="birthday"><?php esc_html_e('Date of Birth', 'crf');?></label></th>
            <td>
                <input type="date" class="regular-text" min="1900/01/01" max="<?date('Y-m-d', strtotime('-13 years'))?>"id="date_of_birth" name="date_of_birth" value="<?php echo esc_attr($year);?>">
            </td>
        </tr>
    </table>
    <?
}

/*=========================*/
/*  BACK END REGISTRATION  */
/*=========================*/
add_action('user_new_form', 'custom_registration_admin_registration_form');
function custom_registration_admin_registration_form($operation) {
    if('add-new-user' !== $operation) {
        return;
    }

    $dob = ! empty($_POST['date_of_birth']) ? intval($_POST['date_of_birth']) : '';
    $fname = ! empty($_POST['first_name']) ? esc_attr($_POST['first_name']) : '';
    $lname = ! empty($_POST['last_name']) ? esc_attr($_POST['last_name']) : '';

    ?>
    <h3><?php esc_html_e('Personal Information', 'crf'); ?></h3>
    <table class="form-table">
        <tr>
            <th>
                <label for="first_name"><?php esc_html_e('First Name', 'crf');?></label>
            </th>
            <td>
                <input type="text" name="first_name" id="first_name" class="form-control" value="<? echo esc_attr($first_name);?>" size="30" required>
            </td>
        </tr>
        <tr>
            <th>
                <label for="last_name"><?php esc_html_e('Last Name', 'crf');?></label>
            </th>
            <td>
                <input type="text" name="last_name" id="last_name" class="form-control" value="<? echo esc_attr($last_name);?>" size="30" required>
            </td>
        </tr>
        <tr>
            <th>
                <label for="birth_year"><?php esc_html_e('Date of Birth', 'crf');?></label>
            </th>
            <td>
                <input type="date" class="form-control" min="1900/01/01" max="<?date('Y-m-d', strtotime('-13 years'))?>"required id="date_of_birth" name="date_of_birth" value="<?php echo $dob ?>">
            </td>
        </tr>

    <?
}


add_action('user_profile_update_errors', 'custom_registration_form_profile_update_errors', 10, 3);
function custom_registration_form_profile_update_errors($errors, $update, $user) {
    //Validate First Name
    if ( empty( $_POST['first_name'] ) || ! empty( $_POST['first_name'] ) && trim( $_POST['first_name'] ) == '' ) {
        $errors->add( 'first_name_error', sprintf('<strong>%s</strong>: %s', 'ERROR', 'You must include a first name.') );
    }

    //Validate Last Name
    if ( empty( $_POST['last_name'] ) || ! empty( $_POST['last_name'] ) && trim( $_POST['last_name'] ) == '' ) {
        $errors->add( 'last_name_error', sprintf('<strong>%s</strong>: %s', 'ERROR', 'You must include a last name.') );
    }


    //Validate Date of birth
    if(empty($_POST['date_of_birth'])) {
        $errors->add('date_of_birth_error', __('<strong>ERROR</strong>: Please enter your date of birth', 'crf'));
    }
    if(!empty($_POST['date_of_birth']) && !validateDate($_POST['date_of_birth'])) {
        $errors->add('date_of_birth_error', __('<strong>ERROR</strong>: Invalid date of birth. To use our service, you must be at least 13 years old'));
    }
}

add_action('personal_options_update', 'custom_registration_update_profile_fields');
add_action('edit_user_profile_update', 'custom_registration_update_profile_fields');

function custom_registration_update_profile_fields($userID) {
    if(! current_user_can('edit_user', $userID)) {
        return false;
    }

    //Sanitize inputs and update user meta!
    if ( ! empty( $_POST['first_name'] ) ) {
        update_user_meta( $user_id, 'first_name', sanitize_text_field( $_POST['first_name'] ) );
    }
    if ( ! empty( $_POST['last_name'] ) ) {
        update_user_meta( $user_id, 'last_name', sanitize_text_field( $_POST['last_name'] ) );
    }
    if ( ! empty($_POST['date_of_birth']) ) {
        update_user_meta($user_id, 'date_of_birth', $_POST['date_of_birth']);
    }
}

/*=====================*/
/*  ADMIN PANEL PAGES  */
/*=====================*/
add_action('admin_menu', 'custom_registration_menu_setup');
function custom_registration_menu_setup() {
    add_menu_page('Manage Custom Registration', 'Custom Registration Plugin', 'manage_options', 'manage-custom-registration', 'custom_registration_main_layout');
}

function custom_registration_main_layout() {
    echo "<h1>Manage Custom Registration Plugin</h1>";
}
?>
