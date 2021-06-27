	 
	<?php
	session_start();

	// destroy session
	session_destroy();

	// destroy cookies
	if(isset($_COOKIE['c_id']) )
	{
		$c_id = $_COOKIE['c_id'];
 		
		setcookie('c_id', $c_id, time()-1);
 
	}
	// log-in
	header("location:login.php"); 

	?>

