<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>welcome</title>
</head>
<body>
 
	<?php

	// header file.
	include('../View/header.html');

	session_start();
	echo "welcome  ".$_SESSION['s_id'];
 



 		 
	// fetch password from json file. and update.
	$fetch_data = json_decode(file_get_contents("../Model/signup_info.json"));

	foreach ($fetch_data as $key )
	{
		$name = "Arafat";
 		if($key->Firstname ==  $name)
 		{
 			$key->Firstname = "nipu";
  		}
	}

	 
	


 	 


 	// footer file.
	include('../View/footer.html');
	

	?>
	
</body>
</html>