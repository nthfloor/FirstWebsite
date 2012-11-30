<?php
	session_start();
	function alert($input)
	{
		print("<script type=\"text/javascript\">alert('$input');</script>");
	}

	$uname=$_POST['user'];
	$password=$_POST['password'];

	//connect to DB and query username and password combo for authentication.
	$db_connection = mysql_connect("localhost","root","password");
	if(! $db_connection)
	{
		die('Could not connect to: '.mysql_error());
	}
	mysql_select_db("my_db",$db_connection);

	//query DB and perform check for username
	$sql="SELECT Username,Password,Email FROM UserDetails WHERE Username='".$uname."'";	
	$result=mysql_query($sql);
	while($row = mysql_fetch_array($result))
	{
		alert($row['Username']." ".$row['Password']);
		if($uname==$row['Username'] && $row['Password']==$password)
		{
			$_SESSION['user']=$uname;
			$_SESSION['user_email']=$row['Email'];
			//echo $_SESSION['user'];
			//move to dashboard page
			//ob_start();
			header("Location: login_success.php");
			//ob_end_flush();
			exit();
		}
		else
		{
			$_SESSION['user']=null;
			//alert("Sorry, try again...");
			//move back to login page
			//ob_start();
			//alert($uname." ".$password);
			header("Location: ../sigin.html");
			die();
			//ob_end_flush();
			//exit();
		}
	}	
	//alert("Nothing found.".$uname);
	//ob_start();
	header("Location: ../signin.html");
	die();
	//ob_end_flush();
	//exit();

	mysql_close($db_connection);
?>