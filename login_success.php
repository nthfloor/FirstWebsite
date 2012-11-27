<?php

function alert($input)
{
	print("<script type=\"text/javascript\">alert('$input');</script>");
}

function sendMail()
{


	if(mail())
	{

	}
	else
	{
		alert("Sorry, failed to send email.\nPlease check the email address and try agian.");
	}
}

?>

<html>
	<body>
		<div>
			<div>
				<form action="save_details.php" method="post">
					<table>
						<tr>
							<td>Username</td>
							<td>:</td>
							<td><input type="text" value=""></td>
						</tr>
						<tr>
							<td>Password</td>
							<td>:</td>
							<td><input type="text" value=""></td>
						</tr>
						<tr>
							<td>Email</td>
							<td>:</td>
							<td><input type="text" value=""></td>
						</tr>	
						<tr>
							<td></td>
							<td></td>
							<td><input type="submit" value="Submit"></td>
						</tr>
					</table>
				</form>
			</div>

			<div >
				<p>You can send an email to the user informing them of their login status.</p>
				<button onclick="sendMail()" id="button_mail">Send Email</button>
			</div>
		</div>		
	</body>	
</html>