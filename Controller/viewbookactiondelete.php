 	<?php 

			$success = $failed = "";
 			include '../Model/dbbook.php';
			 
			if(!empty(basic_validation($_GET['id'])))
			{
 				$response = removeBook($_GET['id']);
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
 

 <div class="box"  id="update">
	<form action="<?php echo $_SERVER['PHP_SELF'] ?>" mathod = "GET" onsubmit = "getResult(this); return false;">
 		<input type="text" name="bookid" placeholder="Search book with ID" value="<?php echo $bookid  ?>">
 		<input type="submit" name="search" value="search">
 		<span style="color: red"> <?php echo $failed; ?></span>
 		<span style="color: green;"> <?php echo $success; ?></span> <br><br><br>
 	</form>
 </div>
  