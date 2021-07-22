<?php 
	

	include "dbconnection.php";
 	
	 function updatePassword($username, $password)
	 {
 		$conn = connect(); 
 		$statement = $conn->prepare("UPDATE users SET password = ? WHERE username = ?");  
	 	$statement->bind_param("ss",$password,$username);
		return ($statement->execute()); 
 	}
 

 ?>