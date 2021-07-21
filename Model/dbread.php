<?php 
	

	include "dbconnection.php";

 
 	
	 function login($username, $password)
	 {
 		$conn = connect(); // from include dbconnection
 		$statement = $conn->prepare("SELECT * FROM users WHERE username = ? and password = ?");  //prepaired statement.
	 	$statement->bind_param("ss",$username,$password);
		$statement->execute(); 
		$records = $statement->get_result();


		return $records->num_rows == 1;
	}
 

 ?>