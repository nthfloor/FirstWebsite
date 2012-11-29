<?php
echo "<h3>New User's Account Details</h3><hr>";
echo "<form action=\"../ajax/add_new_user.php\" method=\"post\" onload=\"setFocus('name_field')\">";
echo "<table>
		<tr>
			<td>Name</td>
			<td>:</td>
			<td><input type=\"text\" value=\"\" name=\"Name\" id=\"name_field\"></td>
		</tr>";
echo	"<tr>
			<td>Username</td>
			<td>:</td>
			<td><input type=\"text\" name=\"Username\" value=\"\"></td>
		</tr>";
echo	"<tr>
			<td>Password</td>
			<td>:</td>
			<td><input type=\"text\" name=\"Password\" value=\"\"></td>
		</tr>";
echo	"<tr>
			<td>Email</td>
			<td>:</td>
			<td><input type=\"text\" name=\"Email\" value=\"\"></td>
		</tr>";	
echo	"<tr>	
			<td></td>
			<td></td>
			<td><input type=\"submit\" value=\"Submit\"></td>							
		</tr>
		</table>
		</form>";
?>