	<?php 
 			include '../Model/dbbook.php';
			if(empty(trim($_GET['bookid'])))
			{
				$bookList = getAllBooks();			
			}
		 	
			else 
			{
				$bookList = getBookId($_GET['bookid']);
				$bookid = $_GET['bookid'];
 			}

			if(!empty($_GET['uid']))
			{
 				$response = removeBook($_GET['uid']);
				if ($response) 
				{
					echo "User remove successfull"; 
					$bookList = getAllBooks(); // auto refresh / update.
				}
				else
					echo "Error while removing user";
			}
 	?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>View books</title>

	<style>
	table, th, td {
		border: 1px solid black;
		border-collapse: collapse;
		text-align: center;
		table-layout: auto;
		margin-left: auto;
    	margin-right: auto;
	}
</style>
</head>
<body>

	<?php
		// header file.
		include('../View/header.html');
		?>


	<h3><span style="padding: 14px 16px;"> View books</span></h3>

	<form action="<?php echo $_SERVER['PHP_SELF'] ?>" mathod = "GET">
 		<input type="text" name="bookid" value="<?php echo $bookid  ?>">
 		<input type="submit" name="search" value="Search"><br><br><br>
 	</form>

	
	<table style="width:80%">
		<tr>
			<th>Bookname</th>
			<th>Authorname</th> 
			<th>edition</th>
			<th>Numberofcopy</th>
			<th>shelfno</th>
			<th>bookid</th>
			<th>Delete book</th>
		</tr>

		 <?php
		
	 		foreach ($bookList as $arr  )
			{
	  			foreach ($arr as $key => $value)
	  			{
	  				echo  "<td>".$value."</td>";
	   				if($key == "bookid")
	   				{
	  					echo "<td><a href = '".$_SERVER['PHP_SELF']."?uid=".$arr["bookid"] ."'>Delete</a></td><tr>"; //get id
	   				}
				}
	 		}
		?>


	</table>



<?php 
		// header file.
		include('../View/footer.html');
?>
</body>
</html>
