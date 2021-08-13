<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Return Book</title>
    <link rel="stylesheet" href="../View/css/returnbook.css?v <?php echo time(); ?>">

</head>
<body>

	<?php
	$page = 'returnbook';
 	include('../View/header.php');
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
 
 <!-- ///////////////////////////////////////////////// -->
 <div class="body">
  <div class="container">
        <div class="header">
            <h2>Return Book</h2>
        </div>


        <form action="<?php echo htmlspecialchars(($_SERVER['PHP_SELF'])); ?>" class="form" id="form" method = "POST"onsubmit="return jsValid();" >
            <div class="form-control">
                <lable>Search Student by Id to Return</lable>
                <input type="text" placeholder="212" id="studentid" name="studentid" value="<?php echo $studentid ?>">
                <img class="check" src="../View/img/checked.svg" alt="Checked">
                <img class="warn" src="../View/img/warn.svg" alt="Error">
                <small>Error message</small>
                <span style="color: red"> <?php echo $noborrow; ?> </span>
                <span style="color: red"> <?php echo $studentnotfound; ?> </span>
                <span style="color: red"> <?php echo $empty; ?> </span>
            </div>  
 
            <div class="form-control">
                <lable>Book id Read only</lable>
                <input type="text" placeholder="Readonly" id="bookid" name="bookid" value="<?php echo $bookid ?>" readonly>
                <img class="check" src="../View/img/checked.svg" alt="Checked">
                <img class="warn" src="../View/img/warn.svg" alt="Error">
                <small>Error message</small>
             </div> 


             <button type="submit" value="Return Borrow"  name="returnborrow" >Return Book</button>
             <span style="color: green;"> <?php echo $ReturnBookSuccess; ?> </span>


 
        </form>
    </div>
    </div>
 
  <!-- ///////////////////////////////////////////////// -->




	<script>
  
     function jsValid() 
     { 
        const form = document.getElementById('form'); // full form
        const studentid = document.getElementById('studentid');
          
 
         
        var flag = true;       
        checkInputs();

 

        function checkInputs() 
        {
            const  studentidValue = studentid.value.trim();   
            const  bookidValue = bookid.value.trim();   
 
            if (studentidValue === ''){
                 setErrorFor(studentid,'Student id cannot be blank');
                flag = false;
            }
             else{
                 setSuccessFor(studentid);
            }
  
         }

         function setErrorFor(input, message)
         {
            const formControl = input.parentElement; // .form-control
            const small = formControl.querySelector('small');

            small.innerText = message;

            formControl.className = 'form-control error';
         } 

         function setSuccessFor(input)
         {
            const formControl = input.parentElement; // .form-control
         
             formControl.className = 'form-control success';
         }

         return flag;
         
    }
 
 
  </script>



 	<?php
 	include('../View/footer.html');
 	?>
	
</body>
</html>