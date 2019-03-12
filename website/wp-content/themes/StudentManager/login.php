<?
/*Template Name: Login/Register*/
get_header();
?>


<div class="row">
    <div class="login-form-wrap">
        <h1 class="w-100 d-block mx-auto text-center">Login to Student Manager</h1>
        <? if(! is_user_logged_in()) {
            $args = array(
                'redirect'  => get_home_url() . '/user_dashboard',
                'form_id'   => 'loginform',
                'remember'  => true
            );

            wp_login_form($args);
            wp_register('Create your account');
        }
        else {
            //User logged in, display logout / go to dash
            ?>
            <h1>You're already logged in!</h1>
            <div>
                <button type="button" class="btn btn-lg btn-primary">Log out</button>
                <button type="button" class="btn btn-lg btn-primary">My Dashboard</button>
            </div>
            <?

        }
        ?>
    </div>
</div>



<?
get_footer();
?>
