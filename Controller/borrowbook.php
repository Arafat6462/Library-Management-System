<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Borrow Book</title>
    <link rel="stylesheet" href="../View/css/borrowbook.css?v <?php echo time(); ?>">
    <script src="../View/js/borrowbook.js"></script>


</head>
<body>
	<?php

	/// redirect login for no session
	session_start();
	if(!isset($_SESSION['s_id']))
		header("location:login.php");

	$page = 'borrowbook';
 	include('../View/html/header.php');
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
 
 <!-- ///////////////////////////////////////////////// -->
 <div class="body">
  <div class="container">
        <div class="header">
            <h2>Borrow Book</h2>
        </div>


        <form action="<?php echo htmlspecialchars(($_SERVER['PHP_SELF'])); ?>" class="form" id="form" method = "POST"onsubmit="return jsValid();" >

        	<div class="form-control">
                <lable>Search Student by Id to borrow</lable>
                <input type="text" placeholder="212" id="studentid" name="studentid" value="<?php echo $studentid ?>">
                <img class="check" src="../View/img/checked.svg" alt="Checked">
                <img class="warn" src="../View/img/warn.svg" alt="Error">
                <small>Error message</small>
                <span style="color: green"> <?php echo $studentfound; ?> </span>
                <span style="color: red"> <?php echo $studentnotfound; ?> </span>
                <span style="color: red"> <?php echo $studentidErr; ?> </span>
                <span style="color: red"> <?php echo $studentlim; ?> </span>
            </div> 


            <div class="form-control">
                <lable>Search Book by Id to borrow</lable>
                <input type="text" placeholder="1001" id="bookid" name="bookid" value="<?php echo $bookid ?>">
                <img class="check" src="../View/img/checked.svg" alt="Checked">
                <img class="warn" src="../View/img/warn.svg" alt="Error">
                <small>Error message</small>
                <span style="color: green;"> <?php echo $bookfound; ?> </span>
                <span style="color: red"> <?php echo $booknotfound; ?> </span>
                <span style="color: red"> <?php echo $bookidErr; ?> </span>
                <span style="color: red"> <?php echo $booklim; ?> </span>
            </div>  
 

             <button type="submit" value="Confirm Borrow"  name="confirmborrow" >Confirm Borrow</button>
             <span style="color: green;"> <?php echo $BorrowBookSuccess; ?> </span>
 
 
        </form>
    </div>
    </div>
 
  <!-- ///////////////////////////////////////////////// -->

	<?php
 	include('../View/html/footer.html');
	?>
</body>
</html>