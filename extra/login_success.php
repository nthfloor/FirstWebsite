<?php
session_start();
//check if trying to access this page directly without logging in.
if(!isset($_SESSION['user']))
{
	header("location: ../signin.html");
	die();
}	

//uses javascripts alert function
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

<html lang="en">
	<head>
		<meta charset="utf=8">
		<title>Template</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="User Account Management Service">
		<meta name="author" content="Nathan Floor">

		<!-- Le styles -->
		<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">

		<style type="text/css">
			body{
				padding-top: 60px;
				padding-bottom: 40px;
			}
		</style>

		<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">

		<!-- Le HTML, for IE6-8 support -->
		<!--[if lt IE 9]>
      		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    	<![endif]-->

    	<script type="text/javascript">
			//ajax for adding new user
			function addUser()
			{			
				if(window.XMLHttpRequest)
				{
					xmlhttp = new XMLHttpRequest();
				}
				else
				{
					xmlhttp=new ActiveXObject("Microsoft.XMLHttp");
				}

				xmlhttp.onreadystatechange=function()
				{
					if(xmlhttp.readyState==4 && xmlhttp.status==200)
					{
						document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
					} 
				}
				xmlhttp.open("GET","../ajax/save_details.php",true);
				xmlhttp.send();
			}

			//ajax drop-down list script
			function showUser(str)
			{
				if(str.length==0)
				{
					document.getElementById("txtHint").innerHTML="";
					return;
				}
				
				if(window.XMLHttpRequest)
				{
					xmlhttp = new XMLHttpRequest();
				}
				else
				{
					xmlhttp=new ActiveXObject("Microsoft.XMLHttp");
				}

				xmlhttp.onreadystatechange=function()
				{
					if(xmlhttp.readyState==4 && xmlhttp.status==200)
					{
						document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
					} 
				}
				xmlhttp.open("GET","../ajax/getuser.php?q="+str,true);
				xmlhttp.send();
			}

			function setFocus(object)
			{
				document.getElementById(object).focus();
			}
		</script>

	</head>

	<body>
		<div class="navbar navbar-fixed-top">
			<div class="navbar-inner">
				<div class="container">
					<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</a>
					<a class="brand" href="#">Dashboard for Managing User Accounts</a>
					<div class="nav-collapse">
						<ul class="nav pull-right">
						<li class="active"><a href="../ajax/logout.php">Logout</a></li>
						</ul>
					</div><!-- /.nav-collapse -->
				</div>
			</div>
		</div>

		<div class="container">
			<div class="row">
				<div class="span3" id="user_list" style="background-color:#FFD700;height:550px;width=600px;float:left;">
					<!-- List of Users Here-->
					<div id="txtHint" style="height:500px;width:500px;float:left;">
					<?php

					$db_connection = mysql_connect("localhost","root","password");
					if(! $db_connection)
					{
						die('Could not connect to: '.mysql_error());
					}
					mysql_select_db("my_db",$db_connection);

					$sql="SELECT * FROM UserDetails";
					$result = mysql_query($sql);
					//loop throug query results and display them in a table.
					echo "<h3><b>List of Users</b></h3><hr>";
					echo "<table border='1' class=\"table\">";
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
					?>
					</div>
				</div>	
				<div class="span3" id="details" style="background-color:#EEEEEE;height:300px;width:500px;float:left;">
					<h3>Select a user from the List</h3>
					<form>
						<select name="users" onchange="showUser(this.value)" id="user_list">
							<?php
								$sql="SELECT Name,Username FROM UserDetails";
								$result=mysql_query($sql);
								echo "<option selected= \"selected\"value=\"all_users\">All Users</option>";
								$counter=0;
								while($row=mysql_fetch_array($result))
								{			
									$counter++;					
									echo "<option value=\"".$row['Username']."\">".$row['Name']."</option>";
								}
							?>
						</select>
						<button type="button" onclick="addUser()">Add New User</button>		
					</form>	
				</div>
				<div class="span3" id="email_notify" style="background-color:red;">
					<p>You can send an email to the user informing them of their login status.</p>
					<button onclick="sendMail()" id="button_mail">Send Email</button>
				</div>
			</div>
			<br>

			<footer style="background-color:#FFA500;text-align:center;clear:both;">
				<p>Copyright &copy; Nathan Floor 2012</p>			
			</footer>
		</div><!-- /container -->

		<!-- Le javascript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
		<script src="../bootstrap/js/bootstrap.min.js"></script>
	</body>	
</html>

<?php
	mysql_close($db_connection);
?>