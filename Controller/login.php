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
 
	session_destroy(); // destroy for delete session message.

	// use as database
	$j_id = "";
	$j_pass = "";
	$loginFailed = "";
	$isValid = true;
	$f_id = $f_pass = "";
	$f_idErr = $f_passErr = "";



if ($_SERVER['REQUEST_METHOD'] === "POST")
{
	// get data from html form	
	$f_id = $_POST['Username'];
	$f_pass = $_POST['Password'];

	if(empty($f_id))
       {
          $f_idErr = "username can not be empty";
          $isValid = false;
       }
	if(empty($f_pass))
       {
          $f_passErr = "password can not be empty";
          $isValid = false;
       }

       $f_id = basic_validation($f_id);
       $f_pass = basic_validation($f_pass);

       if($isValid)
       {
 	       	// fetch id password from json file.
			$fetch_data = json_decode(file_get_contents("../Model/signup_info.json")); 
			foreach ($fetch_data as $key )
			{
				if($key->Username == $f_id)
				{
					$j_id = $key->Username;
					$j_pass = $key->Password;
				}
			}

			// check input with database.
			if($f_id == $j_id and $f_pass == $j_pass)
			{
				// if correct and remember store in cookies
				if(isset($_POST['remember']))
				{
					setcookie('c_id', $f_id, time()+60*60);
		 			
				}

				// log-in to welcome with id,pass
				session_start();
				$_SESSION['s_id'] = $f_id;
				$_SESSION['s_pass'] = $f_pass;
				header("location:welcome.php"); 

			}
			else $loginFailed = "username or password is Invalid";
			

       }
   	
}

	 // validate input
    function basic_validation($data)
    {
        $data = trim($data);
        $data = htmlspecialchars($data);
        $data = stripcslashes($data);
        return $data;
    }
 
?>


		
		<form action="<?php echo htmlspecialchars(($_SERVER['PHP_SELF'])); ?>" method = "POST">
			<span style="color: green"><?php echo $signupStatus; ?></span><br><br>
			
		<table>
      	 <tbody>
			
			<tr>
            <td><label for="Username">Username:</label></td>
			<td><input type="text" id="Username" name="Username" value="<?php echo $c_id ?>">
			<span style="color: red"> <?php echo $f_idErr; ?> </span></td>
			</tr>

			<tr>
            <td><label for="Password">Password:</label></td>
			<td><input type="Password" id="Password" name="Password" value="<?php echo $c_pass ?>">
			<span style="color: red"> <?php echo $f_passErr; ?> </span></td>
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