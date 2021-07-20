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
	if(isset($_COOKIE['c_id']))
	{
		$c_id = $_COOKIE['c_id'];

		// fetch password from json file.
		$fetch_data = json_decode(file_get_contents("../Model/signup_info.json"));
		foreach ($fetch_data as $key  )
		{
			if($key->Username == $c_id)
			{
				$c_pass = $key->Password;
 			}

		}

	}	 

	// login failed message with session
	$loginFailed = $_SESSION['loginFailed'];
		session_destroy(); // destroy for delete session message.
		
		?>
		
		<form action="loginValidation.php" method = "POST">
			<span style="color: green"><?php echo $signupStatus; ?></span><br><br>
			
		<table>
      	 <tbody>
			
			<tr>
            <td><label for="Username">Username:</label></td>
			<td><input type="text" id="Username" name="Username" value="<?php echo $c_id ?>" required></td>
			</tr>

			<tr>
            <td><label for="Password">Password:</label></td>
			<td><input type="Password" id="Password" name="Password" value="<?php echo $c_pass ?>" required></td>
			</tr>

 			<tr>
            <td></td>
            <td><input type="checkbox" name="remember" id="remember" value="1">
			<label for="remember">Remember Me</label></td>
			</tr>


			<tr><td></td></tr>

			<tr>
            <td></td>
            <td><span style="float: right;"><input type="submit" name="login" value="Log-in"></span></td>
       		</tr>

		</tbody>
	</table>

			<span style="color: red"><?php echo $loginFailed; ?></span>
			<span style="color: green"><?php echo "<br><br><br>click here to <a href = 'signup.php'>Sign-up</a>" ?></span>


			
			
		</form>
	</body>
	</html>