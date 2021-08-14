<?php 
	 include "dbconnection.php";
 
	function getProfileData($profileID)
	 {
 		$conn = connect();  
 		$statement = $conn->prepare("SELECT * FROM registration WHERE Username = ?");
 		$statement->bind_param("s", $profileID);
		$statement->execute(); 
		$records = $statement->get_result();
		return $records->fetch_all(MYSQLI_ASSOC); // associative array.
	} 
 


 	function updateProfile($Firstname,$Lastname,$Gender,$DOB,$Religion,$Presentaddress,$Permanentaddress,$Phone,$Email,$Website,$Username,$id)
	 {
 		$conn = connect(); 
 		$statement = $conn->prepare("UPDATE registration SET Firstname = ?,Lastname = ?,Gender = ?,DOB = ?,Religion = ?,Presentaddress = ?,Permanentaddress = ?,Phone = ?,Email = ?,Website = ? ,Username = ? WHERE Username = ?");  
	 	$statement->bind_param("sssssssissss",$Firstname,$Lastname,$Gender,$DOB,$Religion,$Presentaddress,$Permanentaddress,$Phone,$Email,$Website,$Username,$id);
		return ($statement->execute()); 
 	}
 

 


 ?>