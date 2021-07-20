<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Borrow Book</title>
</head>
<body>
	<?php
 	include('../View/header.html');

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


	// search book
 	if(isset($_POST['confirmborrow']) and !empty($_POST['bookid']))
	{
		$bookid = $_POST['bookid'];
 
		// fetch data from json file to update book ifno.
		$fetch_data = json_decode(file_get_contents("../Model/books.json"));
 
		foreach ($fetch_data as $key  )
		{ 
	 		if($key->bookno == $bookid )
			{
 				 $flag1 = true;
 				 if($key->numberofcopy < 2)
 				 {
 				 	$booklim = "Book not available";
 				 	$flag1 = false;
 				 }


   			}
		}
		if($flag1)$bookfound = "Book Found";
		else $booknotfound = "Book Not Found.";

	}

	// search student
	if(isset($_POST['confirmborrow']) and !empty($_POST['studentid']))
	{
		$studentid = $_POST['studentid'];
 
		// fetch data from json file to update book ifno.
		$fetch_data = json_decode(file_get_contents("../Model/student.json"));
 
		foreach ($fetch_data as $key  )
		{ 
			if($key->id == $studentid )
			{
 				 $flag2 = true;
 				  if($key->totalBorrow > 0)
 				  {
 				 	$studentlim = "Borrow limit full";
 				 	$flag2=false;
 				 	$flag3= false;
 				  }
   			}
		}
		if($flag2)$studentfound = "Student Found";
		else if($flag3)$studentnotfound = "Student Not Found";

	}


	// confirm to file
	if( isset($_POST['confirmborrow']) and $flag1 and $flag2)
	{
		$fetch_data = json_decode(file_get_contents("../Model/books.json"));
		foreach ($fetch_data as $key  )
		{ 
	 		if($key->bookno == $bookid )
			{
  				 $key->numberofcopy = $key->numberofcopy - 1;
 				 	 
   			}
		}
		$res = write($fetch_data,"../Model/books.json");	


		$fetch_data = json_decode(file_get_contents("../Model/student.json"));
		foreach ($fetch_data as $key  )
		{ 
	 		if($key->id == $studentid )
			{
  				 $key->totalBorrow = $key->totalBorrow + 1;
   				 $key->allhistory = $key->allhistory + 1;
  				 $key->bookid = $bookid;
 				 	 
   			}
		}
		$res2 = write($fetch_data,"../Model/student.json");	



  		if($res and $res2)$BorrowBookSuccess = "Borrow book success";


	}


		// write in  .json
		function write($content, $path)
		{ 
			$content = json_encode($content);

			$filePointer = fopen($path, "w");
 			$status = fwrite($filePointer, $content."\n");

			fclose($filePointer);
			return $status;
 
		}


	?>

	<form action="<?php echo htmlspecialchars(($_SERVER['PHP_SELF'])); ?>" method = "POST">
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
			<span style="color: red"><?php echo $booklim; ?></span></td>
		</tr>
		<tr>
 			<td><label for="bookid">Search Student by Id to borrow :</label>
			<td><input type="text" id="studentid" name="studentid" value="<?php echo $studentid ?>"></td>
 			<td><span style="color: green"><?php echo $studentfound; ?></span>
			<span style="color: red"><?php echo $studentnotfound; ?></span>
			<span style="color: red"><?php echo $studentlim; ?></span></td>
		</td>

		<tr>
			<td> <td><input type="submit" name="confirmborrow" value="Confirm Borrow"></td></td>
			<td><span style="color: green"><?php echo $BorrowBookSuccess; ?></span></td>
		</tr>

 
	</tbody>
</table>


	</form>

	



	<?php
 	include('../View/footer.html');
	?>
</body>
</html>