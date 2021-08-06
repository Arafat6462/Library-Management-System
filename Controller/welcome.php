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
 
 
 	// footer file.
	include('../View/footer.html');
	

	?>
	
</body>
</html>