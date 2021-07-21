<?php 
	 include "dbconnection.php";

	 function getAllBooks()
	 {
 		$conn = connect();  
 		$statement = $conn->prepare("SELECT * FROM books");
		$statement->execute(); 
		$records = $statement->get_result();
		return $records->fetch_all(MYSQLI_ASSOC); // associative array.
	} 

	

	// function getBookId($bookid)
	//  {
 // 		$conn = connect();  
 // 		$statement = $conn->prepare("SELECT * FROM books WHERE bookid = ?");
 // 		$statement->bind_param("i", $bookid);
	// 	$statement->execute(); 
	// 	$records = $statement->get_result();
	// 	return $records->fetch_all(MYSQLI_ASSOC); // associative array.
	// } 


	///////////////
	 //   $c_id = "Arafat";
	 //   $fetch_data = getPassword($c_id);
	     
 
	 //   foreach ($fetch_data as $array  )
		// {	 
		// 	foreach ($array as $key => $value) 
		// 	{				  
 	// 			if($key == "Username" )
		// 		{
		// 			$c_pass = $value;
		// 			echo $c_pass;
 	//  			}
				 
		// 	}			 
		// }

		// for ($i=0; $i < count($fetch_data); $i++) { 
		// 		if($fetch_data[$i]["Username"] === $c_id);
		// 		echo "found ".$fetch_data[$i]["Password"];
		// }



		// var_dump($fetch_data);echo "<br>";echo "<br>";
		// $fetch_data = json_encode($fetch_data);
		// $fetch_data = json_decode($fetch_data);
		// var_dump($fetch_data);echo "<br>";echo "<br>";
		// var_dump(json_decode($fetch_data));
 
		// foreach ($fetch_data as $key  )
		// {
		// 	// var_dump($key[0][0]);
		// 	if($key->Username == $c_id)
		// 	{
		// 		// $c_pass = $key->Password;
		// 		echo "HI";
 	// 		}

		// }



 ?>