<?php
require("twitteroauth/twitteroauth.php");
session_start();

if(!empty($_GET['oauth_verifier']) && !empty($_SESSION['oauth_token']) && !empty($_SESSION['oauth_token_secret'])){  
    // We've got everything we need  
} else {  
    // Something's missing, go back to square 1  
    header('Location: twitter_login.php');  
    die();
}  

// TwitterOAuth instance, with two new parameters we got in twitter_login.php  
$twitteroauth = new TwitterOAuth('Zlsag6ExQYh6ABiPaZbpWA', 'pKg5hBctP9AcQToL6lOlapA3D8vUS5YUVhndaGwZM', $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);  
// Let's request the access token  
$access_token = $twitteroauth->getAccessToken($_GET['oauth_verifier']); 
// Save it in a session var 
$_SESSION['access_token'] = $access_token; 
// Let's get the user's info 
$user_info = $twitteroauth->get('account/verify_credentials'); 
// Print user's info  
print_r($user_info);  

?>