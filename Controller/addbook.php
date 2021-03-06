 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1.0">
 	<title>Add Books</title>
    <link rel="stylesheet" href="../View/css/addbook.css?v <?php echo time(); ?>">
    <script src="../View/js/addbook.js"></script>


 </head>
 <body>


 	<?php

    /// redirect login for no session
    session_start();
    if(!isset($_SESSION['s_id']))
        header("location:../");

   $page = 'addbook';
   include('../View/html/header.php');
   include('../Model/dbbook.php');
 


   $addBookSuccess = $addBookFailed = "";
   $isValid = true;
   $res = false;
   $uniqueId = "";
   $bookname = $authorname = $edition = $numberofcopy = $bookno = $shelfno = "";
   $booknameErr = $authornameErr = $editionErr = $numberofcopyErr = $booknoErr = $shelfnoErr ="";
 

   if ($_SERVER['REQUEST_METHOD'] === "POST")
   {

      $bookname = $_POST['bookname'];
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

     // fetch data from Database to check multiple book id.
      $book_data = getBookId($bookno);
      for ( $i = 0; $i < count($book_data); $i++)
      {
         if($book_data[$i]["bookid"] == $bookno)
         {
            $uniqueId = "This id is already exist !!";
            $isValid = false;

         }
      }
         
      // if pass php validation then can write file.
      if($isValid)
      {
            $res = AddBook($bookname,$authorname,$edition,$numberofcopy,$shelfno,$bookno);
             
            if($res) 
                $addBookSuccess = "Add book succesfully.";

            else $addBookFailed = "Add book failed.";
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
 
 <!-- ///////////////////////////////////////////////// -->
 <div class="body">
  <div class="container">
        <div class="header">
            <h2>Add books</h2>
        </div>


        <form action="<?php echo htmlspecialchars(($_SERVER['PHP_SELF'])); ?>" class="form" id="form" method = "POST" onsubmit="return jsValid();" >
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
                <input type="text" placeholder="1001" id="bookno" name="bookno" value="<?php echo $bookno ?>">
                <img class="check" src="../View/img/checked.svg" alt="Checked">
                <img class="warn" src="../View/img/warn.svg" alt="Error">
                <small>Error message</small>
                <span style="color: red"> <?php echo $booknoErr; ?> </span>

            </div>  
     
    

            

            <button type="submit">Add Book</button>
             <span style="color: green;"> <?php echo $addBookSuccess; ?> </span>
             <span style="color: red"> <?php echo $addBookFailed; ?> </span>


 
        </form>
    </div>
    </div>
 
  <!-- ///////////////////////////////////////////////// -->
 
<?php
// footer file.
include('../View/html/footer.html');
?>

</body>
</html>