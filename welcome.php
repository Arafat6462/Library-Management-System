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
	?>
	
</body>
</html>