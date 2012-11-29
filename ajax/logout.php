<?php

session_start();

if(isset($_SESSION['views']))
{
	unset($_SESSION['views']);
}

session_destroy();
ob_start();
header("Location: ../main_login.php");
ob_end_flush();
exit();

?>