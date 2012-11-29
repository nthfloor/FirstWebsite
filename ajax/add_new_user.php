<?php
//uses javascripts alert function
function alert($input)
{
	print("<script type=\"text/javascript\">alert('$input');</script>");
}

//setup DB connection
$con=mysql_connect("localhost","root","password");
if(! $con)
{
	die('Could not connect to: '.mysql_error());
}
mysql_select_db("my_db",$con);

//retrieve new user's details and insert into DB
$fname=$_POST['Name'];
$uname=$_POST['Username'];
$password=$_POST['Password'];
$email=$_POST['Email'];

$sql="INSERT INTO UserDetails (Name, Username, Password, Email) VALUES ('$fname','$uname','$password','$email')";
if(!mysql_query($sql))
{
	die('Error: '.mysql_error());
}

//move to dashboard page
ob_start();
header("Location: ../extra/login_success.php");
ob_end_flush();
exit();

mysql_close($con);
?>