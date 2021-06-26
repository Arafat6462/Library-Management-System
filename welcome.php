<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>welcome</title>
</head>
<body>
	<h1>Welcome</h1>

	<?php
	session_start();
	echo "welcome  ".$_SESSION['s_id']. $_SESSION['s_pass'];
	echo "<br><a href = 'logout.php'>Logout</a>";




 		 
	// fetch password from json file. and update.
	$fetch_data = json_decode(file_get_contents("signup_info.json"));

	foreach ($fetch_data as $key )
	{
		$name = "Arafat";
 		if($key->Firstname ==  $name)
 		{
 			$key->Firstname = "nipu";
  		}
	}

	 
	


 	echo "<br><a href = 'changePassword.php'>Change password</a>";
 


 

	?>
	
</body>
</html>