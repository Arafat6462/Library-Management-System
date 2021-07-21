<?php 
	

	include "dbconnection.php";
	//  echo "hiii";
	// // $Phone = 01323;
	// // register( "Firstname", "Lastname", "Gender", "2021-05-31", "Religion", "Present_Address", "Permanent_Address", $Phone, "Email", "Website", "Username1", "Password");
	//  function register2($Firstname,$Lastname,$Gender,$DOB,$Religion,$Presentaddress,$Permanentaddress,$Phone,$Email,$Website,$Username,$Password)
	// {
	// 	echo $Firstname." ".$Lastname." ".$Gender." ".$DOB." ".$Religion." ".$Presentaddress." ".$Permanentaddress." ".$Phone." ".$Email." ".$Website." ".$Username." ".$Password;
	// }
	
	function register($Firstname,$Lastname,$Gender,$DOB,$Religion,$Presentaddress,$Permanentaddress,$Phone,$Email,$Website,$Username,$Password)
	{
		$conn = connect(); // from include dbconnection
		// $statement = $conn->prepare("INSERT INTO users (username,password) VALUES (?,?)"); //prepaired statement.

		$statement = $conn->prepare("INSERT INTO  registration (Firstname,Lastname,Gender,DOB,Religion,Presentaddress,Permanentaddress,Phone,Email,Website,Username,Password)VALUES(?,?,?,?,?,?,?,?,?,?,?,?)"); 

	 	// $statement->bind_param("ss",$username,$password);//bind ss->for data type string->s

	 	$statement->bind_param("sssssssissss",$Firstname,$Lastname,$Gender,$DOB,$Religion,$Presentaddress,$Permanentaddress,$Phone,$Email,$Website,$Username,$Password);

		return $statement->execute();





  }

 ?>