<?php
session_start();

$user=$_POST['target_user'];
$subject=$_POST['subject'];
$msg=$_POST['textarea'];

//connect to DB and query username and password combo for authentication.
$db_connection = mysql_connect("localhost","root","password");
if(! $db_connection)
{
	die('Could not connect to: '.mysql_error());
}
mysql_select_db("my_db",$db_connection);

$query="SELECT Username, Email FROM UserDetails WHERE Username='".$user."'";
$result=mysql_query($query);

while($row=mysql_fetch_array($result))
{
	if($user==$row['Username'])
	{
		//validates the input parameter to ensure that it does not contain special chars
		function checkOK($field)
		{
			if (eregi("\r",$field) || eregi("\n",$field))
				die("Invalid Input!");
		}

		$_SESSION['target_user']=$user;
		if(mail($row['Email'],$subject,$msg,"From: ".$_SESSION['user_email']))
		{
			//success
			$_SESSION['mail_success']=1;			
		}
		else
		{
			//failure
			$_SESSION['mail_success']=0;
		}

		header("Location: ../extra/login_success.php");
	}
}

mysql_close($db_connection);
?>