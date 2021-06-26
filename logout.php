 
<?php
session_start();

	// destroy session
session_destroy();

	// destroy cookies
if(isset($_COOKIE['c_id']) and isset($_COOKIE['c_pass']))
{
	$c_id = $_COOKIE['c_id'];
	$c_pass = $_COOKIE['c_pass'];
	
	setcookie('c_id', $c_id, time()-1);
	setcookie('c_pass', $c_pass, time()-1);

}
		// log-in
header("location:login.php"); 

?>

