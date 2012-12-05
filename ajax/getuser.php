<?php
session_start();
//uses javascripts alert function
function alert($input)
{
	echo ("<script type=\"text/javascript\">alert('$input');</script>");
}

//setup DB connection
$con=mysql_connect("localhost","root","password");
if(! $con)
{
	die('Could not connect to: '.mysql_error());
}
mysql_select_db("my_db",$con);

//get the q parameter from URL
$q=$_GET["q"];

$sql="";
//alert("Hello".$q."?");
if($q=="all_users")
{
	$sql="SELECT * FROM UserDetails";
	$result=mysql_query($sql);	

	echo "<h3><b>List of Users</b></h3><hr>";
	echo "<table border='1' class=\"table table-hover table-striped\">";
	echo "<tr>
		<th>Username</th>
		<th>Name</th>
		<th>Password</th>
		<th>Email</th>
	</tr>";

	while($row = mysql_fetch_array($result))
	{
		echo "<tr>";
		echo "<td>".$row['Username']."</td>";
	  	echo "<td>".$row['Name']."</td>";
	  	echo "<td>".$row['Password']."</td>";
	  	echo "<td>".$row['Email']."</td>";
	  	echo "</tr>";
	}
	echo "</table>";
	$_SESSION['mail']=0;
}
else
{	
	$sql="SELECT * FROM UserDetails WHERE Username='".$q."'";
	$result=mysql_query($sql);

	while($row=mysql_fetch_array($result))
	{
		echo "<legend><h3>User Account Details</h3></legend>";
		echo "<form class=\"well form-horizontal\" action=\"../ajax/modify_user.php\" method=\"post\">";
		echo "<fieldset>";		
		echo "<div class=\"control-group\">";
		echo "	<label class=\"control-label\" for=\"name_in\">Name: </label>";
		echo "	<div class=\"controls\">";
		echo "		<input class= \"input-xlarge\" id=\"name_in\" type=\"text\" name=\"Name\" value=\"".$row['Name']."\">";
		echo "	</div>";
		echo "</div>";
		echo "<div class=\"control-group\">";
		echo "	<label class=\"control-label\" for=\"uname_in\">Username: </label>";
		echo "	<div class=\"controls\">";
		echo "		<input class= \"input-xlarge\" id=\"uname_in\" type=\"text\" name=\"Username\" value=\"".$row['Username']."\">";
		echo "	</div>";
		echo "</div>";
		echo "<div class=\"control-group\">";
		echo "	<label class=\"control-label\" for=\"pass_in\">Password: </label>";
		echo "	<div class=\"controls\">";
		echo "		<input class= \"input-xlarge\" id=\"pass_in\" type=\"text\" name=\"Password\" value=\"".$row['Password']."\">";
		echo "	</div>";
		echo "</div>";
		echo "<div class=\"control-group\">";
		echo "	<label class=\"control-label\" for=\"mail_in\">Email: </label>";
		echo "	<div class=\"controls\">";
		echo "		<input class= \"input-xlarge\" id=\"mail_in\" type=\"text\" name=\"Email\" value=\"".$row['Email']."\">";
		echo "	</div>";
		echo "</div>";
		echo "<div class=\"control-group\">";
		echo "	<div class=\"controls\">";
		echo "		<input class=\"btn btn-warning\" type=\"submit\" value=\"Edit\" name=\"btnEdit\"> <input class=\"btn btn-danger\" type=\"submit\" name=\"btnDel\" value=\"Delete\">";
		echo "	</div>";
		echo "</div>";
		echo "</form>";
		echo "</div>";
		echo "</fieldset>";
		$_SESSION['mail']=1;
	}
}

mysql_close($con);

?>