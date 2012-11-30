<?php
//setup DB connection
$con=mysql_connect("localhost","root","password");
if(! $con)
{
	die('Could not connect to: '.mysql_error());
}
mysql_select_db("my_db",$con);
//var_dump($_POST);exit;
if(isset($_POST['btnEdit'])) //$_POST['btnEdit']=="Edit"
{
	//retrieve new user's details and insert into DB
	$fname=$_POST['Name'];
	$uname=$_POST['Username'];
	$password=$_POST['Password'];
	$email=$_POST['Email'];

	//retrieve old data to compare
	/*$sql="SELECT * FROM UserDetails WHERE Username='$uname'";
	$result=mysql_query($sql);
	while($row=mysql_fetch_array($result))
	{

	}*/

	$sql="UPDATE UserDetails SET Name='".$fname."', Password='".$password."', Email='".$email."' WHERE Username='".$uname."'";
	if(!mysql_query($sql))
	{
		die('Error: '.mysql_error());
	}	
}
else if(isset($_POST['btnDel']))
{
	$uname=$_POST['Username'];
	$sql="DELETE FROM UserDetails WHERE Username='".$uname."'";
	if(!mysql_query($sql))
	{
		die('Error: '.mysql_error());
	}	
}

echo $fname." ".$uname." ".$password." ".$email;

ob_start();
header("Location: ../extra/login_success.php");
ob_end_flush();
exit();

mysql_close($con);
?>