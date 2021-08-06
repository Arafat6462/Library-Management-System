<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Update Book Info</title>
</head>
<body>

	<?php
		// header file.
	include('../View/header.html');
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

 

	if(isset($_POST['addbook']))
	{


		///////////////////////

		$bookname =$_POST['bookname'];
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
      if(empty($authorname) or strlen($bookname) > 50)
         {
            $authornameErr = "authorname can not be empty or > 50 Character.";
            $isValid = false;
         }
      if(empty($edition) or strlen($bookname) > 10)
         {
            $editionErr = "edition can not be empty or > 10 Character.";
            $isValid = false;
         }
      if(empty($numberofcopy) or strlen($bookname) > 10)
         {
            $numberofcopyErr = "numberofcopy can not be empty or > 10 Character.";
            $isValid = false;
         }
      if(empty($shelfno) or strlen($bookname) > 10)
         {
            $shelfnoErr = "shelfno can not be empty or > 10 Character.";
            $isValid = false;
         }
      if(empty($bookno) or strlen($bookname) > 10)
         {
            $booknoErr = "bookno can not be empty or > 10 Character.";
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


		 if(empty(basic_validation($searchID))  or strlen(basic_validation($searchID) > 10))
         {
            $searchIDErr = "searchID can not be empty or > 10 Character.";
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





<form action="<?php echo htmlspecialchars(($_SERVER['PHP_SELF'])); ?>" method = "POST" name="UpdateBook" onsubmit="return jsValid();">
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
				<td><input type="text" id="authorname" name="authorname"value="<?php echo $authorname ?>">
				<span style="color: red"> <?php echo $authornameErr; ?> </span>
				<span id="authornameErr" style="color: red;"></span></td>
				</tr> 

			<tr>
				<td><label for="edition">Edition:<span style="color: red"><?php echo "*"; ?></span></label></td>
				<td><input type="text" id="edition" name="edition" value="<?php echo $edition ?>">
				<span style="color: red"> <?php echo $editionErr; ?> </span>
				<span id="editionErr" style="color: red;"></span></td>
				</tr> 

			<tr>
				<td><label for="numberofcopy">Number of Copy:<span style="color: red"><?php echo "*"; ?></span></label></td>
				<td><input type="text" id="numberofcopy" name="numberofcopy" value="<?php echo $numberofcopy ?>">
				<span style="color: red"> <?php echo $numberofcopyErr; ?> </span>
				<span id="numberofcopyErr" style="color: red;"></span></td>
				</tr> 

			<tr>
				<td><label for="shelfno">Shelf No:</span></label></td>
				<td><input type="text" id="shelfno" name="shelfno"value="<?php echo $shelfno ?>">
				<span style="color: red"> <?php echo $shelfnoErr; ?> </span>
				<span id="shelfnoErr" style="color: red;"></span></td>
				</tr> 

			<tr>
				<td><label for="bookno">Book Id:<span style="color: red"></span></label></td>
				<td><input type="text" id="bookno" name="bookno" value="<?php echo $bookno ?>"  readonly>
				<span style="color: red"> <?php echo $booknoErr; ?> </span>
				<span id="bookidErr" style="color: red;"></span></td>
 			</tr> 




			<tr>
				<td></td>
				<td><span style="float: right;"><input type="submit" name="addbook" value="Update Book"></span> </td>
				<td><span style="color: green; text-align: center;"><?php echo $updateBookSuccess; ?></span>
					<span style="color: red"><?php echo $updateBookFailed; ?></span></td>
				</tr>


			</tbody>
		</table>

	</form>





<script>
    
    function jsValid() 
    { 
 
        var bookname = document.forms["UpdateBook"]["bookname"].value;
        var authorname = document.forms["UpdateBook"]["authorname"].value;
        var edition = document.forms["UpdateBook"]["edition"].value;
        var numberofcopy = document.forms["UpdateBook"]["numberofcopy"].value;
        var shelfno = document.forms["UpdateBook"]["shelfno"].value;
        var bookid = document.forms["UpdateBook"]["bookno"].value;
         

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