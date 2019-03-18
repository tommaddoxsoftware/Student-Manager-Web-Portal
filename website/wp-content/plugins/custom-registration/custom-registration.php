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

/* Front end */
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

function validateDate($date, $format = "d-m-Y") {
    if(strtotime($date) < strtotime('-13 years') ) {
        return false;
    }

    //Check date in $_POST val meets the required format
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) === $date;
}

//STEP 3. Save our extra registration user meta and sanitize inputs.
add_action( 'user_register', 'custom_user_register' );
function custom_user_register( $user_id ) {
    if ( ! empty( $_POST['first_name'] ) ) {
        update_user_meta( $user_id, 'first_name', sanitize_text_field( $_POST['first_name'] ) );
    }
    if ( ! empty($_POST['date_of_birth']) ) {
        update_user_meta($user_id, 'date_of_birth', $_POST['date_of_birth']);
    }
}
?>
