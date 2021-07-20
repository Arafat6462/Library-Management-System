 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1.0">
 	<title>Add Books</title>

 </head>
 <body>


 	<?php

   include('../View/header.html');



   $addBookSuccess = $addBookFailed = "";
   $flag = false;
   $res = false;
   $uniqueId = "";


   if ($_SERVER['REQUEST_METHOD'] === "POST")
   {

   // empty validation for required field
   if(empty($bookname=basic_validation($_POST['bookname']))) $flag = true;
   if(empty($authorname=basic_validation($_POST['authorname']))) $flag = true;
   if(empty($edition=basic_validation($_POST['edition']))) $flag = true;
   if(empty($numberofcopy=basic_validation($_POST['numberofcopy']))) $flag = true;
   if(empty($bookno=basic_validation($_POST['bookno']))) $flag = true;

     // fetch data from json file to check multiple book id.
      $fetch_data = json_decode(file_get_contents("../Model/books.json"));
      foreach ($fetch_data as $key  )
      { 
         if($key->bookno == $bookno)
         {
            $uniqueId = "This id is already exist !!";
            $flag = true;
         }
      }


   // if pass php validation then can write file.
   if(!$flag)
   {

      $book = array( "bookname"=>basic_validation($_POST['bookname']),"authorname"=>basic_validation($_POST['authorname']),
       "edition"=>basic_validation($_POST['edition']),"numberofcopy"=>basic_validation($_POST['numberofcopy']),
       "shelfno"=>basic_validation($_POST['shelfno']),"bookno"=>basic_validation($_POST['bookno']));



      $res = write($book);
   }


    // if file write successful
   if($res) 
       $addBookSuccess = "Add book succesfully.";

   else $addBookFailed = "Add book failed.";

}

// validate input
function basic_validation($data)
{
 $data = trim($data);
 $data = htmlspecialchars($data);
 $data = stripcslashes($data);
 return $data;
}

// write in data.json
function write($content)
{
 $addbook = json_decode(file_get_contents("../Model/books.json"));

 // add new value on associative array formate data.json
 array_push($addbook, $content);

 $addbook = json_encode($addbook);


 $filePointer = fopen("../Model/books.json", "w");	
 $status = fwrite($filePointer, $addbook."\n");

 fclose($filePointer);
 return $status;


}



?>


<form action="<?php echo htmlspecialchars(($_SERVER['PHP_SELF'])); ?>" method = "POST">
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
            <td><input type="text" id="bookname" name="bookname" placeholder="Enter Book Name" required=""></td>
         </tr> 

         <tr>
            <td><label for="authorname">Author Name:<span style="color: red"><?php echo "*"; ?></span></label></td>
            <td><input type="text" id="authorname" name="authorname" placeholder="Enter Author Name" required=""></td>
         </tr> 

         <tr>
            <td><label for="edition">Edition:<span style="color: red"><?php echo "*"; ?></span></label></td>
            <td><input type="text" id="edition" name="edition" placeholder="Book Edition" required=""></td>
         </tr> 

         <tr>
            <td><label for="numberofcopy">Number of Copy:<span style="color: red"><?php echo "*"; ?></span></label></td>
            <td><input type="text" id="numberofcopy" name="numberofcopy" placeholder="Number of copy" required=""></td>
         </tr> 

         <tr>
            <td><label for="shelfno">Shelf No:</span></label></td>
            <td><input type="text" id="shelfno" name="shelfno" placeholder="Shelf No"></td>
         </tr> 

         <tr>
            <td><label for="bookno">Book Id:<span style="color: red"><?php echo "*"; ?></span></label></td>
            <td><input type="text" id="bookno" name="bookno" placeholder="Book No" required=""></td>
            <td><span style="color: red"><?php echo $uniqueId; ?></span></td>

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








<?php
// footer file.
include('../View/footer.html');
?>

</body>
</html>