<?
/*Template Name: Login/Register*/
get_header();
?>
<div class="row">
    <h1 class="w-100 d-block mx-auto text-center">Login to Student Manager</h1>
    <div class="login-form-wrap">
        <form method="post">
            <div class="form-group">
                <label for="loginEmail">Email:</label>
                <input type="email" class="form-control" id="loginEmail" name="login_email" aria-describedby="emailHelp" placeholder="user@studentmanager.co.uk">
                <small id="emailHelp" class="form-text text-muted">This is the email you created your account with</small>
            </div>
            <div class="form-group">
                <label for="loginPassword">Password:</label>
                <input type="password" class="form-control" name="login_password" id="loginPassword">
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="rememberCheck">
                <label class="form-check-label" for="rememberCheck">Remember me</label>
            </div>
            <? wp_nonce_field('login', 'login_nonce');?>
            <button type="submit" id="login-btn" class="btn btn-primary">Login</button>
        </form>
    </div>
</div>
<div class="row">
    <div class="create-acc-wrap">
        <h2 class="w-100 d-block mx-auto text-center">Haven't got an account yet?</h2>
        <button id="create-account-btn" class="btn btn-lg btn-info" type="button">Create account</button>
    </div>
</div>


<?
get_footer();
?>
