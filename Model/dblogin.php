<?php 
	

	include "dbconnection.php";

 	login("Username","Password");
 	
	 function login($username, $password)
	 {
 		$conn = connect(); // from include dbconnection
 		$statement = $conn->prepare("SELECT * FROM registration WHERE Username = ? and Password = ?");  //prepaired statement.
	 	$statement->bind_param("ss",$username,$password);
		$statement->execute(); 
		$records = $statement->get_result();
		return $records->num_rows == 1;
	}

	function getPassword($username)
	 {
 		$conn = connect();  
 		$statement = $conn->prepare("SELECT * FROM registration WHERE Username = ?");
 		$statement->bind_param("s", $username);
		$statement->execute(); 
		$records = $statement->get_result();
		return $records->fetch_all(MYSQLI_ASSOC); // associative array.
	} 

 

 ?>