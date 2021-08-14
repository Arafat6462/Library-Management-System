<?php
	

	include('../Model/dbbook.php');
 
		$searchID = $_GET['searchid'];

		$book_data = getBookId($searchID);

		// var_dump($book_data);
		// var_dump(json_encode($book_data));
		echo json_encode($book_data);
  
 
?>