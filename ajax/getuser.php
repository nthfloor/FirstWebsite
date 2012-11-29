<?php
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
	echo "<table border='1'>";
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
}
else
{	
	$sql="SELECT * FROM UserDetails WHERE Username='".$q."'";
	$result=mysql_query($sql);

	while($row=mysql_fetch_array($result))
	{
		echo "<h3>User Account Details</h3><hr>";
		echo "<form action=\"../ajax/modify_user.php\" method=\"post\">";
		echo "<table>
				<tr>
					<td>Name</td>
					<td>:</td>
					<td><input type=\"text\" name=\"Name\" value=\"".$row['Name']."\"></td>
				</tr>";
		echo	"<tr>
					<td>Username</td>
					<td>:</td>
					<td><input type=\"text\" name=\"Username\" value=\"".$row['Username']."\"></td>
				</tr>";
		echo	"<tr>
					<td>Password</td>
					<td>:</td>
					<td><input type=\"text\" name=\"Password\" value=\"".$row['Password']."\"></td>
				</tr>";
		echo	"<tr>
					<td>Email</td>
					<td>:</td>
					<td><input type=\"text\" name=\"Email\" value=\"".$row['Email']."\"></td>
				</tr>";	
		echo	"<tr>	
					<td></td>
					<td></td>
					<td><input type=\"submit\" value=\"Edit\" name=\"btnEdit\"><input type=\"submit\" name=\"btnDel\" value=\"Delete\"></td>							
				</tr>
				</table>
				</form>";
	}
}

mysql_close($con);

?>