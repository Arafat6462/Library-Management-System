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

	$searchID = $_POST['searchid'];

	// $booknameError = "";
	// $authornameError = "";
	// $editionError = "";
	// $numberofcopyError = "";
	// $shelfnoError = "";


	$bookname = "";
	$authorname = "";
	$edition = "";
	$numberofcopy = "";
	$shelfno = "";
	$updateBookSuccess = "";


	// if(isset($_POST['addbook']))
	// {
    	
 	//  //empty validation for required field
	// 	$bookname=basic_validation($_POST["bookname"]);
	// 	$authorname=basic_validation($_POST["authorname"]);
	// 	$edition=basic_validation($_POST["edition"]);
	// 	$numberofcopy=basic_validation($_POST["numberofcopy"]);
	// 	$shelfno=basic_validation($_POST["shelfno"]);

	// 	if(empty($bookname)) $booknoError = "Field can't be Empty!!";
	// 	if(empty($authorname)) $authornameError = "Field can't be Empty!!";
	// 	if(empty($edition)) $editionError = "Field can't be Empty!!";
	// 	if(empty($numberofcopy)) $numberofcopyError = "Field can't be Empty!!";
	// 	if(empty($shelfno)) $shelfnoError = "Field can't be Empty!!";


	// 	// validate input
	// 	function basic_validation($data)
	// 	{
	// 		$data = trim($data);
	// 		$data = htmlspecialchars($data);
	// 		$data = stripcslashes($data);
	// 		return $data;
	// 	}

	// }


	if(isset($_POST['addbook']))
	{

	$bookname =$_POST['bookname'];
	$authorname = $_POST['authorname'];
	$edition = $_POST['edition'];
	$numberofcopy = $_POST['numberofcopy'];
	$shelfno = $_POST['shelfno'];
	$bookno = $_POST['bookno'];


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

	if(isset($_POST['search']))
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
	?>


	<form action="<?php echo htmlspecialchars(($_SERVER['PHP_SELF'])); ?>" method = "POST">
		<h3><span style="padding: 14px 16px;"> Updatae book</span></h3>

		<span style="padding: 14px 16px;">
			<label for="searchid">Search by Book Id:</label>
			<input type="text" id="searchid" name="searchid" value="<?php echo $searchID ?>" required="">
			<input type="submit" name="search" value="search">
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
					<td><input type="text" id="bookname" name="bookname" value="<?php echo $bookname ?>"  ></td>
 				</tr> 

				<tr>
					<td><label for="authorname">Author Name:<span style="color: red"><?php echo "*"; ?></span></label></td>
					<td><input type="text" id="authorname" name="authorname"value="<?php echo $authorname ?>"></td>
 				</tr> 

				<tr>
					<td><label for="edition">Edition:<span style="color: red"><?php echo "*"; ?></span></label></td>
					<td><input type="text" id="edition" name="edition" value="<?php echo $edition ?>"></td>
 				</tr> 

				<tr>
					<td><label for="numberofcopy">Number of Copy:<span style="color: red"><?php echo "*"; ?></span></label></td>
					<td><input type="text" id="numberofcopy" name="numberofcopy" value="<?php echo $numberofcopy ?>"  ></td>
 				</tr> 

				<tr>
					<td><label for="shelfno">Shelf No:</span></label></td>
					<td><input type="text" id="shelfno" name="shelfno"value="<?php echo $shelfno ?>"></td>
 				</tr> 

				<tr>
					<td><label for="bookno">Book Id:<span style="color: red"></span></label></td>
					<td><input type="text" id="bookno" name="bookno" value="<?php echo $bookno ?>"  readonly></td>

				</tr> 




				<tr>
					<td></td>
					<td><span style="float: right;"><input type="submit" name="addbook" value="Update Book"></span> </td>
					<td><span style="color: green; text-align: center;"><?php echo $updateBookSuccess; ?></span>
						<span style="color: green"><?php echo $addBookFailed; ?></span></td>
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