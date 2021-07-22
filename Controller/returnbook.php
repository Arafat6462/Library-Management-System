<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Return Book</title>
</head>
<body>

	<?php
 	include('../View/header.html');
 	include('../Model/dbreturnbook.php');



 	$empty = "";
 	$flag = false;
 	$flag2 = true;
 	$studentlim = "";
 	$bookid = "";
 	$ReturnBookSuccess = "";
 	$noborrow = "";
 	$studentnotfound ="";




 	// confirm to file
	if( isset($_POST['returnborrow']))
	{
		if(!empty($_POST['studentid']))
		{

		  $studentid = $_POST['studentid'];

		  // find student
		  $student_data = getStudentId($studentid);
 	      for ( $i = 0; $i < count($student_data); $i++)
	      {
	         if($student_data[$i]["studentId"] == $studentid)
	         {
	             $flag = true;	 
 				 if($student_data[$i]["currentBorrow"] == 0)
 				  {
 				 	$noborrow = "No Borrow to this student";
 				 	$flag2 = false;
 				 	 
 				  }
 				  else
 				  {
 				  	$bookid = $student_data[$i]["bookid"];
 				  } 
	         }
	      }

		if(!$flag)$studentnotfound = "Student not Found";
 

		
		if($flag and $flag2) //write file
		{
 			$studentid = $_POST['studentid'];
			$res2 = updateStudent(0, -1, $studentid);
 
			$numberofcopy = "";

			$book_data = getBookId($bookid);
	 	      for ( $i = 0; $i < count($book_data); $i++)
		      {
		         if($book_data[$i]["bookid"] == $bookid)
		         	 $numberofcopy = $book_data[$i]["numberofcopy"] ;
		      }
		      $numberofcopy +=1;

			$res = updateBook($numberofcopy, $bookid);	




			if($res and $res2)$ReturnBookSuccess = "Return book success";
		}


	}
	else
		$empty = "Field can't be empty.";
}


 	?>



 	<form action="<?php echo htmlspecialchars(($_SERVER['PHP_SELF'])); ?>" method = "POST">
		<h3><span style="padding: 14px 16px;"> Return book</span></h3>

		<style>
		.center  {
			margin-left: auto;
			margin-right: auto;}
		</style>


		<table class="center">
			<tbody>
		<tr>
 			<td><label for="bookid">Search Student by Id to Return :</label></td>
			<td><input type="text" id="studentid" name="studentid" value="<?php echo $studentid ?>"></td>
 			<td><span style="color: red"><?php echo $noborrow; ?></span>
 			<span style="color: red"><?php echo $studentnotfound; ?></span>
 			<span style="color: red"><?php echo $empty; ?></span></td>
 		</tr>
		<tr>
 			<td><label for="bookid">Book id Read only :</label>
			<td><input type="text" id="bookid" name="bookid" value="<?php echo $bookid ?>" readonly></td>
 			 
		</td>

		<tr>
			<td> <td><input type="submit" name="returnborrow" value="Return Borrow"></td></td>
			<td><span style="color: green"><?php echo $ReturnBookSuccess; ?></span></td>
		</tr>

 
	</tbody>
</table>


	</form>


 	<?php
 	include('../View/footer.html');
 	?>
	
</body>
</html>