<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Return Book</title>
</head>
<body>

	<?php
 	include('../View/header.html');



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
		$fetch_data = json_decode(file_get_contents("../Model/student.json"));
 
		foreach ($fetch_data as $key  )
		{ 
			if($key->id == $studentid )
			{
 				 $flag = true;	 
 				 if($key->totalBorrow == 0)
 				  {
 				 	$noborrow = "No Borrow to this student";
 				 	$flag2 = false;
 				 	 
 				  }
 				  else
 				  {
 				  	$bookid = $key->bookid;
 				  } 
   			}
   			
		}
		if(!$flag)$studentnotfound = "Student not Found";
 

		
		if($flag and $flag2) //write file
		{

			$fetch_data = json_decode(file_get_contents("../Model/student.json"));
			foreach ($fetch_data as $key  )
			{ 
				if($key->id == $studentid )
				{
					$key->totalBorrow = $key->totalBorrow - 1;
					$key->bookid = 0;

				}
			}
			$res2 = write($fetch_data,"../Model/student.json");	


			$fetch_data = json_decode(file_get_contents("../Model/books.json"));
			foreach ($fetch_data as $key  )
			{ 
				if($key->bookno == $bookid )
				{
					$key->numberofcopy = $key->numberofcopy + 1;

				}
			}
			$res = write($fetch_data,"../Model/books.json");	




			if($res and $res2)$ReturnBookSuccess = "Return book success";
		}


	}
	else
		$empty = "Field can't be empty.";
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
		<h3><span style="padding: 14px 16px;"> Return book</span></h3>

		<style>
		.center  {
			margin-left: auto;
			margin-right: auto;}
		</style>


		<table class="center">
			<tbody>
		<tr>
 			<td><label for="bookid">Search Student by Id to Return :</label></td>
			<td><input type="text" id="studentid" name="studentid" value="<?php echo $studentid ?>"></td>
 			<td><span style="color: red"><?php echo $noborrow; ?></span>
 			<span style="color: red"><?php echo $studentnotfound; ?></span>
 			<span style="color: red"><?php echo $empty; ?></span></td>
 		</tr>
		<tr>
 			<td><label for="bookid">Book id Read only :</label>
			<td><input type="text" id="bookid" name="bookid" value="<?php echo $bookid ?>" readonly></td>
 			 
		</td>

		<tr>
			<td> <td><input type="submit" name="returnborrow" value="Return Borrow"></td></td>
			<td><span style="color: green"><?php echo $ReturnBookSuccess; ?></span></td>
		</tr>

 
	</tbody>
</table>


	</form>


 	<?php
 	include('../View/footer.html');
 	?>
	
</body>
</html>