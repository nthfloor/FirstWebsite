<?php

session_start();

if(isset($_SESSION['views']))
{
	unset($_SESSION['views']);
}
if(isset($_SESSION['mail']))
{
	unset($_SESSION['mail']);
}
if(isset($_SESSION['target_user']))
{
	unset($_SESSION['target_user']);
}
if(isset($_SESSION['mail_success']))
{
	unset($_SESSION['mail_success']);
}

session_destroy();
ob_start();
header("Location: ../signin.html");
ob_end_flush();
exit();

?>