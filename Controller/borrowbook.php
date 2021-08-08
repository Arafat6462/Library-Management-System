<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Borrow Book</title>
</head>
<body>
	<?php
	$page = 'borrowbook';
 	include('../View/header.php');
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

	$studentidErr = $bookidErr = "";





	// search book
 	if(isset($_POST['confirmborrow']))
	{
		if(!empty($_POST['bookid']))
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
			if(count($book_data) == 0) $booknotfound = "Book Not Found.";
		}
		else $bookidErr = "book Id can not be empty";

		
	}

	// search student
	if(isset($_POST['confirmborrow']) and !empty($_POST['studentid']))
	{
		if(!empty($_POST['studentid']))
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
			if(count($student_data) == 0)$studentnotfound = "Student Not Found";
		}
		else $studentidErr = "Student Id can not be empty";
		
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

	<form action="<?php echo htmlspecialchars(($_SERVER['PHP_SELF'])); ?>" method = "POST" name="BorrowBook" onsubmit="return jsValid();">
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
 			<span style="color: red"><?php echo $booknotfound; ?></span>
 			<span style="color: red"><?php echo $bookidErr; ?></span>
 			<span style="color: red"><?php echo $booklim; ?></span>
 			<span id="bookidErr" style="color: red;"></span></td>
		</tr>
		<tr>
 			<td><label for="bookid">Search Student by Id to borrow :</label>
			<td><input type="text" id="studentid" name="studentid" value="<?php echo $studentid ?>"></td>
 			<td><span style="color: green"><?php echo $studentfound; ?></span>
 			<span style="color: red"><?php echo $studentnotfound; ?></span>
 			<span style="color: red"><?php echo $studentidErr; ?></span>
 			<span style="color: red"><?php echo $studentlim; ?></span>
 			<span id="studentidErr" style="color: red;"></span></td>
		</td>

		<tr>
			<td> <td><input type="submit" name="confirmborrow" value="Confirm Borrow"></td></td>
			<td><span style="color: green"><?php echo $BorrowBookSuccess; ?></span></td>
		</tr>

 
	</tbody>
</table>


	</form>

	


<script>
    
    function jsValid() 
    { 
        var bookid = document.forms["BorrowBook"]["bookid"].value;
        var studentid = document.forms["BorrowBook"]["studentid"].value;
        
        if (bookid === "") 
        {
            document.getElementById('bookidErr').innerHTML = "bookid can not be empty.";
            return false;
        }  
        if (studentid === "") 
        {
            document.getElementById('studentidErr').innerHTML = "studentid can not be empty.";
            return false;
        } 
    }
 
  </script>


	<?php
 	include('../View/footer.html');
	?>
</body>
</html>