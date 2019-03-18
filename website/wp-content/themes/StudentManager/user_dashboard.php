<?
/*
Template Name: User Dashboard
*/

//Check user is logged in, if not - redirect to login
/*if(!is_user_logged_in()) {
    //Redirect to login page
}
else {
*/
get_header();
$usr = wp_get_current_user();
?>
<div class="row">
    <div class="container">
        <div class="row" id="user_header_section">
            <div class="col-sm-4">
                <img src="https://placehold.it/150x150" height="150" width="150" id="user_profile_pic" class="rounded mx-auto d-block" alt="profile picture">
            </div>
            <div class="col-sm-8">
                <h2><?$usr->user_firstname . " " . $usr->user_lastname;?></h2>
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
//} //End if(!is_user_logged_in())
?>
