<?php
	session_start();
	function alert($input)
	{
		print("<script type=\"text/javascript\">alert('$input');</script>");
	}

	$uname=$_POST['user'];
	$password=$_POST['password'];

	if($uname=='')
	{
		$_SESSION['login_success']=3;
		header("Location: ../signin.php");
		die();
		exit();
	}

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
		//alert($row['Username']." ".$row['Password']);
		if($uname==$row['Username'] && $row['Password']==$password)
		{
			$_SESSION['user']=$uname;
			$_SESSION['user_email']=$row['Email'];
			$_SESSION['login_success']=1;
			//echo $_SESSION['user'];
			//move to dashboard page
			//ob_start();
			header("Location: login_success.php");
			//ob_end_flush();
			exit();
		}
		else
		{
			//move back to login page
			//ob_start();
			//echo($uname." ".$password);
			$_SESSION['login_success']=0;
			header("Location: ../signin.php");
			die();
			//ob_end_flush();
			exit();
		}
	}	
	//echo($uname." ".$password);
	//ob_start();
	$_SESSION['login_success']=2;
	header("Location: ../signin.php");
	die();
	//ob_end_flush();

	mysql_close($db_connection);
?>