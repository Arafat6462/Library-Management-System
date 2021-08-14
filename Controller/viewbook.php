	<?php 

	/// redirect login for no session
	session_start();
	if(!isset($_SESSION['s_id']))
		header("location:login.php");

			$success = $failed = "";
 			include '../Model/dbbook.php';
			if(empty(basic_validation($_GET['bookid'])))
			{
				$bookList = getAllBooks();			
			}
		 	
			else 
			{
				$bookList = getBookId(basic_validation($_GET['bookid']));
 			}
				$bookid = $_GET['bookid'];

			if(!empty(basic_validation($_GET['uid'])))
			{
 				$response = removeBook($_GET['uid']);
				if ($response) 
				{
					$success = "Book remove successfull"; 
					$bookList = getAllBooks(); // auto refresh / update.
				}
				else
					$failed = "Error while removing user";
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
	<link rel="stylesheet" href="../View/css/viewbook.css?v <?php echo time(); ?>">
    <script src="../View/js/viewbook.js"></script>

</head>
<body>

	<?php
 	$page = 'viewbook';
	include('../View/html/header.php');
	?>


 <div class="box"  id="update">
	<form action="<?php echo $_SERVER['PHP_SELF'] ?>" mathod = "GET" onsubmit = "getResult(this); return false;">
 		<input type="text" name="bookid" placeholder="Search book with ID" value="<?php echo $bookid  ?>">
 		<input type="submit" name="search" value="search">
 		<span style="color: red"> <?php echo $failed; ?></span>
 		<span style="color: green;"> <?php echo $success; ?></span> <br><br><br>
 	</form>
 </div>
 

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

		<tbody  id="result">
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

<?php include('../View/html/footer.html');?>
</body>
</html>
