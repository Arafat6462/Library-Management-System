<?php 
	 include "dbconnection.php";
 
	function getBookId($bookid)
	 {
 		$conn = connect();  
 		$statement = $conn->prepare("SELECT * FROM books WHERE bookid = ?");
 		$statement->bind_param("i", $bookid);
		$statement->execute(); 
		$records = $statement->get_result();
		return $records->fetch_all(MYSQLI_ASSOC); // associative array.
	} 


	function getStudentId($studentId)
	 {
 		$conn = connect();  
 		$statement = $conn->prepare("SELECT * FROM student WHERE studentId = ?");
 		$statement->bind_param("i", $studentId);
		$statement->execute(); 
		$records = $statement->get_result();
		return $records->fetch_all(MYSQLI_ASSOC); // associative array.
	} 


 	function updateBook($numberofcopy, $bookid)
	 {
 		$conn = connect(); 
 		$statement = $conn->prepare("UPDATE books SET numberofcopy = ? WHERE bookid = ?");  
	 	$statement->bind_param("ii",$numberofcopy,$bookid);
		return ($statement->execute()); 
 	}


 	function updateStudent($currentBorrow, $allhistory, $bookid, $studentId)
	 {
 		$conn = connect(); 
 		$statement = $conn->prepare("UPDATE student SET currentBorrow = ?,allhistory = ?,bookid = ? WHERE studentId = ?");  
	 	$statement->bind_param("iiii",$currentBorrow,$allhistory,$bookid, $studentId);
		return ($statement->execute()); 
 	}


 	function getBorrowHistory()
	 {
 		$conn = connect();  
 		$statement = $conn->prepare("SELECT * FROM student");
		$statement->execute(); 
		$records = $statement->get_result();
		return $records->fetch_all(MYSQLI_ASSOC); 
	} 
 


 ?>