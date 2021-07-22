<?php 
	

	include "dbconnection.php";

	 function updatePassword($username, $password)
	 {
  		$conn = connect(); 
 		$statement = $conn->prepare("UPDATE registration SET Password = ? WHERE Username = ?");  
	 	$statement->bind_param("ss",$password,$username);
		return ($statement->execute()); 
 	}
 

 ?>