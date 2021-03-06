<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Update Book Info</title>
   <link rel="stylesheet" href="../View/css/updatebook.css?v <?php echo time(); ?>">
    <script src="../View/js/updatebook.js"></script>


</head>
<body>

	<?php

    /// redirect login for no session
    session_start();
    if(!isset($_SESSION['s_id']))
        header("location:../");

	// header file.
	$page = 'updatebook';
	include('../View/html/header.php');
	include('../Model/dbbook.php');

	$searchID = "";
	$searchIDErr = "";
 
	$bookname = "";
	$authorname = "";
	$edition = "";
	$numberofcopy = "";
	$shelfno = "";
	$bookid = "";

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
		$bookid = $_POST['bookid'];
 
 

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
      if(empty($bookid))
         {
            $bookidErr = "book id can not be empty.";
            $isValid = false;
         }
         if( strlen($bookid) > 10)
         {
            $bookidErr = "book id can not be > 10 Character.";
            $isValid = false;
         }

      $bookname = basic_validation($bookname);
      $authorname = basic_validation($authorname);
      $edition = basic_validation($edition);
      $numberofcopy = basic_validation($numberofcopy);
      $shelfno = basic_validation($shelfno);
      $bookid = basic_validation($bookid);

		////////////////////


 
      if($isValid)
      {
			// session_start();
			// $bookid = $_SESSION['bookid']; // not changing book id
 

			// update book ifno.
			$res = updateBook($bookname,$authorname,$edition,$numberofcopy,$shelfno,$bookid);
 	
   		if($res)$updateBookSuccess = "Update book success";
  			else $updateBookFailed = "Update book Failed";

		}

	}

	// if(isset($_POST['search']))
	// {
	// 	$searchID = $_POST['searchid'];


	// 	 if(empty(basic_validation($searchID)))
 //         {
 //            $searchIDErr = "searchID can not be empty.";
 //            $isValid = false;
 //         }

 //     	 // $bookname = basic_validation($bookname);

 //     	 if($isValid)
 //        {	  
 //   	   	// fetch data from json file to check multiple book id.
 //   			$book_data = getBookId($searchID);
 //   			for ( $i = 0; $i < count($book_data); $i++)
 //         	{ 
 //   				if($book_data[$i]["bookid"] == $searchID)
 //   				{
 //   					$bookname= $book_data[$i]["bookname"];
 //   					$authorname=$book_data[$i]["authorname"];
 //   					$edition=$book_data[$i]["edition"];
 //   					$numberofcopy= $book_data[$i]["numberofcopy"];
 //   					$shelfno=$book_data[$i]["shelfno"];
 //   					$bookid=$book_data[$i]["bookid"];

 //   					session_start(); // book id can't be change
 //                  $_SESSION['bookid'] = $bookid;
 //   				}
 //   			}
	//       }
 //   }



	// validate input
    function basic_validation($data)
    {
        $data = trim($data);
        $data = htmlspecialchars($data);
        $data = stripcslashes($data);
        return $data;
    }
 
	?>

<div class="box">
	<form action="" method = "POST"  name="SearchBook" onsubmit=" jsIdValid_get(); return false;">
     	<input class="text" type="text" id="searchid"placeholder="Search book with ID" name="searchid" value="<?php echo $searchID ?>">
    	<input class="submit" type="submit" name="search" value="search"><br><br>
    	<span style="color: red"> <?php echo $searchIDErr; ?></span>
    	<span id="searchidErr" style="color: red;"></span>
 	</form>
</div>




 


 <!-- ///////////////////////////////////////////////// -->
 <div class="body">
  <div class="container">
        <div class="header">
            <h2>Update book</h2>
        </div>


        <form action="<?php echo htmlspecialchars(($_SERVER['PHP_SELF'])); ?>" class="form" id="form" name="updatebook" method = "POST"onsubmit="return jsValid();" >
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
                <input type="text" placeholder="1001" id="bookid" name="bookid" value="<?php echo $bookid ?>" readonly>
                <img class="check" src="../View/img/checked.svg" alt="Checked">
                <img class="warn" src="../View/img/warn.svg" alt="Error">
                <small>Error message</small>
                <span style="color: red"> <?php echo $bookidErr; ?> </span>

            </div>  
     
    

            

             <button type="submit" name="updatebook">Update Book</button>
             <span style="color: green;"> <?php echo $updateBookSuccess; ?> </span>
             <span style="color: red"> <?php echo $updateBookFailed; ?> </span>
 
        </form>
    </div>
    </div>
 
  <!-- ///////////////////////////////////////////////// -->

		<?php
		// header file.
		include('../View/html/footer.html');
		?>

	</body>
	</html>