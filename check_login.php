<?php
	function alert($input)
	{
		print("<script type=\"text/javascript\">alert('$input');</script>");
	}

	$uname=$_POST['user'];
	$password=$_POST['password'];

	if($uname=="nathan" && $password=="password")
	{
		alert("Welcome to HelloWorld Enterprises!");
		//move to dashboard page
		ob_start();
		header("Location: First.html");
		ob_end_flush();
		exit();
	}
	else
	{
		alert("Sorry, try again...");
	}

?>