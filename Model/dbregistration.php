<?php 
	

	include "dbconnection.php";
	 
	
	function register($Firstname,$Lastname,$Gender,$DOB,$Religion,$Presentaddress,$Permanentaddress,$Phone,$Email,$Website,$Username,$Password)
	{
		$conn = connect(); // from include dbconnection
		$statement = $conn->prepare("INSERT INTO  registration (Firstname,Lastname,Gender,DOB,Religion,Presentaddress,Permanentaddress,Phone,Email,Website,Username,Password)VALUES(?,?,?,?,?,?,?,?,?,?,?,?)"); 
	 	$statement->bind_param("sssssssissss",$Firstname,$Lastname,$Gender,$DOB,$Religion,$Presentaddress,$Permanentaddress,$Phone,$Email,$Website,$Username,$Password);
		return $statement->execute();
  	}

  	


 ?>