<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Log-in</title>
</head>
<body>
	<h1>Log-in Form</h1>
	
	<?php

		// sign up message with session
	session_start();
	$signupStatus = $_SESSION['signupStatus'];
	

	$c_id = $c_pass = "";

		// try to auto login from cookies id, pass if have.
		// remove pass from cookies later.-----------
	if(isset($_COOKIE['c_id']) and isset($_COOKIE['c_pass']))
	{
		$c_id = $_COOKIE['c_id'];
		$c_pass = $_COOKIE['c_pass'];
	}	 

		// login failed message with session
	$loginFailed = $_SESSION['loginFailed'];
		session_destroy(); // destroy for delete session message.
		
		?>
		
		<form action="loginValidation.php" method = "POST">
			<span style="color: green"><?php echo $signupStatus; ?></span><br><br>
			
			
			<label for="Username">Username:</label>
			<input type="text" id="Username" name="Username" value="<?php echo $c_id ?>" required><br>

			<label for="Password">Password:</label>
			<input type="Password" id="Password" name="Password" value="<?php echo $c_pass ?>" required><br>

			<br>
			<input type="checkbox" name="remember" id="remember" value="1">
			<label for="remember">Remember Me</label><br>

			<input type="submit" name="login" value="Log-in">

			<span style="color: red"><?php echo $loginFailed; ?></span>
			<span style="color: green"><?php echo "<br><br><br>click here to <a href = 'signup.php'>Sign-up</a>" ?></span>


			
			
		</form>
	</body>
	</html>