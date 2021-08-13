<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Update Book Info</title>
   <link rel="stylesheet" href="../View/css/updatebook.css?v <?php echo time(); ?>">

</head>
<body>

	<?php
		// header file.
	$page = 'updatebook';
	include('../View/header.php');
	include('../Model/dbbook.php');

	$searchID = "";
	$searchIDErr = "";
 
	$bookname = "";
	$authorname = "";
	$edition = "";
	$numberofcopy = "";
	$shelfno = "";
	$bookno = "";

	$updateBookSuccess = "";
	$updateBookFailed = "";
	$isValid = true;

 

	if(isset($_POST['updatebook']))
	{


		///////////////////////

		$bookname =$_POST['bookname'];
		$authorname = $_POST['authorname'];
		$edition = $_POST['edition'];
		$numberofcopy = $_POST['numberofcopy'];
		$shelfno = $_POST['shelfno'];
		$bookno = $_POST['bookno'];
 
 

         if(empty($bookname)  )
         {
            $booknameErr = "book name can not be empty.";
            $isValid = false;
         }
         if( strlen($bookname) > 100)
         {
            $booknameErr = "book name can not be > 100 Character.";
            $isValid = false;
         }
      if(empty($authorname) )
         {
            $authornameErr = "author name can not be empty.";
            $isValid = false;
         }
         if( strlen($authorname) > 50)
         {
            $authornameErr = "author name can not be > 50 Character.";
            $isValid = false;
         }
      if(empty($edition)  )
         {
            $editionErr = "edition can not be empty.";
            $isValid = false;
         }
         if( strlen($edition) > 10)
         {
            $editionErr = "edition can not be > 10 Character.";
            $isValid = false;
         }
      if(empty($numberofcopy) )
         {
            $numberofcopyErr = "number of copy can not be empty.";
            $isValid = false;
         }
         if(strlen($numberofcopy > 10) )
         {
            $numberofcopyErr = "number of copy can not be > 10 Character.";
            $isValid = false;
         }
      if(empty($shelfno))
         {
            $shelfnoErr = "shelf no can not be empty.";
            $isValid = false;
         }
         if( strlen($shelfno) > 10)
         {
            $shelfnoErr = "shelf no can not be > 10 Character.";
            $isValid = false;
         }
      if(empty($bookno))
         {
            $booknoErr = "book id can not be empty.";
            $isValid = false;
         }
         if( strlen($bookno) > 10)
         {
            $booknoErr = "book id can not be > 10 Character.";
            $isValid = false;
         }

      $bookname = basic_validation($bookname);
      $authorname = basic_validation($authorname);
      $edition = basic_validation($edition);
      $numberofcopy = basic_validation($numberofcopy);
      $shelfno = basic_validation($shelfno);
      $bookno = basic_validation($bookno);

		////////////////////


 
      if($isValid)
      {
			session_start();
			$bookno = $_SESSION['bookid']; // not changing book id
			session_destroy();


			// update book ifno.
			$res = updateBook($bookname,$authorname,$edition,$numberofcopy,$shelfno,$bookno);
 	
   		if($res)$updateBookSuccess = "Update book success";
  			else $updateBookFailed = "Update book Failed";

		}

	}

	if(isset($_POST['search']))
	{
		$searchID = $_POST['searchid'];


		 if(empty(basic_validation($searchID)))
         {
            $searchIDErr = "searchID can not be empty.";
            $isValid = false;
         }

     	 // $bookname = basic_validation($bookname);

     	 if($isValid)
     	 {	  
	   	// fetch data from json file to check multiple book id.
			$book_data = getBookId($searchID);
			for ( $i = 0; $i < count($book_data); $i++)
      	{ 
				if($book_data[$i]["bookid"] == $searchID)
				{
					$bookname= $book_data[$i]["bookname"];
					$authorname=$book_data[$i]["authorname"];
					$edition=$book_data[$i]["edition"];
					$numberofcopy= $book_data[$i]["numberofcopy"];
					$shelfno=$book_data[$i]["shelfno"];
					$bookno=$book_data[$i]["bookid"];

					session_start(); // book id can't be change
                    $_SESSION['bookid'] = $bookno;
				}
			}
	}
	}



	// validate input
    function basic_validation($data)
    {
        $data = trim($data);
        $data = htmlspecialchars($data);
        $data = stripcslashes($data);
        return $data;
    }
 
	?>


	<form action="<?php echo htmlspecialchars(($_SERVER['PHP_SELF'])); ?>" method = "POST"  name="SearchBook" onsubmit="return jsIdValid();">
		<h3><span style="padding: 14px 16px;"> Updatae book</span></h3>

		<span style="padding: 14px 16px;">
			<label for="searchid">Search by Book Id:</label>
			<input type="text" id="searchid" name="searchid" value="<?php echo $searchID ?>">
			<input type="submit" name="search" value="search">
			<span style="color: red"> <?php echo $searchIDErr; ?></span>
			<span id="searchidErr" style="color: red;"></span>

		</span>


	</form>




 


 <!-- ///////////////////////////////////////////////// -->
 <div class="body">
  <div class="container">
        <div class="header">
            <h2>Update book</h2>
        </div>


        <form action="<?php echo htmlspecialchars(($_SERVER['PHP_SELF'])); ?>" class="form" id="form" method = "POST"onsubmit="return jsValid();" >
            <div class="form-control">
                <lable>Book Name</lable>
                <input type="text" placeholder="Art of thinking clearly" id="bookname" name="bookname" value="<?php echo $bookname ?>" >
                <img class="check" src="../View/img/checked.svg" alt="Checked">
                <img class="warn" src="../View/img/warn.svg" alt="Error">
                <small>Error message</small>
                <span style="color: red"> <?php echo $booknameErr; ?> </span>
            </div>  
 
            <div class="form-control">
                <lable>Author Name</lable>
                <input type="text" placeholder="Rolf Dobelli" id="authorname" name="authorname" value="<?php echo $authorname ?>">
                <img class="check" src="../View/img/checked.svg" alt="Checked">
                <img class="warn" src="../View/img/warn.svg" alt="Error">
                <small>Error message</small>
                <span style="color: red"> <?php echo $authornameErr; ?> </span>
            </div>  

             <div class="form-control">
                <lable>Edition</lable>
                <input type="text" placeholder="1st" id="edition" name="edition" value="<?php echo $edition ?>">
                <img class="check" src="../View/img/checked.svg" alt="Checked">
                <img class="warn" src="../View/img/warn.svg" alt="Error">
                <small>Error message</small>
                <span style="color: red"> <?php echo $editionErr; ?> </span>
            </div> 

            <div class="form-control">
                <lable>Number of Copy</lable>
                <input type="text" placeholder="2" id="numberofcopy" name="numberofcopy" value="<?php echo $numberofcopy ?>" >
                <img class="check" src="../View/img/checked.svg" alt="Checked">
                <img class="warn" src="../View/img/warn.svg" alt="Error">
                <small>Error message</small>
                <span style="color: red"> <?php echo $numberofcopyErr; ?> </span>
            </div>  
 
            <div class="form-control">
                <lable>Shelf No</lable>
                <input type="text" placeholder="22" id="shelfno" name="shelfno" value="<?php echo $shelfno ?>">
                <img class="check" src="../View/img/checked.svg" alt="Checked">
                <img class="warn" src="../View/img/warn.svg" alt="Error">
                <small>Error message</small>
                <span style="color: red"> <?php echo $shelfnoErr; ?> </span>
            </div>  

             <div class="form-control">
                <lable>Book Id</lable>
                <input type="text" placeholder="1001" id="bookno" name="bookno" value="<?php echo $bookno ?>" readonly>
                <img class="check" src="../View/img/checked.svg" alt="Checked">
                <img class="warn" src="../View/img/warn.svg" alt="Error">
                <small>Error message</small>
                <span style="color: red"> <?php echo $booknoErr; ?> </span>

            </div>  
     
    

            

             <button type="submit" name="updatebook">Update Book</button>
             <span style="color: green;"> <?php echo $updateBookSuccess; ?> </span>
             <span style="color: red"> <?php echo $updateBookFailed; ?> </span>
 
        </form>
    </div>
    </div>
 
  <!-- ///////////////////////////////////////////////// -->





<script>
    
    function jsValid() 
    { 
        const form = document.getElementById('form'); // full form
        const bookname = document.getElementById('bookname');
        const authorname = document.getElementById('authorname');
        const edition = document.getElementById('edition');
        const numberofcopy = document.getElementById('numberofcopy');
        const shelfno = document.getElementById('shelfno');
        const bookno = document.getElementById('bookno');

        console.log(bookno);

         
        var flag = true;       
        checkInputs();

 

        function checkInputs() 
        {
            //get the value from inputs.

            const  booknameValue = bookname.value.trim();   
            const  authornameValue = authorname.value.trim();   
            const  editionValue = edition.value.trim();   
            const  numberofcopyValue = numberofcopy.value.trim();   
            const  shelfnoValue = shelfno.value.trim();   
            const  booknoValue = bookno.value.trim();   

            

            if (booknameValue === ''){
                //show error
                // add error class
                setErrorFor(bookname,'Book name cannot be blank');
                flag = false;
            }
            else if(booknameValue.length > 100){
                setErrorFor(bookname,'Book name cannot be > 100 character');
                flag = false;
            }
            else{
                // add success class
                setSuccessFor(bookname);
            }



            if (authornameValue === ''){
                setErrorFor(authorname,'Author name cannot be blank');
                flag = false;
            }
            else if(authornameValue.length > 50) {
                setErrorFor(authorname,'Author name cannot be > 50 character');
                flag = false;
            }
            else setSuccessFor(authorname);



            if (editionValue === ''){
                setErrorFor(edition,'Edition cannot be blank');
                flag = false;
            }
            else if(editionValue.length > 10) {
                setErrorFor(edition,'Edition cannot be > 10 character');
                flag = false;
            }
            else setSuccessFor(edition);

         

            if (numberofcopyValue === '') {
                setErrorFor(numberofcopy,'Number of copy cannot be blank');
                flag = false;
            }
            else if(numberofcopyValue.length > 10) {
                setErrorFor(numberofcopy,'Number of copy cannot be > 10 character');
                flag = false;
            }
            else setSuccessFor(numberofcopy);

 



            if (shelfnoValue === '') {
                setErrorFor(shelfno,'Shelf no cannot be blank');
                flag = false;
            }
            else if(shelfnoValue.length > 10) {
                setErrorFor(shelfno,'Shelf no cannot be > 10 character');
                flag = false;
            }
            else setSuccessFor(shelfno);



            if (booknoValue === '') {
                setErrorFor(bookno,'Book Id cannot be blank');
                flag = false;
            }
            else if(booknoValue.length > 10) {
                setErrorFor(bookno,'Book Id cannot be > 10 character');
                flag = false;
            }
            else setSuccessFor(bookno);

 
         
          }

         function setErrorFor(input, message)
         {
            const formControl = input.parentElement; // .form-control
            const small = formControl.querySelector('small');

            // add error message inside small
            small.innerText = message;

            // add error class
            formControl.className = 'form-control error';
         } 

         function setSuccessFor(input)
         {
            const formControl = input.parentElement; // .form-control
         
            // add success class
            formControl.className = 'form-control success';
         }

         return flag;
         
    }
 
  </script>


<script>
    
    function jsIdValid() 
    { 
        var searchid = document.forms["SearchBook"]["searchid"].value;
        
        if (searchid === "" || searchid.length > 10) 
        {
            document.getElementById('searchidErr').innerHTML = "searchid can not be empty or > 10 Character.";
            return false;
        } 
    }
 
  </script>





		<?php
		// header file.
		include('../View/footer.html');
		?>

	</body>
	</html>