<?php 

function connect()
{
 	 $conn = new mysqli("localhost","Arafat","123","library"); // host, user, user pass, database name.
	 if($conn->connect_errno)
	 {
	 	die ("Connection failed due to ". $conn->connect_error);
	 }
	 
	 // echo "Database connetion successful";
	 // $conn->close();

	 return $conn;
	}
?>