<?php
		echo "<legend><h3>New User's Account Details</h3></legend>";
		echo "<form class=\"well form-horizontal\" action=\"../ajax/add_new_user.php\" method=\"post\">";
		echo "<fieldset>";		
		echo "<div class=\"control-group\">";
		echo "	<label class=\"control-label\" for=\"name_in\">Name: </label>";
		echo "	<div class=\"controls\">";
		echo "		<input class= \"input-xlarge\" type=\"text\" value=\"\" name=\"Name\" id=\"name_field\">";
		echo "	</div>";
		echo "</div>";
		echo "<div class=\"control-group\">";
		echo "	<label class=\"control-label\" for=\"uname_in\">Username: </label>";
		echo "	<div class=\"controls\">";
		echo "		<input class= \"input-xlarge\" type=\"text\" name=\"Username\" value=\"\">";
		echo "	</div>";
		echo "</div>";
		echo "<div class=\"control-group\">";
		echo "	<label class=\"control-label\" for=\"pass_in\">Password: </label>";
		echo "	<div class=\"controls\">";
		echo "		<input class= \"input-xlarge\" type=\"text\" name=\"Password\" value=\"\">";
		echo "	</div>";
		echo "</div>";
		echo "<div class=\"control-group\">";
		echo "	<label class=\"control-label\" for=\"mail_in\">Email: </label>";
		echo "	<div class=\"controls\">";
		echo "		<input class= \"input-xlarge\" type=\"text\" name=\"Email\" value=\"\">";
		echo "	</div>";
		echo "</div>";
		echo "<div class=\"control-group\">";
		echo "	<div class=\"controls\">";
		echo "		<input class=\"btn btn-success\"type=\"submit\" value=\"Submit\">";
		echo "	</div>";
		echo "</div>";
		echo "</form>";
		echo "</div>";
		echo "</fieldset>";
?>