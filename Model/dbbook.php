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


	function AddBook($bookname,$authorname,$edition,$numberofcopy,$shelfno,$bookid)
	{
		$conn = connect(); // from include dbconnection
		$statement = $conn->prepare("INSERT INTO books (bookname,authorname,edition,numberofcopy,shelfno,bookid)VALUES(?,?,?,?,?,?)"); 
	 	$statement->bind_param("sssiii",$bookname,$authorname,$edition,$numberofcopy,$shelfno,$bookid);
		return $statement->execute();
  	}


  	function getAllBooks()
	 {
 		$conn = connect();  
 		$statement = $conn->prepare("SELECT * FROM books");
		$statement->execute(); 
		$records = $statement->get_result();
		return $records->fetch_all(MYSQLI_ASSOC); 
	} 


	function removeBook($userId)
	 {
 		$conn = connect(); 
 		$statement = $conn->prepare("DELETE FROM books WHERE bookid = ?");  
	 	$statement->bind_param("i", $userId);
		return ($statement->execute()); 
 	}


 	function updateBook($bookname,$authorname,$edition,$numberofcopy,$shelfno,$bookid)
	 {
 		$conn = connect(); 
 		$statement = $conn->prepare("UPDATE books SET bookname = ?,authorname = ?,edition = ?,numberofcopy = ?,shelfno = ? WHERE bookid = ?");  
	 	$statement->bind_param("ssiiii",$bookname,$authorname,$edition,$numberofcopy,$shelfno,$bookid);
		return ($statement->execute()); 
 	}
 

 


 ?>