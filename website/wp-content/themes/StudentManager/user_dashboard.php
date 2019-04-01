<?
/*
Template Name: User Dashboard
*/

//Check user is logged in, if not - redirect to login
if(!is_user_logged_in()) {
    //Redirect to login page
    $redirUrl = home_url() . "/wp-login.php";
    header('Location: ' . $redirUrl);
}
else {

get_header();
$usr = wp_get_current_user();
$name = get_the_author_meta('first_name', $usr->ID) . " " . get_the_author_meta('last_name', $usr->ID);

$fbLoginUrl = GetFbLoginUrl();

if(empty($name) || trim($name) == "") {
    $name = "UNDEFINED";
}
?>
<div class="row">
    <div class="container">
        <div class="row" id="user_header_section">
            <div class="col-sm-4">
                <img src="https://placehold.it/150x150" height="150" width="150" id="user_profile_pic" class="rounded mx-auto d-block" alt="profile picture">
            </div>
            <div class="col-sm-8">
                <h2><?echo $name?></h2>
                <small><a href="#">Not you? Log out</a></small>
            </div>
        </div>
        <div class="row" id="user_tabs_section">
            <ul class="nav nav-tabs nav-justified" id="user-dash-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="services-tab" data-toggle="tab" href="#services" role="tab" aria-controls="services" aria-selected="true">Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="details-tab" data-toggle="tab" href="#details" role="tab" aria-controls="details" aria-selected="false">My Details</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="settings-tab" data-toggle="tab" href="#settings" role="tab" aria-controls="settings" aria-selected="false">Account Settings</a>
                </li>
            </ul>
            <div class="tab-content" id="user-dash-tab-content">
                <div class="tab-pane fade show active" id="services" role="tabpanel" aria-labelledby="services-tab">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-4">
                                <div class="card">
                                    <img class="card-img-top" src="https://placehold.it/280x180" alt="facebook-service-card">
                                    <div class="card-body">
                                        <h5 class="card-title">Connect Facebook</h5>
                                        <p class="card-text">Connect your facebook account to your MyLife account</p>
                                        <a href="<?echo $fbLoginUrl;?>" class="btn btn-primary">Connect</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="card">
                                    <img class="card-img-top" src="https://placehold.it/280x180" alt="facebook-service-card">
                                    <div class="card-body">
                                        <h5 class="card-title">Connect Twitter</h5>
                                        <p class="card-text">Connect your twitter account to your MyLife account</p>
                                        <a href="#" class="btn btn-primary">Connect</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="card">
                                    <img class="card-img-top" src="https://placehold.it/280x180" alt="facebook-service-card">
                                    <div class="card-body">
                                        <h5 class="card-title">Connect Facebook</h5>
                                        <p class="card-text">Connect your facebook account to your MyLife account</p>
                                        <a href="#" class="btn btn-primary">Connect</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="tab-pane fade" id="details" role="tabpanel" aria-labelledby="details-tab">
                </div>
                <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="settings-tab">
                </div>
            </div>
        </div>
    </div>
</div>

<?

get_footer();
} //End if(!is_user_logged_in())
?>
