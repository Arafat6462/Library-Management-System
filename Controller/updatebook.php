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
 

      if(empty($bookname))
         {
            $booknameErr = "bookname can not be empty";
            $isValid = false;
         }
      if(empty($authorname))
         {
            $authornameErr = "authorname can not be empty";
            $isValid = false;
         }
      if(empty($edition))
         {
            $editionErr = "edition can not be empty";
            $isValid = false;
         }
      if(empty($numberofcopy))
         {
            $numberofcopyErr = "numberofcopy can not be empty";
            $isValid = false;
         }
      if(empty($shelfno))
         {
            $shelfnoErr = "shelfno can not be empty";
            $isValid = false;
         }
      if(empty($bookno))
         {
            $booknoErr = "bookno can not be empty";
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
		// fetch data from json file to update book ifno.
		$fetch_data = json_decode(file_get_contents("../Model/books.json"));
 
			foreach ($fetch_data as $key  )
			{ 
				if($key->bookno == $bookno)
				{
	 				$key->bookname = $bookname;
					$key->authorname = $authorname;
					$key->edition = $edition;
					$key->numberofcopy = $numberofcopy;
					$key->shelfno = $shelfno;
					$key->bookno = $bookno;

	   			}
			}
   		$res = write($fetch_data);	
   		if($res)$updateBookSuccess = "Update book success";
  		else $updateBookFailed = "Update book Failed";

	}

	}

	if(isset($_POST['search']))
	{
		$searchID = $_POST['searchid'];


		 if(empty($searchID))
         {
            $searchIDErr = "searchID can not be empty";
            $isValid = false;
         }

     	 $bookname = basic_validation($bookname);

     	 if($isValid)
     	 {	  
	   	   // fetch data from json file to check multiple book id.
			$fetch_data = json_decode(file_get_contents("../Model/books.json"));
			foreach ($fetch_data as $key  )
			{ 
				if($key->bookno == $searchID)
				{
					$bookname= $key->bookname;
					$authorname=$key->authorname;
					$edition=$key->edition;
					$numberofcopy= $key->numberofcopy;
					$shelfno=$key->shelfno;
					$bookno=$key->bookno;
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


	// write in  .json
	function write($content)
	{ 
		$content = json_encode($content);

		$filePointer = fopen("../Model/books.json", "w");
			$status = fwrite($filePointer, $content."\n");

		fclose($filePointer);
		return $status;

	}
	?>


	<form action="<?php echo htmlspecialchars(($_SERVER['PHP_SELF'])); ?>" method = "POST">
		<h3><span style="padding: 14px 16px;"> Updatae book</span></h3>

		<span style="padding: 14px 16px;">
			<label for="searchid">Search by Book Id:</label>
			<input type="text" id="searchid" name="searchid" value="<?php echo $searchID ?>">
			<input type="submit" name="search" value="search">
			<span style="color: red"> <?php echo $searchIDErr; ?> </span>
		</span>


	</form>





<form action="<?php echo htmlspecialchars(($_SERVER['PHP_SELF'])); ?>" method = "POST">
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
				<span style="color: red"> <?php echo $booknameErr; ?> </span></td>
			</tr> 

			<tr>
				<td><label for="authorname">Author Name:<span style="color: red"><?php echo "*"; ?></span></label></td>
				<td><input type="text" id="authorname" name="authorname"value="<?php echo $authorname ?>">
				<span style="color: red"> <?php echo $authornameErr; ?> </span></td>
				</tr> 

			<tr>
				<td><label for="edition">Edition:<span style="color: red"><?php echo "*"; ?></span></label></td>
				<td><input type="text" id="edition" name="edition" value="<?php echo $edition ?>">
				<span style="color: red"> <?php echo $editionErr; ?> </span></td>
				</tr> 

			<tr>
				<td><label for="numberofcopy">Number of Copy:<span style="color: red"><?php echo "*"; ?></span></label></td>
				<td><input type="text" id="numberofcopy" name="numberofcopy" value="<?php echo $numberofcopy ?>">
				<span style="color: red"> <?php echo $numberofcopyErr; ?> </span></td>
				</tr> 

			<tr>
				<td><label for="shelfno">Shelf No:</span></label></td>
				<td><input type="text" id="shelfno" name="shelfno"value="<?php echo $shelfno ?>">
				<span style="color: red"> <?php echo $shelfnoErr; ?> </span></td>
				</tr> 

			<tr>
				<td><label for="bookno">Book Id:<span style="color: red"></span></label></td>
				<td><input type="text" id="bookno" name="bookno" value="<?php echo $bookno ?>"  readonly>
				<span style="color: red"> <?php echo $booknoErr; ?> </span></td>

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

		<?php
		// header file.
		include('../View/footer.html');
		?>

	</body>
	</html>