<html>
    <body>
	<h1>HelloWorld Enterprises</h1>

    <?
        session_start();

        function alert($input)
        {
            print("<script type=\"text/javascript\">alert('$input');</script>");
        }

        //comment this line out for older index page, or splash page etc...
        header("Location: main_login.php");

       //alert("Hello");
    ?>


	<p>Try not to destroy anything, you never know what may happen</p>
        <br>
        <div>
            <?php echo "<a href='main_login.php'>PHP Login</a>"; ?>
        </div>
	<hr>
	<a href='LoginPage.html'>HTML Login</a>
	
    </body>
</html>
