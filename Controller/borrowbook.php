<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Borrow Book</title>
</head>
<body>
	<?php
 	include('../View/header.html');
 	include('../Model/dbborrowbook.php');

 	$bookid = "";
 	$studentid = "";
 	$booknotfound = "";
 	$bookfound = "";
 	$studentnotfound = "";
 	$studentfound = "";
	$flag1 = false;
	$flag2 = false;
	$flag3 = true;
	$booklim = "";
	$studentlim = "";
	$BorrowBookSuccess = "";

	$numberofcopy = "";
	$currentBorrow = "";
	$allhistory = "";


	// search book
 	if(isset($_POST['confirmborrow']) and !empty($_POST['bookid']))
	{
		$bookid = $_POST['bookid'];

		$book_data = getBookId($bookid);
 	      for ( $i = 0; $i < count($book_data); $i++)
	      {
	         if($book_data[$i]["bookid"] == $bookid)
	         {
	         	 $numberofcopy = $book_data[$i]["numberofcopy"] ;
	             $flag1 = true;
 				 if($book_data[$i]["numberofcopy"] < 2)
 				 {
 				 	$booklim = "Book not available";
 				 	$flag1 = false;
 				 }
	         }
	      }

		 
		if($flag1)$bookfound = "Book Found";
		// else $booknotfound = "Book Not Found.";

	}

	// search student
	if(isset($_POST['confirmborrow']) and !empty($_POST['studentid']))
	{
		$studentid = $_POST['studentid'];
 
		 $student_data = getStudentId($studentid);
 	      for ( $i = 0; $i < count($student_data); $i++)
	      {
	         if($student_data[$i]["studentId"] == $studentid)
	         {
	              $flag2 = true;
	              $currentBorrow = $student_data[$i]["currentBorrow"];
	              $allhistory = $student_data[$i]["allhistory"];
 				  if($student_data[$i]["currentBorrow"] > 0)
 				  {
 				 	$studentlim = "Borrow limit full";
 				 	$flag2=false;
 				 	$flag3= false;
 				  }
	         }
	      }
 
		if($flag2)$studentfound = "Student Found";
		// else if($flag3)$studentnotfound = "Student Not Found";

	}


	// confirm to file
	if( isset($_POST['confirmborrow']) and $flag1 and $flag2)
	{
		$numberofcopy -=1;
		$currentBorrow +=1;
		$allhistory +=1;
	 
		$res = updateBook($numberofcopy, $bookid);	
		$res2 = updateStudent($currentBorrow, $allhistory,$bookid, $studentid);

  		if($res and $res2)$BorrowBookSuccess = "Borrow book success";
	}


		 
	?>

	<form action="<?php echo htmlspecialchars(($_SERVER['PHP_SELF'])); ?>" method = "POST">
		<h3><span style="padding: 14px 16px;"> Borrow book</span></h3>

		<style>
		.center  {
			margin-left: auto;
			margin-right: auto;}
		</style>


		<table class="center">
			<tbody>
		<tr>
 			<td><label for="bookid">Search Book by Id to borrow :</label></td>
			<td><input type="text" id="bookid" name="bookid" value="<?php echo $bookid ?>"></td>
 			<td><span style="color: green"><?php echo $bookfound; ?></span>
 			<span style="color: red"><?php echo $booklim; ?></span></td>
		</tr>
		<tr>
 			<td><label for="bookid">Search Student by Id to borrow :</label>
			<td><input type="text" id="studentid" name="studentid" value="<?php echo $studentid ?>"></td>
 			<td><span style="color: green"><?php echo $studentfound; ?></span>
 			<span style="color: red"><?php echo $studentlim; ?></span></td>
		</td>

		<tr>
			<td> <td><input type="submit" name="confirmborrow" value="Confirm Borrow"></td></td>
			<td><span style="color: green"><?php echo $BorrowBookSuccess; ?></span></td>
		</tr>

 
	</tbody>
</table>


	</form>

	



	<?php
 	include('../View/footer.html');
	?>
</body>
</html>