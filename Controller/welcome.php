<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>welcome</title>
</head>
<body>
 
	<?php
	/// redirect login for no session
	session_start();
	if(!isset($_SESSION['s_id']))
		header("location:login.php");


 
	// header file.
	 $page = 'welcome';
	 include('../View/html/header.php');

	// session_start();
	echo "welcome  ".$_SESSION['s_id'];
 
 
 	// footer file.
	include('../View/html/footer.html');
	

	?>
	
</body>
</html>