<?php
session_start();
if(isset($_SESSION['user']))
{
  header("Location: extra/login_success.php");
  die();
  exit();
}

//twitter login libraries
/*include 'twitter-lib/EpiCurl.php';
include 'twitter-lib/EpiOAuth.php';
include 'twitter-lib/EpiTwitter.php';
include 'twitter-lib/secret.php';

$twitterObj = new EpiTwitter($consumer_key, $consumer_secret);
$oauth_token = $_GET['oauth_token'];
  if($oauth_token=='')
  {
    $url=$twitterObj->getAuthorizationUrl();
  }
  else
  {
    $twitterObj->setToken($_GET['oauth_token']);
    $token = $twitterObj->getAccessToken();
    $twitterObj->setToken($token->oauth_token, $token->oauth_token_secret);
    $_SESSION['ot']=$token->oauth_token;
    $_SESSION['ots']=$token->oauth_token_secret;
    $twitterInfo=$twitterObj->get_accountVerify_credentials();
    $twitterInfo->response;
    $username=$twitterInfo->screen_name;
    include 'update.php';
  }*/

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Sign in &middot; HelloWorld</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
      }

      .form-signin {
        max-width: 300px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
      .form-signin input[type="text"],
      .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
      }

    </style>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="shortcut icon" href="bootstrap/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="bootstrap/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="bootstrap/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="bootstrap/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="bootstrap/ico/apple-touch-icon-57-precomposed.png">

    <script type="text/javascript">
      function setFocus()
      {
        document.getElementById("uname").focus();
      }

      function twitterSign()
      {

      }
    </script>
  </head>

  <body onload="setFocus()">
    <div class="navbar navbar-fixed-top navbar-inverse">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="#">HelloWorld Enterprises</a>          
        </div>
      </div>
    </div>
    <br>

    <div class="container">

      <form class="form-signin" action="extra/check_login.php" method="post">
        <h2 class="form-signin-heading">Please sign in</h2>
        <?php
          if(!isset($_SESSION['login_success']))
          {
        ?>
        <div class="alert alert-block alert-success" id="alert_block">
          <p id="alert_msg">Enter Login Details</p>
        </div>
        <?php
          }
          elseif($_SESSION['login_success']==0)
          {
          ?>
        <div class="alert alert-block alert-error" id="alert_block">
          <p id="alert_msg">Password does not match username.</p>
        </div>
        <?php
          }
          elseif($_SESSION['login_success']==2)
          {
        ?>
        <div class="alert alert-block alert-error" id="alert_block">
          <p id="alert_msg">User is not registered on system.</p>
        </div>
        <?php
          }
          elseif($_SESSION['login_success']==3)
          {
        ?>
        <div class="alert alert-block alert-error" id="alert_block">
          <p id="alert_msg">Please enter a username.</p>
        </div>
        <?php
          }
        ?>

        <input type="text" class="input-block-level" placeholder="Username" name="user" id="uname">
        <input type="password" class="input-block-level" placeholder="Password" name="password">
        <!--<label class="checkbox">
          <input type="checkbox" value="remember-me" name="remember"> Remember me
          <?php //echo "<a href='extra/twitter_login.php' class=\"btn btn-medium btn-primary\">Sign in With Twitter</a>"; ?>
        </label>-->
        <button class="btn btn-large btn-primary" type="submit">Sign in</button>         
        <a href="twitter-lib/twitter_login.php"><img src="./imgs/lighter.png" alt="Sign in with Twitter"/></a>
      </form>

      <div class="navbar navbar-fixed-bottom navbar-inverse">
        <div class="navbar-inner">
          <div class="container">
            <p style="text-align:center;clear:both;">Copyright &copy; Nathan Floor 2012</p>
          </div>
        </div>
      </div>
    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->    
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!--<script src="bootstrap/js/jquery.js"></script>
    <script src="bootstrap/js/bootstrap.js"></script>
    <script src="bootstrap/js/bootstrap-alert.js"></script>-->

  </body>
</html>
