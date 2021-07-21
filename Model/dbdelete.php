<?php 
	

	// include "dbconnection.php";
 	
 	 function removeUser($userId)
	 {
 		$conn = connect(); 
 		$statement = $conn->prepare("DELETE FROM users WHERE id = ?");  
	 	$statement->bind_param("i", $userId);
		return ($statement->execute()); 
 

 	}
 

 ?>