	<?php 
 			include '../Model/dbbook.php';
			if(empty(basic_validation($_GET['bookid'])))
			{
				$bookList = getAllBooks();			
			}
		 	
			else 
			{
				$bookList = getBookId(basic_validation($_GET['bookid']));
				$bookid = $_GET['bookid'];
 			}

			if(!empty(basic_validation($_GET['uid'])))
			{
 				$response = removeBook($_GET['uid']);
				if ($response) 
				{
					echo "Book remove successfull"; 
					$bookList = getAllBooks(); // auto refresh / update.
				}
				else
					echo "Error while removing user";
			}

		function basic_validation($data)
	    {
		    $data = trim($data);
		    $data = htmlspecialchars($data);
		    $data = stripcslashes($data);
		    return $data;
	    }
 	?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>View books</title>
	<link rel="stylesheet" href="../View/viewbook.css">
</head>
<body>

	<?php
 	$page = 'viewbook';
	include('../View/header.php');
	?>


	<h3><span style="padding: 14px 16px;"> View books</span></h3>

	<form action="<?php echo $_SERVER['PHP_SELF'] ?>" mathod = "GET">
 		<input type="text" name="bookid" value="<?php echo $bookid  ?>">
 		<input type="submit" name="search" value="Search"><br><br><br>
 	</form>
 

 	<div class="table">
	<table>
		<thead>
			<tr>
				<th>Bookname</th>
				<th>Authorname</th> 
				<th>edition</th>
				<th>Numberofcopy</th>
				<th>shelfno</th>
				<th>bookid</th>
				<th>Delete book</th>
			</tr>
		</thead>

		<tbody>
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
		</tbody>
	</table>
	</div>

 


<?php include('../View/footer.html');?>
</body>
</html>
