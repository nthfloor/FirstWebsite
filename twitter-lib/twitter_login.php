<?php
require('twitteroauth/twitteroauth.php');
require_once('config.php');

session_start();

//twitter Oauth instance
$twitteroauth = new TwitterOAuth('5sNShhwrP4VxJwpElTyfA', 'j6eajclJ07iHiB07pBrFULTOPWWcT4l17zaC2fmrQ');

//request auth tokens, parameter is URL to be redirected to
$request_token=$twitteroauth->getRequestToken('http://105.237.0.43/index.php');
//saving them into session
$_SESSION['oauth_token']=$request_token['oauth_token'];
$_SESSION['oauth_token_secret']=$request_token['oauth_token_secret'];
//if everything goes well...
if($twitteroauth->http_code==200)
{
	//let's generate URL and redirect
	$url=$twitteroauth->getAuthorizeURL($request_token['oauth_token']);
	//echo $url;
	header("Location: ".$url);
}
else
{
	die('Something died...');
}
?>