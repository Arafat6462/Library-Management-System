 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1.0">
 	<title>Add Books</title>

 </head>
 <body>


 	<?php

   $page = 'addbook';
   include('../View/header.php');
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


      if(empty($bookname) or strlen($bookname) > 100)
         {
            $booknameErr = "bookname can not be empty or > 100 Character.";
            $isValid = false;
         }
      if(empty($authorname) or strlen($authorname) > 50)
         {
            $authornameErr = "authorname can not be empty or > 50 Character.";
            $isValid = false;
         }
      if(empty($edition) or strlen($edition) > 10)
         {
            $editionErr = "edition can not be empty or > 10 Character.";
            $isValid = false;
         }
      if(empty($numberofcopy) or strlen($numberofcopy) > 10)
         {
            $numberofcopyErr = "numberofcopy can not be empty > 10 Character.";
            $isValid = false;
         }
      if(empty($shelfno) or strlen($shelfno) > 10)
         {
            $shelfnoErr = "shelfno can not be empty or > 10 Character.";
            $isValid = false;
         }
      if(empty($bookno) or strlen($bookno) > 10)
         {
            $booknoErr = "bookid can not be > 10 Character.";
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


<form action="<?php echo htmlspecialchars(($_SERVER['PHP_SELF'])); ?>" method = "POST" name="AddBook" onsubmit="return jsValid();">
   <h3>Add Books</h3>

   <style>
   .center  {
    margin-left: auto;
    margin-right: auto;}
   </style>


    <table class="center">
       <tbody>

         <tr>
            <td><label for="bookname">Book Name :<span style="color: red"><?php echo "*"; ?></span></label></td>
            <td><input type="text" id="bookname" name="bookname" value="<?php echo $bookname ?>">
            <span style="color: red"> <?php echo $booknameErr; ?> </span>
            <span id="booknameErr" style="color: red;"></span></td>
         </tr> 

         <tr>
            <td><label for="authorname">Author Name:<span style="color: red"><?php echo "*"; ?></span></label></td>
            <td><input type="text" id="authorname" name="authorname" value="<?php echo $authorname ?>"> 
            <span style="color: red"> <?php echo $authornameErr; ?> </span>
            <span id="authornameErr" style="color: red;"></span></td>
         </tr> 

         <tr>
            <td><label for="edition">Edition:<span style="color: red"><?php echo "*"; ?></span></label></td>
            <td><input type="text" id="edition" name="edition"value="<?php echo $edition ?>" >
            <span style="color: red"> <?php echo $editionErr; ?> </span>
            <span id="editionErr" style="color: red;"></span></td>   
         </tr> 

         <tr>
            <td><label for="numberofcopy">Number of Copy:<span style="color: red"><?php echo "*"; ?></span></label></td>
            <td><input type="text" id="numberofcopy" name="numberofcopy" value="<?php echo $numberofcopy ?>" >
            <span style="color: red"> <?php echo $numberofcopyErr; ?> </span>
            <span id="numberofcopyErr" style="color: red;"></span></td>
         </tr> 

         <tr>
            <td><label for="shelfno">Shelf No:<span style="color: red"><?php echo "*"; ?></span></label></td>
            <td><input type="text" id="shelfno" name="shelfno" value="<?php echo $shelfno ?>">
            <span style="color: red"> <?php echo $shelfnoErr; ?> </span>
            <span id="shelfnoErr" style="color: red;"></span></td>
         </tr> 

         <tr>
            <td><label for="bookno">Book Id:<span style="color: red"><?php echo "*"; ?></span></label></td>
            <td><input type="text" id="bookno" name="bookno" value="<?php echo $bookno ?>">
            <span style="color: red"> <?php echo $booknoErr; ?> </span>
            <span style="color: red"><?php echo $uniqueId; ?></span>
            <span id="bookidErr" style="color: red;"></span></td>

         </tr> 




         <tr>
           <td></td>
           <td><span style="float: right;"><input type="submit" name="addbook" value="Add Book"></span> </td>
           <td><span style="color: green; text-align: center;"><?php echo $addBookSuccess; ?></span>
           <span style="color: red"><?php echo $addBookFailed; ?></span></td>
        </tr>


     </tbody>
  </table>


 <br><br><br>

</form>



<script>
    
    function jsValid() 
    { 
 
        var bookname = document.forms["AddBook"]["bookname"].value;
        var authorname = document.forms["AddBook"]["authorname"].value;
        var edition = document.forms["AddBook"]["edition"].value;
        var numberofcopy = document.forms["AddBook"]["numberofcopy"].value;
        var shelfno = document.forms["AddBook"]["shelfno"].value;
        var bookid = document.forms["AddBook"]["bookno"].value;
         

        if (bookname === "" || bookname.length > 100) 
        {
            document.getElementById('booknameErr').innerHTML = "bookname can not be empty or > 100 Character.";
            return false;
        } 
        if (authorname === "" || authorname.length > 50) 
        {
            document.getElementById('authornameErr').innerHTML = "authorname can not be empty or > 50 Character.";
            return false;
        } 
        if (edition === "" || edition.length > 10) 
        {
            document.getElementById('editionErr').innerHTML = "edition can not be empty or > 10 Character.";
            return false;
        } 
        if (numberofcopy === "" || numberofcopy.length >10) 
        {
            document.getElementById('numberofcopyErr').innerHTML = "numberofcopy can not be empty > 10 Character.";
            return false;
        } 
        if (shelfno === "" || shelfno.length > 10) 
        {
            document.getElementById('shelfnoErr').innerHTML = "shelfno can not be empty or > 10 Character.";
            return false;
        } 
        if (bookid === "" || bookid.length > 10) 
        {
            document.getElementById('bookidErr').innerHTML = "bookid can not be > 10 Character.";
            return false;
        } 
         
 
    }
 
  </script>





<?php
// footer file.
include('../View/footer.html');
?>

</body>
</html>