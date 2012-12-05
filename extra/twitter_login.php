<?php
require('../twitteroauth-master/twitteroauth/twitteroauth.php');
include '../twitter-lib/secret.php';

session_start();

//twitter Oauth instance
$twitteroauth = new TwitterOAuth($consumer_key, $consumer_secret);

//request auth tokens, parameter is URL to be redirected to
$request_token=$twitteroauth->getRequestToken('http://10.0.0.27/TwitterTest/index.php');
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