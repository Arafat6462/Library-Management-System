<?php 
	 include "dbconnection.php";
 
	

	function getStudentId($studentId)
	 {
 		$conn = connect();  
 		$statement = $conn->prepare("SELECT * FROM student WHERE studentId = ?");
 		$statement->bind_param("i", $studentId);
		$statement->execute(); 
		$records = $statement->get_result();
		return $records->fetch_all(MYSQLI_ASSOC); // associative array.
	} 


	function updateStudent($currentBorrow, $bookid, $studentId)
	 {
 		$conn = connect(); 
 		$statement = $conn->prepare("UPDATE student SET currentBorrow = ?,bookid = ? WHERE studentId = ?");  
	 	$statement->bind_param("iii",$currentBorrow,$bookid,$studentId);
		return ($statement->execute()); 
 	}


 
 	function updateBook($numberofcopy, $bookid)
	 {
 		$conn = connect(); 
 		$statement = $conn->prepare("UPDATE books SET numberofcopy = ? WHERE bookid = ?");  
	 	$statement->bind_param("ii",$numberofcopy,$bookid);
		return ($statement->execute()); 
 	}


 	function getBookId($bookid)
	 {
 		$conn = connect();  
 		$statement = $conn->prepare("SELECT * FROM books WHERE bookid = ?");
 		$statement->bind_param("i", $bookid);
		$statement->execute(); 
		$records = $statement->get_result();
		return $records->fetch_all(MYSQLI_ASSOC); // associative array.
	} 

 


 ?>