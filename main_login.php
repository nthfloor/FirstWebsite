<?php
	session_start();
	//$_SESSION['user']=null;	
	//echo $_SESSION['user'];
?>

<html>
	<head>
		<script type="text/javascript">
			function setFocus()
			{
				document.getElementById("uname").focus();
			}
		</script>
	</head>

    <body onload="setFocus()">
        <div>
	    <div id="header" style="background-color:yellow;">
	        <h1 style="margin-middle:0;">HelloWorld Enterprises Login</h1></div>
 	    <div id="login_form" style="background-color:#EEEEEE">
	        <form action="extra/check_login.php" method="post">
		    <table border="0" align="center">
		        <tr>
			    	<td>Username</td>
                	<td>:</td>
			    	<td><input type="text" name="user" id="uname"></td>
				</tr>
				<tr>
			    	<td>Password</td>
                	<td>:</td>
			    	<td><input type="password" name="password"></td>
				</tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td><input type="submit" value="Login"></td>
                </tr>
		    </table>		   
	        </form>
	    </div>
        </div>
    </body>
</html>