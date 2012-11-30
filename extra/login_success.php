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

			function logout()
			{
				window.location="../ajax/logout.php";
			}
		</script>

	</head>

	<body>
		<div class="navbar navbar-fixed-top navbar-inverse">
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
							 						
							<button class="btn btn-inverse" onclick="logout()">Logout</button>

							<!--<li class="active"><a href="../ajax/logout.php">Logout</a></li>-->
						</ul>
						<!--<ul class="nav pull-right">
							<li class="active">Signed in as_<?php echo $_SESSION['user'] ?></li>
						</ul>-->
					</div><!-- /.nav-collapse -->
				</div>
			</div>
		</div>

		<div class="container">
			<div class="row">
				<div class="span7" id="user_list">
					<!-- List of Users Here  style="background-color:#FFD700;height:550px;width=600px;float:left;" -->
					<div id="txtHint" style="float:left;" onload="setFocus('name_field')">
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
					echo "<legend><h3><b>List of Users</b></h3></legend>";
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
					?>
					</div>
				</div>	
				<div class="span5" id="details" style="float:right;">					
					<legend><h3>Select a user from the List</h3></legend>
					<form class="well">
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
						<button class="btn btn-primary" type="button" onclick="addUser()">Add New User</button>		
					</form>	
				</div>
				<br>
				<div class="row">
					<div class="span5" id="email_notify">
						<legend><h4>Send an email to a user.</h4></legend>
						<form class="well" action="../ajax/mail_user.php" method="post">
							<fieldset>								
								<div class="control-group">
									<div class="controls">
										<select id="target_user" name="target_user">
											<?php
												$sql="SELECT Name,Username FROM UserDetails";
												$result=mysql_query($sql);
												echo "<option selected= \"selected\"value=\"all_users\">Select User</option>";
												$counter=0;
												while($row=mysql_fetch_array($result))
												{			
													$counter++;					
													echo "<option value=\"".$row['Username']."\">".$row['Name']."</option>";
												}
												mysql_close($db_connection);
											?>
										</select>

										<!--<input onkeyup="showHint(this.value)" type="text" name="target_user" class="input-large" placeholder="Username...">-->
									</div>
								</div>
								<div class="control-group">
									<div class="controls">
										<input type="text" name="subject" class="input-large" placeholder="Subject...">
									</div>
								</div>
								<div class="control-group">
									<div class="controls">
										<textarea class="input-xlarge" name="textarea" id="mail_msg" rows="5" placeholder="Type Message..."></textarea>
									</div>
								</div>
								<div class="control-group">
									<div class="controls">
										<input class="btn btn-info" type="submit" value="Send Email">
									</div>
								</div>
							</fieldset>
						</form>
					</div>				
			</div>	
			</div>			

			<!--<footer style="background-color:#FFA500;text-align:center;clear:both;">
				<p>Copyright &copy; Nathan Floor 2012</p>			
			</footer>-->

			<div class="navbar navbar-fixed-bottom navbar-inverse">
				<div class="navbar-inner">
					<div class="container">
						<p style="text-align:center;clear:both;">Copyright &copy; Nathan Floor 2012</p>
					</div>
				</div>
			</div>

		</div><!-- /container -->

		<!-- Le javascript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
		<script src="../bootstrap/js/bootstrap.min.js"></script>
	</body>	
</html>

<?php
	//check if any alerts are needed
	echo "<script type=\"text/javascript\">";
	if($_SESSION['mail_success']=1 && isset($_SESSION['target_user']))
		echo "	alert('Successfuly sent email to ".$_SESSION['target_user']."');";
	else
		echo " 	alert('Failed to send email to ".$_SESSION['target_user']."');";
	echo "</script>";

	mysql_close($db_connection);
?>