<?
//Setup facebook object
$fb = new \Facebook\Facebook([
    'app_id'        => '2041940582781911',
    'app_secret'    => 'da28240ea9cae81da94323c391279eda',
    'default_graph_version' => 'v2.10'
]);



function GetFbLoginUrl() {
    global $fb;

    $permissions = [];

    //Get the login url, using a seperate file to handle FB's callback
    $helper = $fb->getRedirectLoginHelper();
    $loginUrl = $helper->getLoginUrl(bloginfo('template_directory' . '/fb-login-callback.php'), $permissions);

    //Return the url
    return htmlspecialchars($loginUrl);
}
?>
